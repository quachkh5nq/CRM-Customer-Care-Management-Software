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
$id = $_POST['id'];
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

// Cập nhật dữ liệu
$sql = "UPDATE khachhangch SET Ten='$ten', TenCongTy='$tenCongTy', Email='$email', Phone='$phone', ChucVu='$chucVu', DiaChi='$diaChi', NguoiPhuTrach='$nguoiPhuTrach', TinhTrang='$tinhTrang', NguonCoHoi='$nguonCoHoi', NgayLienHe='$ngayLienHe', Website='$website', KhuVuc='$khuVuc', GiaDuKien='$giaDuKien', NgayChotDuKien='$ngayChotDuKien', MoTa='$moTa' WHERE Id_KHCH=$id";

if ($conn->query($sql) === TRUE) {
    echo "Cập nhật thành công!";
    header("Location: Home_CHBH.php"); // Chuyển hướng về trang Home_CHBH sau khi cập nhật
    exit();
} else {
    echo "Lỗi: " . $conn->error;
}

// Đóng kết nối
$conn->close();
?>
