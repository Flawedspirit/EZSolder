<?php if(!defined('INDEX')) die('Direct access not allowed.');

class Database {
    function connect() {
        global $config;

        if(!$config['upload_only']) {
            switch($config['database']) {
                case 'mysql':
                default:
                    try {                        
                        return new PDO(
                            "mysql:host={$config['connection']['mysql']['hostname']};dbname={$config['connection']['mysql']['database']}",
                            $config['connection']['mysql']['username'],
                            $config['connection']['mysql']['password']
                        );
                    } catch(PDOException $x) {
                        return $x->getMessage();
                    }
                case 'sqlite':
                    try {
                        return new PDO("sqlite:{$config['connection']['sqlite']['database']}");
                    } catch(PDOException $x) {
                        return $x->getMessage();
                    }
                break;
            }
        } else {
            return true;
        }
    }

    function get_mod_entry($modslug) {
        global $con, $config;

        $query = $con->prepare('SELECT * FROM :table WHERE name = :modslug');
        $query->execute(['table' => $config['connection']['mysql']['prefix'] . 'mods', 'modslug' => $modslug]);

        return $query;
    }

    function update_db($data, $file) {
        global $con, $config;

        if(!$config['upload_only']) {
            $hash = md5_file($file);
            $time = date("Y-m-d h:i:s");

            // First search of database to get initial state of the mod entry
            $result = $this->get_mod_entry($data['modslug']);
            echo $result->rowCount();
            
            if($result->rowCount() === 0) {

            }
        } else {
            return true;
        }
    }
}

?>