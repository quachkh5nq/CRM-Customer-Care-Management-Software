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

// Nhận dữ liệu từ form
$idHoaDon = isset($_POST['Id_HoaDon']) ? intval($_POST['Id_HoaDon']) : 0;
$tenSanPham = isset($_POST['TenSanPham']) ? $_POST['TenSanPham'] : '';
$moTa = isset($_POST['MoTa']) ? $_POST['MoTa'] : '';
$gia = isset($_POST['Gia']) ? floatval($_POST['Gia']) : 0;
$soLuong = isset($_POST['SoLuong']) ? intval($_POST['SoLuong']) : 0;
$tienThue = isset($_POST['TienThue']) ? floatval($_POST['TienThue']) : 0;
$tongTien = isset($_POST['TongTien']) ? floatval($_POST['TongTien']) : 0;

// Chèn thông tin vào bảng ct_hoadon
$sql = "INSERT INTO ct_hoadon (Id_HoaDon, TenSanPham, MoTa, SoLuong, Gia, TienThue, TongTien) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Lỗi chuẩn bị câu lệnh: " . $conn->error);
}

// Sử dụng loại kiểu cho các tham số
$stmt->bind_param('issdddi', $idHoaDon, $tenSanPham, $moTa, $soLuong, $gia, $tienThue, $tongTien);

if ($stmt->execute()) {
    echo "Thông tin đã được lưu thành công!";
} else {
    echo "Lỗi: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
