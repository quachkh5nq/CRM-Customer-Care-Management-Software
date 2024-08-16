<?php
// Kết nối đến cơ sở dữ liệu
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

// Xử lý form gửi dữ liệu
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $tenKhachHang = $_POST['name'];
    $lienHeChinh = $_POST['contact'];
    $trangWeb = $_POST['website'];
    $maSoThue = $_POST['taxcode'];
    $nhomKhachHang = $_POST['customer_group'];
    $diaChi = $_POST['address'];
    $khuVuc = $_POST['region'];
    $phone = $_POST['phone'];
    $donViTien = $_POST['currency'];
    $ngayThanhLap = $_POST['establishment_date'];
    $email = $_POST['email'];
    $trangThai = $_POST['status'];
    $nguoiPhuTrach = $_POST['person_in_charge'];
    $ngayTao = $_POST['created_date'];

    // Tạo câu lệnh SQL để chèn dữ liệu vào bảng khachhang
    $sql = "INSERT INTO khachhang (TenKhachHang, LienHeChinh, TrangWeb, MaSoThue, NhomKhachHang, DiaChi, KhuVuc, Phone, DonViTien, NgayThanhLap, Email, TrangThai, NguoiPhuTrach, NgayTao)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Chuẩn bị và liên kết
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssssss", $tenKhachHang, $lienHeChinh, $trangWeb, $maSoThue, $nhomKhachHang, $diaChi, $khuVuc, $phone, $donViTien, $ngayThanhLap, $email, $trangThai, $nguoiPhuTrach, $ngayTao);

    // Thực thi câu lệnh
    if ($stmt->execute()) {
        echo "Thêm mới khách hàng thành công!";
    } else {
        echo "Lỗi: " . $stmt->error;
    }

    // Đóng statement
    $stmt->close();
}

// Đóng kết nối
$conn->close();

// Chuyển hướng về trang Home_KhachHang.php
header("Location: Home_KhachHang.php");
exit();
?>
