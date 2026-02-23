<?php
error_reporting(0);

session_start();
date_default_timezone_set('Asia/Jerusalem');
$host = "localhost";


$dbname = "car_wash";
$user = "root";
$password=""; 

$connect = new mysqli($host, $user, $password, $dbname);
$connect->set_charset('utf8');
$connect->query("SET collation_connection = utf8_general_ci");
if ($connect->connect_error) {
    die("Connect Error" . $connect->connect_error);
}


?>

