<?php
// Bao gồm file kết nối cơ sở dữ liệu
require 'db_conn.php';

// Lấy ID từ yêu cầu POST
$id = $_POST['id'];

// Xóa bản ghi
$sql = "DELETE FROM khachhangch WHERE Id_KHCH = $id";

if ($conn->query($sql) === TRUE) {
    echo "Xóa thành công";
} else {
    echo "Lỗi: " . $conn->error;
}

// Đóng kết nối
$conn->close();
?>
