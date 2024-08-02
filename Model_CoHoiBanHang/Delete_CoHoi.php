<?php
// Kết nối cơ sở dữ liệu
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'db_crm';

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

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
