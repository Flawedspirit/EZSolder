<?php

$data = array();

//$data['repo']       = $config['repository'];
$data['modname']    = trim(filter_input(INPUT_POST, 'modname',    FILTER_SANITIZE_STRING));
$data['modauthor']  = trim(filter_input(INPUT_POST, 'modauthor',  FILTER_SANITIZE_STRING));
$data['modslug']    = trim(filter_input(INPUT_POST, 'modslug',    FILTER_SANITIZE_STRING));
$data['modversion'] = trim(filter_input(INPUT_POST, 'modversion', FILTER_SANITIZE_STRING));
$data['modtype']    = trim(filter_input(INPUT_POST, 'type',       FILTER_SANITIZE_STRING));
$data['otherfield'] = trim(filter_input(INPUT_POST, 'otherfield', FILTER_SANITIZE_STRING));
$data['file']       = $_FILES['file'];

echo json_encode($data);

?>