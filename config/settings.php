<?php  
include "limit.php";
include "session.php";
include "i.function.php";
include "function.php";
include "timezone.php";

// MYSQL CONNECTION
if (!file_exists('config/mysql.php')) {
	header("location: ./install");
}else{	
	include "mysql.php";
}

$settings['title'] = 'FB Tools';
$settings['desc'] = 'Tools Lite Facebook';
$settings['author'] = 'Irfaan Programmer';
$settings['version'] = 'v1.2';
$baseurl = home_base_url();

//ob_start("sanitize_output");
?>