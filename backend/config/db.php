<?php

$env = parse_ini_file(__DIR__ . '/.env');

$conn = mysqli_connect(
    $env['DB_HOST'],
    $env['DB_USER'],
    $env['DB_PASS'],
    $env['DB_NAME']
);

if (!$conn) {
    error_log('DB connection error: ' . mysqli_connect_error());
    die('Service unavailable, please try again later.');
}