<?php
// Kết nối cơ sở dữ liệu
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

// Nhận ID sản phẩm từ query string
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$response = array();

if ($id > 0) {
    // Truy vấn thông tin sản phẩm từ bảng sanpham
    $sql = "SELECT MoTa, Gia FROM sanpham WHERE Id_SanPham = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $response['MoTa'] = $row['MoTa'];
        $response['Gia'] = $row['Gia'];
    } else {
        $response['error'] = 'Sản phẩm không tìm thấy';
    }
    $stmt->close();
} else {
    $response['error'] = 'ID sản phẩm không hợp lệ';
}

$conn->close();

// Gửi phản hồi dưới dạng JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
