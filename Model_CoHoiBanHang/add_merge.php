<?php
// Bao gồm file kết nối cơ sở dữ liệu
require 'db_conn.php';

// Lấy thông tin hợp đồng từ POST
$Id_khachhang = $_POST['Id_khachhang'];
$TenHopDong = $_POST['TenMerge']; // Sửa tên trường
$LoaiHopDong = $_POST['LoaiMerge']; // Sửa tên trường
$GiaTriHopDong = $_POST['GiaTriMerge']; // Sửa tên trường
$NgayBatDau = $_POST['NgayBatDau'];
$NgayKetThuc = $_POST['NgayKetThuc'];
$ChuKy = $_POST['ChuKy'];

// Kiểm tra Ngày Kết Thúc phải lớn hơn Ngày Bắt Đầu
if (strtotime($NgayKetThuc) <= strtotime($NgayBatDau)) {
    die("Lỗi: Ngày Kết Thúc phải lớn hơn Ngày Bắt Đầu.");
}

// Lấy mã hợp đồng lớn nhất hiện tại và tăng lên
$sql_max_mahd = "SELECT Id_HopDong FROM hopdong ORDER BY Id_HopDong DESC LIMIT 1";
$result_max_mahd = $conn->query($sql_max_mahd);

if ($result_max_mahd->num_rows > 0) {
    $row_max_mahd = $result_max_mahd->fetch_assoc();
    $new_mahd_number = $row_max_mahd['Id_HopDong'] + 1;
} else {
    $new_mahd_number = 1; // Nếu không có hợp đồng nào, bắt đầu từ 1
}

// Chèn hợp đồng mới vào bảng
$sql_insert = "INSERT INTO hopdong (Id_khachhang, TenHopDong, LoaiHopDong, GiaTriHopDong, NgayBatDau, NgayKetThuc, ChuKy) 
               VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql_insert);
$stmt->bind_param("issdsss", $Id_khachhang, $TenHopDong, $LoaiHopDong, $GiaTriHopDong, $NgayBatDau, $NgayKetThuc, $ChuKy);

if ($stmt->execute()) {
    echo "Thêm hợp đồng thành công!";
} else {
    echo "Lỗi: " . $stmt->error;
}

// Đóng kết nối và chuyển hướng về trang chi tiết khách hàng
$stmt->close();
$conn->close();
header("Location: Check_KhachHang.php?id=$Id_khachhang");
exit;
?>
