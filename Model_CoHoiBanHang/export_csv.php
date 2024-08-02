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

// Truy vấn dữ liệu từ bảng khachhangch
$sql = "SELECT Id_KHCH, Ten, TenCongTy, Email, Phone, NguoiPhuTrach, TinhTrang, NguonCoHoi, NgayLienHe, Website, KhuVuc, GiaDuKien, NgayChotDuKien, MoTa FROM khachhangch";
$result = $conn->query($sql);

// Tạo tiêu đề file CSV
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename="CoHoiBanHang.csv"');

// Mở file CSV để ghi
$output = fopen('php://output', 'w');

// Thêm BOM (Byte Order Mark) để Excel nhận diện mã hóa UTF-8
fwrite($output, "\xEF\xBB\xBF");

// Ghi tiêu đề cột vào file CSV
fputcsv($output, ['STT', 'Tên', 'Tên Công Ty', 'Email', 'Phone', 'Người Phụ Trách', 'Tình Trạng', 'Nguồn Cơ Hội', 'Liên Hệ', 'Khu Vực'], ';');

// Ghi dữ liệu vào file CSV
$stt = 1;
while ($row = $result->fetch_assoc()) {
    fputcsv($output, [
        $stt++,
        $row['Ten'],
        $row['TenCongTy'],
        $row['Email'],
        $row['Phone'],
        $row['NguoiPhuTrach'],
        $row['TinhTrang'],
        $row['NguonCoHoi'],
        $row['NgayLienHe'],
        $row['KhuVuc']
    ], ';');
}

// Đóng file CSV
fclose($output);

// Đóng kết nối
$conn->close();
