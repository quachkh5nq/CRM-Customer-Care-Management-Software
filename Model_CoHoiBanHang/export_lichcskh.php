<?php
// Bao gồm file kết nối cơ sở dữ liệu
require 'db_conn.php';

// Truy vấn dữ liệu từ bảng lichcskh
$sql = "SELECT ID_LichCSKH, TieuDe, TinhTrangCoHoi, 
NguonCoHoi, NgayDuKien, GuiDen, HovaTen, TrangThai FROM lichcskh";
$result = $conn->query($sql);

// Tạo tiêu đề file CSV
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename="LichChamSoc.csv"');

// Mở file CSV để ghi
$output = fopen('php://output', 'w');

// Thêm BOM (Byte Order Mark) để Excel nhận diện mã hóa UTF-8
fwrite($output, "\xEF\xBB\xBF");

// Ghi tiêu đề cột vào file CSV
fputcsv($output, ['STT', 'Tiêu Đề', 'Tình Trạng Cơ Hội', 'Ngày Dự Kiến', 
'Gửi Đến', 'Người Phụ Trách', 'Trạng Thái'], ';');

// Ghi dữ liệu vào file CSV
$stt = 1;
while ($row = $result->fetch_assoc()) {
    fputcsv($output, [
        $stt++,
        $row['TieuDe'],
        $row['TinhTrangCoHoi'],
        $row['NguonCoHoi'],
        $row['NgayDuKien'],
        $row['GuiDen'],
        $row['HovaTen'],
        $row['TrangThai'],
    ], ';');
}

// Đóng file CSV
fclose($output);

// Đóng kết nối
$conn->close();
