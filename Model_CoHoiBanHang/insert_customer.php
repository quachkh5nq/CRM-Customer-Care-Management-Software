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

// Lấy dữ liệu từ form
$ten = $_POST['name'];
$tenCongTy = $_POST['company'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$chucVu = $_POST['chucvu'];
$diaChi = $_POST['diachi'];
$nguoiPhuTrach = $_POST['nguoiphutrach'];
$tinhTrang = $_POST['tinhtrang'];
$nguonCoHoi = $_POST['nguoncohoi'];
$ngayLienHe = $_POST['ngaylienhe'];
$website = $_POST['website'];
$khuVuc = $_POST['khuvuc'];
$giaDuKien = $_POST['giadukien'];
$ngayChotDuKien = $_POST['ngaychotdukien'];
$moTa = $_POST['mota'];

// Chèn dữ liệu vào bảng khachhangch
$sql = "INSERT INTO khachhangch (Ten, TenCongTy, Email, Phone, ChucVu, DiaChi, NguoiPhuTrach, TinhTrang, NguonCoHoi, NgayLienHe, Website, KhuVuc, GiaDuKien, NgayChotDuKien, MoTa)
        VALUES ('$ten', '$tenCongTy', '$email', '$phone', '$chucVu', '$diaChi', '$nguoiPhuTrach', '$tinhTrang', '$nguonCoHoi', '$ngayLienHe', '$website', '$khuVuc', '$giaDuKien', '$ngayChotDuKien', '$moTa')";

if ($conn->query($sql) === TRUE) {
    echo "Thêm mới thành công!";
    // Chuyển hướng về trang Home_CHBH sau khi thêm thành công
    header("Location: Home_CHBH.php");
    exit();
} else {
    echo "Lỗi: " . $sql . "<br>" . $conn->error;
}

// Đóng kết nối
$conn->close();
?>
