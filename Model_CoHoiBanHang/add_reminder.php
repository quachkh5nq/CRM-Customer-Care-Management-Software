<?php
// Bao gồm file kết nối cơ sở dữ liệu
require 'db_conn.php';



// Nhận dữ liệu từ form
$id_khch = $_POST['id_khch'];
$noi_dung = $_POST['noi_dung'];
$ngay_nhac = $_POST['ngay_nhac'];
$gui_den = $_POST['gui_den'];
$trang_thai = $_POST['trang_thai'];

// Thêm nhắc nhở vào cơ sở dữ liệu
$sql = "INSERT INTO nhacnhokhch (Id_KHCH, NoiDung, NgayNhac, GuiDen, TrangThaiThongBao) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("issss", $id_khch, $noi_dung, $ngay_nhac, $gui_den, $trang_thai);

if ($stmt->execute()) {
    // Redirect về trang Check_Cohoi.php với ID và thông báo thành công
    header("Location: Check_Cohoi.php?id=" . $id_khch . "&msg=success");
    exit();
} else {
    // Redirect về trang Check_Cohoi.php với ID và thông báo lỗi
    header("Location: Check_Cohoi.php?id=" . $id_khch . "&msg=error");
    exit();
}

$stmt->close();
$conn->close();
?>
