<?php
// Bao gồm file kết nối cơ sở dữ liệu
require 'db_conn.php';

// Truy vấn dữ liệu từ bảng khachhangch
$sql = "SELECT Id_khachhang, TenKhachHang, LienHeChinh, TrangWeb, MaSoThue, NhomKhachHang, DiaChi, KhuVuc, 
            Phone, DonViTien, NgayThanhLap, 
            Email, TrangThai, NguoiPhuTrach, NgayTao FROM khachhang";
$result = $conn->query($sql);
// Tạo tiêu đề file CSV
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename="DanhSachKhachHang.csv"');

// Mở file CSV để ghi
$output = fopen('php://output', 'w');

// Thêm BOM (Byte Order Mark) để Excel nhận diện mã hóa UTF-8
fwrite($output, "\xEF\xBB\xBF");

// Ghi tiêu đề cột vào file CSV
fputcsv($output, ['STT', 'Tên Khách Hàng', 'Liên Hệ Chính', 'Nhóm Khách Hàng', 
'Phone', 'Email',
'Trạng Thái', 'Người Phụ Trách', 'Ngày Tạo'], ';');

// Ghi dữ liệu vào file CSV
$stt = 1;
while ($row = $result->fetch_assoc()) {
    fputcsv($output, [
        $stt++,
        $row['TenKhachHang'],
        $row['LienHeChinh'],
        $row['NhomKhachHang'],
        $row['Phone'],
        $row['Email'],
        $row['TrangThai'],
        $row['NguoiPhuTrach'],
        $row['NgayTao'],
    ], ';');
}

// Đóng file CSV
fclose($output);

// Đóng kết nối
$conn->close();
