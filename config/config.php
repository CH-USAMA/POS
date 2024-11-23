<?php
date_default_timezone_set('Asia/Karachi');
session_start();

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_NAME', 'pos');
define('DB_PASS', '');


$connect = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}


function clean_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>