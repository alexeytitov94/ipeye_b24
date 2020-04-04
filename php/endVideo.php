<?php

require('../api/b24/main.php');
require('../api/ipeye/ipeye.class.php');

$portal = $_POST['portal'];
$essence = $_POST['placement'];
$essence_id = $_POST['id'];


//Получаю камеру из таблицы
$mysql = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$query = "SELECT * 
            FROM records 
             WHERE portal='$portal' && essence_id='$essence_id' && essence='$essence' && active='Y'";

$camera= [];

if ($result = $mysql->query($query)) {

    while ($row = $result->fetch_assoc()) {
        $camera = $row;
    }

    $result->close();
}


//$url_show = 'https://b24apps.ru/local/b24apps/our_app/ipeye/player.php?'.http_build_query($camera);

//Библиотека IPEYE
$api_server = 'api.ipeye.ru';
$api_port = 8111;
$api_login = 'Q3Testing';
$api_password = 'Q3dDgMVVGLk2JhA';
$api_timeout = 2;
$ipeye = new ipeye($api_server, $api_port, $api_login, $api_password, $api_timeout);
$cam_id = $camera['camera_id'];

//Получение привью видео
$image_prewie = base64_encode($ipeye->device_jpeg_online($cam_id, 'deep.jpeg'));

//Получение видео
$strat_time = strtotime($camera['date_start']);
$end_time = strtotime(date('Y-m-d H:i:s'));
//$end_time = strtotime(date('2020-03-05 15:30:00'));


writeToLog($strat_time);
writeToLog($end_time);

$length = round(abs($end_time-$strat_time))- 3;//Разница в секундах
$url_video = json_decode($ipeye->device_nvr_file_mp4($cam_id, round($strat_time), $length), true)['message'];


$mysql = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$query = "UPDATE records 
            SET date_end=NOW(), active='N', preview='$image_prewie', link_video='$url_video'
             WHERE portal='$portal' && active='Y' && essence_id='$essence_id' && essence='$essence'";

$mysql->query($query);


