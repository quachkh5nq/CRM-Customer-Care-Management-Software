<?php
// Bao gồm file kết nối cơ sở dữ liệu
require 'db_conn.php';

// Lấy dữ liệu từ POST
$contactId = intval($_POST['contactId']);
$hoTen = $conn->real_escape_string($_POST['hoTen']);
$email = $conn->real_escape_string($_POST['email']);
$phone = $conn->real_escape_string($_POST['phone']);

// Thực thi truy vấn cập nhật liên hệ
$sql = "UPDATE ct_lienhe SET HoTen = '$hoTen', Email = '$email', Phone = '$phone' WHERE Id_LienHe = $contactId";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $conn->error]);
}

// Đóng kết nối
$conn->close();
?>
