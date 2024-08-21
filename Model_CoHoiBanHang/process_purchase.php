<?php
// Bao gồm file kết nối cơ sở dữ liệu
require 'db_conn.php';

// Lấy dữ liệu từ form
$idHoaDon = isset($_POST['Id_HoaDon']) ? intval($_POST['Id_HoaDon']) : 0;
$idKhachHang = isset($_POST['Id_KhachHang']) ? intval($_POST['Id_KhachHang']) : 0;
$idSanPham = isset($_POST['TenSanPham']) ? intval($_POST['TenSanPham']) : 0; // Lấy ID sản phẩm từ form
$moTa = isset($_POST['MoTa']) ? trim($_POST['MoTa']) : '';
$gia = isset($_POST['Gia']) ? floatval($_POST['Gia']) : 0;
$soLuong = isset($_POST['SoLuong']) ? intval($_POST['SoLuong']) : 1;
$tienThue = isset($_POST['TienThue']) ? floatval($_POST['TienThue']) : 0;
$tongTien = isset($_POST['TongTien']) ? floatval($_POST['TongTien']) : 0;

// Kiểm tra xem có sản phẩm được chọn hay không
if ($idHoaDon > 0 && $idKhachHang > 0 && $idSanPham > 0 && $soLuong > 0 && $tongTien > 0) {
    // Truy vấn để lấy tên sản phẩm từ bảng sản phẩm dựa trên ID sản phẩm
    $sql_get_product_name = "SELECT TenSanPham FROM sanpham WHERE Id_SanPham = ?";
    $stmt = $conn->prepare($sql_get_product_name);
    $stmt->bind_param('i', $idSanPham);
    $stmt->execute();
    $stmt->bind_result($tenSanPham);
    $stmt->fetch();
    $stmt->close();

    // Nếu không tìm thấy sản phẩm, hiển thị thông báo lỗi
    if (empty($tenSanPham)) {
        echo "Sản phẩm không tồn tại.";
        exit();
    }

    // Thực hiện chèn dữ liệu vào bảng chi tiết hóa đơn
    $sql_insert = "INSERT INTO ct_hoadon (Id_HoaDon, Id_KhachHang, TenSanPham, MoTa, SoLuong, Gia, TienThue, TongTien) 
                   VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Chuẩn bị và liên kết
    $stmt = $conn->prepare($sql_insert);
    $stmt->bind_param('iissdddd', $idHoaDon, $idKhachHang, $tenSanPham, $moTa, $soLuong, $gia, $tienThue, $tongTien);

    // Thực thi
    if ($stmt->execute()) {
        // Chèn thành công, chuyển hướng về trang Check_HoaDon.php
        header("Location: Check_HoaDon.php?id=" . $idHoaDon);
        exit(); // Đảm bảo không còn mã nào chạy sau khi chuyển hướng
    } else {
        // Lỗi khi chèn dữ liệu
        echo "Lỗi: " . $stmt->error;
    }

    // Đóng statement
    $stmt->close();
} else {
    // Dữ liệu không hợp lệ
    echo "Dữ liệu không hợp lệ. Vui lòng kiểm tra lại.";
}

// Đóng kết nối
$conn->close();
?>
