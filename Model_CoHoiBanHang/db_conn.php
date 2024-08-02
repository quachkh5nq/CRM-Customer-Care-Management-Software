<?php  

$sname = 'localhost'; // Localhost máy chủ của mình
$uname = 'root'; // Tên localhost
$password = ''; // Password của localhost

$db_name = 'db_crm'; // Tên database

$conn = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn) {
	echo "Connection Failed!";
	exit();
}