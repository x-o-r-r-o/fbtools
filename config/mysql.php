<?php  
@$mysql = new mysqli('localhost','root','','fbtools');

if ($mysql->connect_error) {
    die("Connection failed: " . $mysql->connect_error);
    exit;
} 
?>