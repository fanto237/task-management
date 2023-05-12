<?php

use function PHPSTORM_META\type;

define('DB_HOST', 'database');
define('DB_USER', 'root');
define('DB_PASS', 'fanto237');
define('DB_NAME', 'QuoteActionDb');

// Create database connection
$conn = new \mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// connecting to redis database
//Connecting to Redis server on localhost 
$redis = new Redis();
$redis->connect('redis');
echo "Connection to server sucessfully";
//check whether server is running or not 
if ($redis->ping()) {
    echo "PONG";
}
