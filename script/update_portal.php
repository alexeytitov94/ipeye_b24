<?php

require('../api/main.php');

$data = json_decode($_POST['data']);
$id = Infoblock::chekPortal($data->MEMBER);

if ($id != '') {

    Infoblock::updatePortalData($id,$data);

} else {

    Infoblock::addNewPortal($data);
    //Lead::addLead($data);

}


