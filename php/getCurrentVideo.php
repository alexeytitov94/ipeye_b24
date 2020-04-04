<?php

require('../api/b24/main.php');

$portal = $_POST['portal'];
$essence = $_POST['placement'];
$essence_id = $_POST['id'];


$mysql = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$query = "SELECT * 
            FROM records 
             WHERE portal='$portal' && essence_id='$essence_id' && essence='$essence'";

$arResult = [];

if ($result = $mysql->query($query)) {

    while ($row = $result->fetch_assoc()) {
        $arRow = $row;
        $row['preview'] = '';
        $arRow['url_show'] = 'https://b24apps.ru/local/b24apps/our_app/ipeye/player.php?'.http_build_query($row);

        $arResult[] = $arRow;
    }


    $result->close();
}

echo json_encode($arResult);
