<?php

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

echo 'Connected successfully';
