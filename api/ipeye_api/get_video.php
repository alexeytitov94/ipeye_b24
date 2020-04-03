<?php

header('Content-Type: text/html; charset=utf-8');

include 'lib/ipeye.class.php';


function writeToLog($data, $title = '') {
    $log = "\n------------------------\n";
    $log .= date("Y.m.d G:i:s") . "\n";
    $log .= (strlen($title) > 0 ? $title : 'DEBUG') . "\n";
    $log .= print_r($data, 1);
    $log .= "\n------------------------\n";
    file_put_contents(getcwd() . '/hook.log', $log, FILE_APPEND);
    return true;
}


$data = json_decode($_POST['data']);

//writeToLog($data);


$api_server = 'api.ipeye.ru';
$api_port = 8111;
$api_login = 'Q3Testing';
$api_password = 'Q3dDgMVVGLk2JhA';
$api_timeout = 2;

$ipeye = new ipeye($api_server, $api_port, $api_login, $api_password, $api_timeout);

$cam_name = $data->cam_id;



//Получение привью видео
$image_prewie = $ipeye->device_jpeg_online($cam_name, 'deep.jpeg');

//Получение видео
$strat_time = $data->strat_time/1000;//Время начала
$end_time = $data->end_time/1000;//Конец записи

$length = round(abs($end_time-$strat_time))- 3;//Разница в секундах

$url_video = json_decode($ipeye->device_nvr_file_mp4('dd09f70013a24bdc9b989ad0fdcc547b', round($strat_time), $length), true)['message'];



echo json_encode([
    'image_prewie' => base64_encode($image_prewie),
    'url_video' => $url_video,//str_replace('http', 'https', $url_video),
    'strat_time' => $data->strat_time,
    'end_time' => $data->strat_time,
    'cam_name' => $data->cam_name
]);