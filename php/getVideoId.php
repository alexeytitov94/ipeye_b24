<?php

require('../api/b24/main.php');

$id = $_POST['id'];

$mysql = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$query = "SELECT * 
            FROM records 
             WHERE active='N' && id='$id'";

$arResult = [];

if ($result = $mysql->query($query)) {

    while ($row = $result->fetch_assoc()) {
        $arResult[] = $row;
    }


    $result->close();
}

$now = new DateTime($arResult[0]['date_end']);
$ref = new DateTime($arResult[0]['date_start']);
$diff = $now->diff($ref);
$time = '';


if ((int)$diff->h < 10) {
    $time = '0'.$diff->h.':';
} else {
    if ($diff->h == 0) {
        $time = $time.'00:';
    } else {
        $time = $diff->h.':';
    }
}

if ((int)$diff->i < 10) {
    $time = $time.'0'.$diff->i.':';
} else {
    if ($diff->i == 0) {
        $time = $time.'00:';
    } else {
        $time = $time.$diff->i.':';
    }
}

if ((int)$diff->s < 10) {
    $time = $time.'0'.$diff->s;
} else {

    if ($diff->s == 0) {
        $time = $time.'00';
    } else {
        $time = $time.$diff->s;
    }
}

$arResult[0]['duration'] = $time;

echo json_encode($arResult[0]);
