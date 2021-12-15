<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

date_default_timezone_set("America/New_York");

include dirname(__DIR__).'/resource/database_techInnovations.php';
include dirname(__DIR__).'/Models/AirQualityNode.php';

$airQualityNodes = new AirQualityNode($db);
$all = $airQualityNodes->getNodeOne();

if(count($all) > 0) {
    echo json_encode($all);
} else {
    echo json_encode(
        array('message' => 'No Data Available')
    );
}
