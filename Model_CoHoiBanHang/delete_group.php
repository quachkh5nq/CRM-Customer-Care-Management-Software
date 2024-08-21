<?php
require 'db_conn.php'; // Kết nối cơ sở dữ liệu

$response = array('status' => 'error', 'message' => 'Có lỗi xảy ra.');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['idNhom'])) {
        $idNhom = $conn->real_escape_string($_POST['idNhom']);

        $sql = "DELETE FROM nhomsanpham WHERE Id_NhomSanPham = '$idNhom'";

        if ($conn->query($sql) === TRUE) {
            $response = array('status' => 'success', 'message' => 'Xóa nhóm sản phẩm thành công!');
        } else {
            $response['message'] = "Lỗi: " . $conn->error;
        }
    } else {
        $response['message'] = "ID nhóm sản phẩm không được cung cấp.";
    }

    $conn->close();
}

echo json_encode($response);
?>
