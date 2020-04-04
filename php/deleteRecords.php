<?php

require('../api/b24/main.php');

$id = $_POST['id'];

$mysql = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$query = "DELETE FROM records 
             WHERE id='$id'";

$mysql->query($query);
