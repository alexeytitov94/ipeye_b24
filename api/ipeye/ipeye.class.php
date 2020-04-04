<?php
/*
@service name: IPEYE
@url: www.ipeye.ru, www.ipeye.org
@email: info@ipeye.ru
*/

class ipeye
{
    private $login = '';
    private $password = '';
    private $timeout = '';
    private $server = 'api.ipeye.ru';
    private $port = 8111;

    public function __construct($server = 'api.ipeye.ru', $port = '8111', $login = '3093609', $password = 'sobranie631', $timeout = '2')
    {
        $this->server = $server;
        $this->port = $port;
        $this->login = $login;
        $this->password = $password;
        $this->timeout = $timeout;
    }
    public function hello()
    {
        if ($data = $this->get_query('')) {
            return $data;
        } else {
            return false;
        }
    }
    public function info()
    {
        if ($data = $this->get_query('info')) {
            return $data;
        } else {
            return false;
        }
    }
    public function status()
    {
        if ($data = $this->get_query('status')) {
            return $data;
        } else {
            return false;
        }
    }
    public function device_info($uuid)
    {
        if ($data = $this->get_query("device/info/$uuid")) {
            return $data;
        } else {
            return false;
        }
    }
    public function device_server($uuid)
    {
        if ($data = $this->get_query("device/server/$uuid")) {
            return $data;
        } else {
            return false;
        }
    }
    public function device_status($uuid)
    {
        if ($data = $this->get_query("device/status/$uuid")) {
            return $data;
        } else {
            return false;
        }
    }
    public function device_url_rtmp($uuid)
    {
        if ($data = $this->get_query("device/url/rtmp/$uuid")) {
            return $data;
        } else {
            return false;
        }
    }
    public function device_url_hls($uuid)
    {
        if ($data = $this->get_query("device/url/hls/$uuid")) {
            return $data;
        } else {
            return false;
        }
    }
    public function device_url_rtsp($uuid)
    {
        if ($data = $this->get_query("device/url/rtsp/$uuid")) {
            return $data;
        } else {
            return false;
        }
    }
    public function device_jpeg_online($uuid, $name)
    {
        if ($data = $this->get_query("device/jpeg/online/$uuid/$name")) {
            return $data;
        } else {
            return false;
        }
    }
    public function device_thumb_online($uuid, $size, $name)
    {
        if ($data = $this->get_query("device/thumb/online/$uuid/$size/$name")) {
            return $data;
        } else {
            return false;
        }
    }
    public function device_jpeg_cache($uuid, $name)
    {
        if ($data = $this->get_query("device/jpeg/cache/$uuid/$name")) {
            return $data;
        } else {
            return false;
        }
    }
    public function device_thumb_cache($uuid, $size, $name)
    {
        if ($data = $this->get_query("device/thumb/cache/$uuid/$size/$name")) {
            return $data;
        } else {
            return false;
        }
    }
    public function device_nvr_file_mp4($uuid, $start, $length)
    {
        if ($data = $this->get_query("device/nvr/file/mp4/$uuid/$start/$length/")) {
            return $data;
        } else {
            return false;
        }
    }
    public function device_nvr_file_ts($uuid, $start, $length)
    {
        if ($data = $this->get_query("device/nvr/file/ts/$uuid/$start/$length/")) {
            return $data;
        } else {
            return false;
        }
    }
    public function device_nvr_hls($uuid, $start, $length)
    {
        if ($data = $this->get_query("device/nvr/hls/$uuid/$start/$length/")) {
            return $data;
        } else {
            return false;
        }
    }
    public function device_nvr_map($uuid, $start, $length)
    {
        if ($data = $this->get_query("device/nvr/map/$uuid/$start/$length/")) {
            return $data;
        } else {
            return false;
        }
    }
    public function device_alarm_map($uuid, $start, $length)
    {
        if ($data = $this->get_query("device/alarm/map/$uuid/$start/$length/")) {
            return $data;
        } else {
            return false;
        }
    }

    public function device_alarm_status($uuid)
    {
        if ($data = $this->get_query("device/alarm/status/$uuid")) {
            return $data;
        } else {
            return false;
        }
    }
    public function device_alarm_average($uuid)
    {
        if ($data = $this->get_query("device/alarm/average/$uuid")) {
            return $data;
        } else {
            return false;
        }
    }
    public function devices_all()
    {
        if ($data = $this->get_query('devices/all', 1)) {
            return $data;
        } else {
            return false;
        }
    }
    public function device_reload($uuid)
    {
        if ($data = $this->get_query("device/reload/$uuid", 1)) {
            return $data;
        } else {
            return false;
        }
    }
    public function device_del($uuid)
    {
        if ($data = $this->get_query("device/del/$uuid", 1)) {
            return $data;
        } else {
            return false;
        }
    }
    public function device_add($data)
    {
        if ($data = $this->post_query('device/add', $data, 1)) {
            return $data;
        } else {
            return false;
        }
    }
    public function device_edit($uuid, $data)
    {
        if ($data = $this->post_query("device/edit/$uuid", $data, 1)) {
            return $data;
        } else {
            return false;
        }
    }
    public function devices_select($data)
    {
        if ($data = $this->post_query('devices/select', $data, 0)) {
            return $data;
        } else {
            return false;
        }
    }

    private function get_query($method, $auth = 0)
    {
        if ($auth = 1) {
            $auth_str = $this->login.':'.$this->password.'@';
        } else {
            $auth_str = '';
        }
        if ($data = @file_get_contents("http://$auth_str".$this->server.':'.$this->port."/$method", 0, stream_context_create(array('http' => array('timeout' => $this->timeout))))) {
            return $data;
        } else {
            //обработка ошибки
            print_r($http_response_header);
            //var_dump($http_response_header);
            return false;
        }
    }

    private function post_query($method, $data, $auth = 0)
    {
        $options = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                        'timeout' => $this->timeout,
                'content' => http_build_query($data),
            ),
        );
        $context = stream_context_create($options);
        if ($auth = 1) {
            $auth_str = $this->login.':'.$this->password.'@';
        } else {
            $auth_str = '';
        }
        if ($data = file_get_contents("http://$auth_str".$this->server.':'.$this->port."/$method", false, $context)) {
            return $data;
        } else {
            //обработка ошибки
            print_r($http_response_header);

            return false;
        }
    }
}
