<?php
// Bao gồm file kết nối cơ sở dữ liệu
require 'db_conn.php';

// Lấy dữ liệu từ POST
$id_nhacnhokhch = isset($_POST['id_nhacnhokhch']) ? $_POST['id_nhacnhokhch'] : null;
$noi_dung = isset($_POST['noi_dung']) ? $_POST['noi_dung'] : '';
$ngay_nhac = isset($_POST['ngay_nhac']) ? $_POST['ngay_nhac'] : '';
$gui_den = isset($_POST['gui_den']) ? $_POST['gui_den'] : '';
$trang_thai = isset($_POST['trang_thai']) ? $_POST['trang_thai'] : '';

if ($id_nhacnhokhch && is_numeric($id_nhacnhokhch)) {
    // Cập nhật nhắc nhở
    $sql = "UPDATE nhacnhokhch SET NoiDung = ?, NgayNhac = ?, GuiDen = ?, TrangThaiThongBao = ? WHERE Id_nhacnhokhch = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssii", $noi_dung, $ngay_nhac, $gui_den, $trang_thai, $id_nhacnhokhch);
    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
        // Lấy Id_KHCH từ nhắc nhở sau khi cập nhật thành công
        $sql = "SELECT Id_KHCH FROM nhacnhokhch WHERE Id_nhacnhokhch = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_nhacnhokhch);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $id_khch = $row['Id_KHCH'];

        // Cập nhật thành công
        header("Location: Check_Cohoi.php?id=$id_khch&message=update_success");
    } else {
        // Cập nhật không thành công hoặc không có thay đổi
        header("Location: Check_Cohoi.php?id=$id_khch&message=update_error");
    }

    $stmt->close();
} else {
    die("ID không hợp lệ.");
}

$conn->close();
?>
 