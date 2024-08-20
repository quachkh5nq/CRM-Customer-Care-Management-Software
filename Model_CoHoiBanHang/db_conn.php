<?php
// db_conn.php

// Thông tin kết nối cơ sở dữ liệu
$servername = 'crm.adotech.vn';
$username = 'xekhacha_xekhacha';
$password = 'HOCGc1Y7M4Az';
$dbname = 'xekhacha_db_crm';

// Kết nối tới MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>
