<?php
session_start();
ob_start();
//продолжение костыля с сессией и пагинацией
//var_dump($_SESSION);
if(empty($_SESSION['current_page'])){
	//$_SESSION['current_page'] = 1;
	echo ' if session';
	//echo 'begin program';
}
// $_SESSION['get_data'] = '';
// $_SESSION['user_status'] = 1;
ini_set('display_errors', 1);
//echo 'index.php';
require_once 'vendor/autoload.php';
require_once 'application/assembling.php';
?>