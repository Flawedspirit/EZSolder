<?php

function db_connect() {
    global $config;

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

function get_mod_entry($modslug) {
    global $db, $prefix;

    $query = $db->prepare("SELECT * FROM " . $prefix . 'mods' . " WHERE name = ?");
    $query->bind_param('s', $modslug);
    $query->execute();

    return $query->get_result();
}

function update_db($db, $data, $file) {
    global $config;

    if(!$config['upload_only']) {
        $prefix = $config['database']['prefix'];
        $hash = md5_file($file);
        $time = date("Y-m-d h:i:s");

        // First search of database to get initial state of the mod entry
        $result = get_mod_entry($data['modslug']);

        if($result->num_rows === 0) {
            if(empty($data['modname']) || empty($data['modauthor']) || empty($data['modslug'])) {
                throw new Exception("Error: mod name, mod author, and mod slug fields must be entered for a new mod entry");
            }

            try {
                $s_create = $db->prepare("INSERT INTO " . $prefix . 'mods' . " (name, author, created_at, updated_at, pretty_name) VALUES (?, ?, ?, ?, ?)");
                $s_create->bind_param('sssss', $data['modslug'], $data['modauthor'], $time, $time, $data['modname']);
                $s_create->execute();
                $s_create->store_result();
            } catch (Exception $x) {
                outputErrorMessage($x);
            }
        }

        // Second search of database to get mod_id of the newly placed mod entry
        // To-do: can this be done more efficiently (one db call?)
        $result = get_mod_entry($data['modslug']);
        $last_mod_id = $result->fetch_row()[0];

        try {
            $s_insert = $db->prepare("INSERT INTO " . $prefix . 'modversions' . " (mod_id, version, md5, created_at, updated_at) VALUES (?, ?, ?, ?, ?)");
            $s_insert->bind_param('issss', $last_mod_id, $data['version'], $hash, $time, $time);
            $s_insert->execute();
            $s_insert->store_result();

            // Updates the 'updated at' column in the mods table
            // Serves no purpose; it just seems like it should change
            $query = $db->prepare("UPDATE " . $prefix . 'mods' . " SET updated_at=? WHERE id=?");
            $query->bind_param('si', $time, $last_mod_id);
            $query->execute();

            return $db->close();
        } catch (Exception $x) {
            outputErrorMessage($x);
        }
    }
}

?>