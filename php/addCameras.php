<?php

require('../api/b24/main.php');

$cameras = $_POST['cameras'];
$portal = $_POST['portal'];

$mysql = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$query = "UPDATE cameras SET cameras='$cameras' WHERE `PORTAL` = '$portal';";

$mysql->query($query);