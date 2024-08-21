<?php
// Lấy ID từ query string
$id = $_GET['id'];

// Bao gồm file kết nối cơ sở dữ liệu
require 'db_conn.php';

// Xóa khách hàng khỏi cơ sở dữ liệu
$sql = "DELETE FROM khachhang WHERE Id_khachhang = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "Khách hàng đã được xóa thành công.";
} else {
    echo "Lỗi: " . $stmt->error;
}

// Đóng kết nối
$stmt->close();
$conn->close();

// Chuyển hướng về trang danh sách khách hàng
header("Location: Home_KhachHang.php");
exit();
?>
