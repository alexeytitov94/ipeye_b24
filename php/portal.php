<?php

require('../api/b24/main.php');

$name_portal = $_POST['portal'];

$portal = Bd::getPortal($name_portal);

if (empty($portal)) {
    Bd::addPortal($name_portal);
    echo 'new';
} else {
    echo $portal['CAMERAS'];
}

