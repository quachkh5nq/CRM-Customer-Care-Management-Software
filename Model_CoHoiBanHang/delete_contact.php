<?php
// Bao gồm file kết nối cơ sở dữ liệu
require 'db_conn.php';

// Lấy dữ liệu từ POST
$contactId = intval($_POST['contactId']);

// Thực thi truy vấn xóa liên hệ
$sql = "DELETE FROM ct_lienhe WHERE Id_LienHe = $contactId";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $conn->error]);
}

// Đóng kết nối
$conn->close();
?>
