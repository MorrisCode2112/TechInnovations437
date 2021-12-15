<?php

$config = include dirname(__DIR__).'/config_techInnovations/app.php';

$driver = $config['database']['driver'];
$host = $config['database']['host'];
$db_name = $config['database']['dbname'];
$port = $config['database']['port'];
$db_username = $config['database']['username'];
$db_password = $config['database']['password'];
$options = $config['database']['options'];

$dsn = "{$driver}:host={$host}; dbname={$db_name}; port={$port};";

try {
    $db = new PDO($dsn, $db_username, $db_password, $options);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "Database connection successful.";
} catch (PDOException $ex) {
//    echo "Failed to make database connection.";
}

?>