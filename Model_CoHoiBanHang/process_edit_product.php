<?php
// Bao gồm file kết nối cơ sở dữ liệu
require 'db_conn.php';

// Lấy dữ liệu từ form
$idHoaDon = isset($_POST['Id_HoaDon']) ? intval($_POST['Id_HoaDon']) : 0;
$idKhachHang = isset($_POST['Id_KhachHang']) ? intval($_POST['Id_KhachHang']) : 0;
$idCthoaDon = isset($_POST['Id_CTHoaDon']) ? intval($_POST['Id_CTHoaDon']) : 0;
$tenSanPham = isset($_POST['TenSanPham']) ? $_POST['TenSanPham'] : ''; // Đảm bảo là chuỗi không phải số
$moTa = isset($_POST['MoTa']) ? $_POST['MoTa'] : '';
$gia = isset($_POST['Gia']) ? floatval($_POST['Gia']) : 0;
$soLuong = isset($_POST['SoLuong']) ? intval($_POST['SoLuong']) : 0;
$tienThue = isset($_POST['TienThue']) ? floatval($_POST['TienThue']) : 0;

// Tính toán tổng tiền
$tongTien = ($gia * $soLuong) + ($gia * $soLuong * $tienThue);

// Cập nhật thông tin sản phẩm vào cơ sở dữ liệu
$sql = "UPDATE ct_hoadon SET 
        TenSanPham = ?, 
        MoTa = ?, 
        Gia = ?, 
        SoLuong = ?, 
        TienThue = ?, 
        TongTien = ?
        WHERE Id_CTHoaDon = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssddddi", $tenSanPham, $moTa, $gia, $soLuong, $tienThue, $tongTien, $idCthoaDon);

if ($stmt->execute()) {
    // Cập nhật thành công, chuyển hướng về trang Check_HoaDon.php với Id_HoaDon
    header('Location: Check_HoaDon.php?id=' . $idHoaDon);
    exit();
} else {
    // Xảy ra lỗi, thông báo lỗi
    echo "Có lỗi xảy ra trong quá trình cập nhật.";
}

// Đóng kết nối
$stmt->close();
$conn->close();
?>
