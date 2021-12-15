<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set("America/New_York");

include dirname(__DIR__).'/functions.php';
include dirname(__DIR__).'/resource/database_techInnovations.php';
//
if(isset($_POST['api_key']) and $_POST['api_key'] === $config['keys']['api_key']) {
    $co2 = $_POST['co2'];
    $temp = $_POST['temp'];
    $humidity = $_POST['humidity'];
    $pressure = $_POST['pressure'];
    $node_id = $_POST['node_id'];

    $sql_query = /** @lang MySQL */ "INSERT INTO db_techInnovations.records (co2, temp, humidity, pressure, node_id)
                                     VALUES (:co2, :temp, :humidity, :pressure, :node_id)";
    $stmt = $db->prepare($sql_query);
    $stmt->execute(array(':co2' => $co2, ':temp' => $temp, ':humidity' => $humidity, ':pressure' => $pressure, ':node_id' => $node_id));
    if($stmt->rowCount() > 0) {
        echo "New database record inserted successfully";
    } else {
        echo "There was an error inserting a new database record.";
    }
}




