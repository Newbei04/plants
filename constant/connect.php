<?php

// Load .env file manually
$env = parse_ini_file(__DIR__ . '/.env');

$host = getenv('DB_HOST');
$username = getenv('DB_USER');
$password = getenv('DB_PASS');
$db_name = getenv('DB_NAME');

$con = mysqli_connect($host, $username, $password, $db_name);

if (!$con) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}
