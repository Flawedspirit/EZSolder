<?php define('INDEX', getcwd()); 

require_once INDEX . "/app/config/config.php";
require_once INDEX . "/app/core/database.php";
require_once INDEX . "/app/core/ezsolder.php";

$config = (new Configuration)->getConfig();
$db = (new Database)->connect();

EZSolder::init($config);

include INDEX . '/public/main.php';

?>
