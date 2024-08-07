<?php
// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_crm";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy dữ liệu từ form
$name = $_POST['name'];
$company = $_POST['company'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$chucvu = $_POST['chucvu'];
$diachi = $_POST['diachi'];
$nguoiphutrach_id = $_POST['nguoiphutrach']; // Lưu Id_NhanVien vào cơ sở dữ liệu
$tinhtrang = $_POST['tinhtrang'];
$nguoncohoi = $_POST['nguoncohoi'];
$ngaylienhe = $_POST['ngaylienhe'];
$website = $_POST['website'];
$khuvuc = $_POST['khuvuc'];
$giadukien = $_POST['giadukien'];
$ngaychotdukien = $_POST['ngaychotdukien'];
$mota = $_POST['mota'];

// Tìm HovaTen dựa trên Id_NhanVien
$sql = "SELECT HovaTen FROM nhanvien WHERE Id_NhanVien = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $nguoiphutrach_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nguoiphutrach = $row['HovaTen']; // Lưu HovaTen vào biến
} else {
    die("Không tìm thấy nhân viên");
}

// Thêm dữ liệu vào bảng khachhangch
$sql = "INSERT INTO khachhangch (Ten, TenCongTy, Email, Phone, ChucVu, DiaChi, NguoiPhuTrach, TinhTrang, NguonCoHoi, NgayLienHe, Website, KhuVuc, GiaDuKien, NgayChotDuKien, MoTa)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssssssssss", $name, $company, $email, $phone, $chucvu, $diachi, $nguoiphutrach, $tinhtrang, $nguoncohoi, $ngaylienhe, $website, $khuvuc, $giadukien, $ngaychotdukien, $mota);

if ($stmt->execute()) {
    echo "Thêm khách hàng thành công!";
    // Chuyển hướng về trang Home_CHBH sau khi thêm thành công 
    header("Location: Home_CHBH.php");
    exit();
} else {
    echo "Lỗi: " . $stmt->error;
}

// Đóng kết nối
$stmt->close();
$conn->close();
