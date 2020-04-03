<?php

header("Content-Type: text/html; charset=utf-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);


require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule("iblock");

const INPUT_KEY = '9md6031y60zhtuul';
const URL_PORTAL = 'https://tmwx.bitrix24.ru';
const QUERY_URL = URL_PORTAL.'/rest/340/'.INPUT_KEY.'/';


require __DIR__.'/rest/include.php';


