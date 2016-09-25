<?php define('INDEX', true);;

$term = '%' . $_GET['term'] . '%';
$json = array();

$config = include 'config.php';
$prefix = $config['database']['prefix'];

include 'database.php';
$db = db_connect();

$search = $db->prepare("SELECT name FROM " . $prefix . "mods WHERE name LIKE ? ORDER BY name") or die($db->error);
$search->bind_param('s', $term);
$search->execute();
$search->bind_result($result);

while($search->fetch()) {
    $json[] = $result;
}

echo json_encode($json);

?>