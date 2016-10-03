<?php 

function db_connect() {
    global $config;

    //mysqli_report(MYSQLI_REPORT_OFF);

    if(!$config['upload_only']) {
        $db = new mysqli(
            $config['database']['hostname'],
            $config['database']['username'],
            $config['database']['password'],
            $config['database']['database']
        );

        if($db->connect_errno) {
            $errno = mysqli_connect_errno($db);
            $error = mysqli_connect_error($db);
            return false;
        }

        return $db;
    }
}

function update_db($db, $data, $file) {
    global $config;

    if(!$config['upload_only']) {
        $prefix = $config['database']['prefix'];
        $hash = md5_file($file);
        $time = date("Y-m-d h:i:s");

        $init_query = $db->prepare("SELECT * FROM " . $prefix . 'mods' . " WHERE name = ?");
        $init_query->bind_param('s', $data['modslug']);
        $init_query->execute();
        $result = $init_query->get_result();

        $last_mod_id = $result->fetch_row()[0];

        if($init_query->affected_rows === 0) {
            if(empty($data['modname']) || empty($data['modauthor']) || empty($data['modslug'])) {
                throw new Exception("Error: mod name, mod author, and mod slug fields must be entered for a new mod entry");
            }
            if(!$s_create = $db->prepare("INSERT INTO " . $prefix . 'mods' . " (name, author, created_at, updated_at, pretty_name) VALUES (?, ?, ?, ?, ?)")) {
                throw new Exception(sprintf("Error %s: %s", $db->errno, $db->error));
            } else {
                $s_create->bind_param('sssss', $data['modslug'], $data['modauthor'], $time, $time, $data['modname']);
                $s_create->execute();
                $s_create->store_result();
            }
        }

        if(!$s_insert = $db->prepare("INSERT INTO " . $prefix . 'modversions' . " (mod_id, version, md5, created_at, updated_at) VALUES (?, ?, ?, ?, ?)")) {
            throw new Exception(sprintf("Error %s: %s", $db->errno, $db->error));
        } else {
            $s_insert->bind_param('issss', $last_mod_id, $data['version'], $hash, $time, $time);
            $s_insert->execute();
        }

        return $db->close();
    }
}

?>