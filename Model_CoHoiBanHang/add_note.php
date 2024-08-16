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

// Lấy dữ liệu từ POST
$id = intval($_POST['id']); // ID khách hàng từ URL
$moTa = $conn->real_escape_string($_POST['moTa']); // Mô tả ghi chú

// Thực thi truy vấn thêm ghi chú
$sql = "INSERT INTO ct_ghichu (Id_KhachHang, MoTa, NgayTao) VALUES ($id, '$moTa', NOW())";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $conn->error]);
}

// Đóng kết nối
$conn->close();
?>
