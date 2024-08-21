<?php
// Bao gồm file kết nối cơ sở dữ liệu
require 'db_conn.php';

// Lấy dữ liệu từ POST
$noteId = intval($_POST['noteId']);

// Thực thi truy vấn xóa ghi chú
$sql = "DELETE FROM ct_ghichu WHERE Id_GhiChu = $noteId";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $conn->error]);
}

// Đóng kết nối
$conn->close();
?>
