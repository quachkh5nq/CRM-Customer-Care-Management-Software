<?php
// Bao gồm file kết nối cơ sở dữ liệu
require 'db_conn.php';

// Truy vấn dữ liệu từ bảng khachhangch
$sql = "SELECT Id_SanPham , TenSanPham, MoTa, Anh, Gia, 
ThuocNhom, DonVi, Kho FROM sanpham";
$result = $conn->query($sql);

// Tạo tiêu đề file CSV
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename="Danh Sách Sản Phẩm.csv"');

// Mở file CSV để ghi
$output = fopen('php://output', 'w');

// Thêm BOM (Byte Order Mark) để Excel nhận diện mã hóa UTF-8
fwrite($output, "\xEF\xBB\xBF");

// Ghi tiêu đề cột vào file CSV
fputcsv($output, ['STT', 'Tên Sản Phẩm', 'Mô Tả	', 'Ảnh', 'Giá', 
'Nhóm', 'Đơn Vị', 'Kho'], ';');

// Ghi dữ liệu vào file CSV
$stt = 1;
while ($row = $result->fetch_assoc()) {
    fputcsv($output, [
        $stt++,
        $row['TenSanPham'],
        $row['MoTa'],
        $row['Anh'],
        $row['Gia'],
        $row['ThuocNhom'],
        $row['DonVi'],
        $row['Kho'],
    ], ';');
}

// Đóng file CSV
fclose($output);

// Đóng kết nối
$conn->close();
