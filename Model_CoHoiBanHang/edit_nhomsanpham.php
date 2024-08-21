<?php
require 'db_conn.php'; // Kết nối cơ sở dữ liệu

$response = array('status' => 'error', 'message' => 'Có lỗi xảy ra.');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['idNhom']) && isset($_POST['tenNhom']) && isset($_POST['moTa'])) {
        $idNhom = $conn->real_escape_string($_POST['idNhom']);
        $tenNhom = $conn->real_escape_string($_POST['tenNhom']);
        $moTa = $conn->real_escape_string($_POST['moTa']);

        $sql = "UPDATE nhomsanpham SET TenNhom = '$tenNhom', MoTa = '$moTa' WHERE Id_NhomSanPham = '$idNhom'";

        if ($conn->query($sql) === TRUE) {
            $response = array('status' => 'success', 'message' => 'Cập nhật nhóm sản phẩm thành công!');
        } else {
            $response['message'] = "Lỗi: " . $conn->error;
        }
    } else {
        $response['message'] = "Thiếu thông tin cần thiết.";
    }

    $conn->close();
}

echo json_encode($response);
?>
