<?php

return [
    'database' => [
        'driver' => 'mysql',
        'host' => 'localhost',
        'dbname' => 'db_techInnovations',
        'port' => 3306,
        'username' => 'leeb',
        'password' => 'root',
        'options' => ['PDO::MYSQL_ATTR_INIT_COMMAND' => 'SET NAMES utf8']
    ],
    'keys' =>
        [
            'api_key' => 'abc123'
        ]
];