<?php

$data = array();

$data['modname']    = trim(filter_input(INPUT_POST, 'modname',    FILTER_SANITIZE_STRING));
$data['modauthor']  = trim(filter_input(INPUT_POST, 'modauthor',  FILTER_SANITIZE_STRING));
$data['modslug']    = trim(filter_input(INPUT_POST, 'modslug',    FILTER_SANITIZE_STRING));
$data['modversion'] = trim(filter_input(INPUT_POST, 'modversion', FILTER_SANITIZE_STRING));
$data['modtype']    = trim(filter_input(INPUT_POST, 'type',       FILTER_SANITIZE_STRING));
$data['otherfield'] = trim(filter_input(INPUT_POST, 'otherfield', FILTER_SANITIZE_STRING));
$data['file']       = $_FILES['file'];

move_uploaded_file($data['file']['tmp_name'], "/var/www/html/tmp/" . $data['file']['name']);

echo json_encode($data);

?>