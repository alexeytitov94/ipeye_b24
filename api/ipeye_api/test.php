<meta charset="utf-8">
<?php

/*
@service name: IPEYE
@url: www.ipeye.ru, www.ipeye.org
@email: info@ipeye.ru
*/

include 'lib/ipeye.class.php';


$api_server = 'api.ipeye.ru';
$api_port = 8111;
$api_login = 'Q3Testing';
$api_password = 'Q3dDgMVVGLk2JhA';
$api_timeout = 2;

echo '<h1>test api</h1>';
$ipeye = new ipeye($api_server, $api_port, $api_login, $api_password, $api_timeout);
echo '<h2>method /</h2>';


echo '<h2>method /devices/all</h2>';
if ($info = $ipeye->devices_all()) {
    $data = json_decode($info, true);
    echo '<pre>';
    print_r($info);
    echo '</pre>';
    if ($data['status'] == 1) {
        echo 'response success: ';
        print_r($data['message']);
    } else {
        echo 'response err: ';
        print_r($data['message']);
    }
} else {
    echo 'err no reply<br>';
}


echo '<h2>method /device/jpeg/online/:uuid/:name</h2>';
if ($info = $ipeye->device_jpeg_online('dd09f70013a24bdc9b989ad0fdcc547b', 'deep.jpeg')) {
    echo "<img width='200' src='data:image/jpeg;base64,".base64_encode($info)."'>";
} else {
    echo 'err no reply<br>';
}

$start = time() - 3600;
$length = 120;
echo '<h2>method /device/nvr/file/mp4/:uuid/:start/:length</h2>';
if ($info = $ipeye->device_nvr_file_mp4('dd09f70013a24bdc9b989ad0fdcc547b', $start, $length)) {
    $data = json_decode($info, true);
    echo '<pre>';
    print_r($info);
    echo '</pre>';
    if ($data['status'] == 1) {
        echo 'response success: ';
        print_r($data['message']);
    } else {
        echo 'response err: ';
        print_r($data['message']);
    }
} else {
    echo 'err no reply<br>';
}


?>
