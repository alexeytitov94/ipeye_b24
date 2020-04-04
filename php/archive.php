<?php

require('../api/b24/main.php');

$date = date('Y-m-d', strtotime("-1 days"));


$mysql = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$query = "SELECT id, portal, essence, essence_id, date_start, date_end, camera_id, active, archive, camera_name
            FROM records
             WHERE date_end>='$date 00:00:00' AND date_end<='$date 23:59:59' AND archive='N' AND active='N'";

$arResult = [];

if ($result = $mysql->query($query)) {

    while ($row = $result->fetch_assoc()) {
        $arResult[] = $row;
    }

    $result->close();
}

$mysql = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$query = "UPDATE records 
            SET archive='N'
                WHERE date_end>='$date 00:00:00' AND date_end<='$date 23:59:59' AND archive='N' AND active='N'";

$mysql->query($query);



echo json_encode($arResult);


