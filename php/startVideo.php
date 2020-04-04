<?php

require('../api/b24/main.php');

$portal = $_POST['portal'];
$essence = $_POST['placement'];
$essence_id = $_POST['id'];
//$date_start = date('d.m.Y H:i:s');
$camera_id = $_POST['camera_id'];
$camera_name = $_POST['camera_name'];


$mysql = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$query = "INSERT INTO records (portal, essence, essence_id, date_start, camera_id, active, archive, camera_name) VALUES ('$portal', '$essence', '$essence_id', NOW(), '$camera_id', 'Y', 'N', '$camera_name')";

$mysql->query($query);