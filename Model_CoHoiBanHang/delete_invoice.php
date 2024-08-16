<?php
// Kết nối cơ sở dữ liệu
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'db_crm';

// Kết nối cơ sở dữ liệu
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy ID hóa đơn cần xóa từ URL
$idHoaDon = $_GET['id'];

// Lấy ID khách hàng liên kết với hóa đơn trước khi xóa
$sql_getCustomerId = "SELECT Id_khachhang FROM hoadon WHERE Id_HoaDon = $idHoaDon";
$result = $conn->query($sql_getCustomerId);

if ($result && $result->num_rows > 0) {
    // Lấy ID khách hàng
    $row = $result->fetch_assoc();
    $idKhachHang = $row['Id_khachhang'];

    // Xóa hóa đơn
    $sql_delete = "DELETE FROM hoadon WHERE Id_HoaDon = $idHoaDon";
    if ($conn->query($sql_delete) === TRUE) {
        // Sau khi xóa thành công, chuyển hướng về trang chi tiết khách hàng với Id_khachhang tương ứng
        header("Location: Check_KhachHang.php?id=$idKhachHang");
        exit;
    } else {
        echo "Lỗi khi xóa hóa đơn: " . $conn->error;
    }
} else {
    echo "Hóa đơn không tồn tại hoặc không thể tìm thấy khách hàng liên kết.";
}

// Đóng kết nối
$conn->close();
?>
