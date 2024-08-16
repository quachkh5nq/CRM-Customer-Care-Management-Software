<?php
// Thông tin kết nối cơ sở dữ liệu
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'db_crm';

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy ID khách hàng từ tham số URL
$id_khachhang = intval($_GET['id']);

// Truy vấn dữ liệu ghi chú từ bảng ct_ghichu
$sql = "SELECT Id_GhiChu, MoTa, NgayTao FROM ct_ghichu WHERE Id_KhachHang = $id_khachhang";
$result = $conn->query($sql);

$notes = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $notes[] = $row;
    }
}

// Đóng kết nối
$conn->close();

// Trả về dữ liệu dưới dạng JSON
header('Content-Type: application/json');
echo json_encode($notes);
?>
