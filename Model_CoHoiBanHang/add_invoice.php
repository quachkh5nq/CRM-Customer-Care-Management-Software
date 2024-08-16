<?php
// Kết nối cơ sở dữ liệu
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'db_crm';
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy Id_khachhang và thông tin hóa đơn từ POST
$Id_khachhang = $_POST['Id_khachhang'];
$NguoiLapHoaDon = $_POST['NguoiLapHoaDon'];
$NgayThanhToan = $_POST['NgayThanhToan'];
$NgayHetHan = $_POST['NgayHetHan'];
$TinhTrang = $_POST['TinhTrang'];

// Kiểm tra Ngày Hết Hạn phải lớn hơn Ngày Thanh Toán
if (strtotime($NgayHetHan) <= strtotime($NgayThanhToan)) {
    die("Lỗi: Ngày Hết Hạn phải lớn hơn Ngày Thanh Toán.");
}

// Lấy mã hóa đơn lớn nhất hiện tại và tăng lên
$sql_max_mahd = "SELECT MaHoaDon FROM hoadon ORDER BY Id_HoaDon DESC LIMIT 1";
$result_max_mahd = $conn->query($sql_max_mahd);

if ($result_max_mahd->num_rows > 0) {
    $row_max_mahd = $result_max_mahd->fetch_assoc();
    $current_mahd_number = (int)str_replace('HD', '', $row_max_mahd['MaHoaDon']);
    $new_mahd_number = $current_mahd_number + 1;
} else {
    $new_mahd_number = 1; // Nếu không có hóa đơn nào, bắt đầu từ 1
}

// Tạo mã hóa đơn mới theo định dạng HD00x
$new_MaHoaDon = 'HD' . str_pad($new_mahd_number, 3, '0', STR_PAD_LEFT);

// Chèn hóa đơn mới vào bảng
$sql_insert = "INSERT INTO hoadon (Id_khachhang, MaHoaDon, NguoiLapHoaDon, NgayThanhToan, NgayHetHan, TinhTrang) 
               VALUES ($Id_khachhang, '$new_MaHoaDon', '$NguoiLapHoaDon', '$NgayThanhToan', '$NgayHetHan', '$TinhTrang')";

if ($conn->query($sql_insert) === TRUE) {
    echo "Thêm hóa đơn thành công!";
} else {
    echo "Lỗi: " . $sql_insert . "<br>" . $conn->error;
}

// Đóng kết nối và chuyển hướng về trang chi tiết khách hàng
$conn->close();
header("Location: Check_KhachHang.php?id=$Id_khachhang");
exit;
?>
