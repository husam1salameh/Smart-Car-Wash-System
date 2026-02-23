<?php
error_reporting(0);
ob_start();
   
session_start();

if($_GET['logout']==1)
{
    session_unset();
    session_destroy();
    echo"<meta http-equiv='Refresh' content='1;url=../index.php'/>";
    exit;
}

if(!isset($_SESSION['user_id']))
{
	if(file_exists('../index.php'))echo"<script> window.top.location.href = '../index.php';</script>";
	else if(file_exists('../../index.php'))echo"<script> window.top.location.href = '../../index.php';</script>";
	exit;
}
	
if(file_exists('../config.php'))include '../config.php';
else if(file_exists('../../config.php'))include '../../config.php';


ob_end_flush();
?>


      
