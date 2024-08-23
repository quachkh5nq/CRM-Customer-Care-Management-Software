<?php
// Bao gồm file kết nối cơ sở dữ liệu
require 'db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idCongViec = isset($_POST['idCongViec']) ? $_POST['idCongViec'] : '';
    $tenCongViec = isset($_POST['tenCongViec']) ? $_POST['tenCongViec'] : '';
    $moTaCongViec = isset($_POST['moTaCongViec']) ? $_POST['moTaCongViec'] : '';
    $ngayBatDau = isset($_POST['ngayBatDau']) ? $_POST['ngayBatDau'] : '';
    $ngayKetThuc = isset($_POST['ngayKetThuc']) ? $_POST['ngayKetThuc'] : '';
    $tinhTrang = isset($_POST['tinhTrang']) ? $_POST['tinhTrang'] : '';
    $mucDo = isset($_POST['mucDo']) ? $_POST['mucDo'] : '';
    $lienQuanDenId = isset($_POST['lienQuanDen']) ? $_POST['lienQuanDen'] : '';
    $nguoiThucHienIds = isset($_POST['nguoiThucHien']) ? $_POST['nguoiThucHien'] : [];

    if (!empty($lienQuanDenId)) {
        // Lấy tên "Liên Quan Đến" từ Id
        $sql = "SELECT TenLienQuanDen FROM ct_lienquanden WHERE Id_LienQuanDen = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $lienQuanDenId);
        $stmt->execute();
        $stmt->bind_result($tenLienQuanDen);
        $stmt->fetch();
        $stmt->close();
    } else {
        $tenLienQuanDen = ''; // Trường hợp Id không tồn tại hoặc trống
    }

    // Lấy tên "Người Thực Hiện" hiện tại từ cơ sở dữ liệu nếu không có cập nhật từ người dùng
    if (empty($nguoiThucHienIds)) {
        $sql = "SELECT NguoiThucHien FROM congviec WHERE Id_CongViec = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $idCongViec);
        $stmt->execute();
        $stmt->bind_result($tenNguoiThucHien);
        $stmt->fetch();
        $stmt->close();
    } else {
        // Lấy tên "Người Thực Hiện" từ các Id nếu có cập nhật từ người dùng
        $tenNguoiThucHienArr = [];
        foreach ($nguoiThucHienIds as $id) {
            $sql = "SELECT HovaTen FROM nhanvien WHERE Id_NhanVien = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->bind_result($hovaTen);
            $stmt->fetch();
            $tenNguoiThucHienArr[] = $hovaTen;
            $stmt->close();
        }
        $tenNguoiThucHien = implode(', ', $tenNguoiThucHienArr);
    }

    // Cập nhật công việc
    $sql = "UPDATE congviec SET TenCongViec = ?, MoTaCongViec = ?, NgayBatDau = ?, NgayKetThuc = ?, LienQuanDen = ?, TinhTrang = ?, NguoiThucHien = ?, MucDo = ? WHERE Id_CongViec = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssssssi', $tenCongViec, $moTaCongViec, $ngayBatDau, $ngayKetThuc, $tenLienQuanDen, $tinhTrang, $tenNguoiThucHien, $mucDo, $idCongViec);

    if ($stmt->execute()) {
        echo "Cập nhật công việc thành công.";
        header("Location: Home_CongViec.php");
        exit();
    } else {
        echo "Có lỗi xảy ra khi cập nhật công việc: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
