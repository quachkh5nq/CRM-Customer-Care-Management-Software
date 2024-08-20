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

// Lấy ID hợp đồng cần xóa từ URL
$idHopDong = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Kiểm tra xem ID hợp đồng có hợp lệ không
if ($idHopDong <= 0) {
    echo "ID hợp đồng không hợp lệ.";
    $conn->close();
    exit;
}

// Lấy ID khách hàng liên kết với hợp đồng trước khi xóa
$sql_getCustomerId = "SELECT Id_khachhang FROM hopdong WHERE Id_HopDong = $idHopDong";
$result = $conn->query($sql_getCustomerId);

if ($result && $result->num_rows > 0) {
    // Lấy ID khách hàng
    $row = $result->fetch_assoc();
    $idKhachHang = $row['Id_khachhang'];

    // Thực hiện truy vấn xóa hợp đồng
    $sql_delete = "DELETE FROM hopdong WHERE Id_HopDong = $idHopDong";

    if ($conn->query($sql_delete) === TRUE) {
        // Sau khi xóa thành công, chuyển hướng về trang chi tiết khách hàng với Id_khachhang tương ứng
        header("Location: Check_KhachHang.php?id=$idKhachHang");
        exit;
    } else {
        echo "Lỗi khi xóa hợp đồng: " . $conn->error;
    }
} else {
    echo "Hợp đồng không tồn tại hoặc không thể tìm thấy khách hàng liên kết.";
}

// Đóng kết nối
$conn->close();
?>
