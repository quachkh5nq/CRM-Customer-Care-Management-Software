<?php
// Bao gồm file kết nối cơ sở dữ liệu
require 'db_conn.php';

// Lấy ID từ yêu cầu
$id = intval($_GET['id']);

// Truy vấn dữ liệu khách hàng
$sql = "SELECT * FROM khachhangch WHERE Id_khachhang = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Kiểm tra và trả về dữ liệu
if ($result->num_rows > 0) {
    echo json_encode($result->fetch_assoc());
} else {
    echo json_encode([]);
}

// Đóng kết nối
$stmt->close();
$conn->close();
?>
