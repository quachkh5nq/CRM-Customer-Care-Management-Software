<?php
// Bao gồm file kết nối cơ sở dữ liệu
require 'db_conn.php';

// Lấy dữ liệu từ POST
$noteId = intval($_POST['noteId']);
$moTa = $conn->real_escape_string($_POST['moTa']);

// Thực thi truy vấn cập nhật ghi chú
$sql = "UPDATE ct_ghichu SET MoTa = '$moTa' WHERE Id_GhiChu = $noteId";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $conn->error]);
}

// Đóng kết nối
$conn->close();
?>
