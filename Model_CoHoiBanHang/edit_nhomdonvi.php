<?php
require 'db_conn.php'; // Kết nối cơ sở dữ liệu

$response = array('status' => 'error', 'message' => 'Có lỗi xảy ra.');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['idNhom']) && isset($_POST['tenDonVi']) && isset($_POST['moTa'])) {
        $idNhom = $conn->real_escape_string($_POST['idNhom']);
        $tenDonVi = $conn->real_escape_string($_POST['tenDonVi']);
        $moTa = $conn->real_escape_string($_POST['moTa']);

        $sql = "UPDATE nhomdonvi SET TenDonVi = '$tenDonVi', MoTa = '$moTa' WHERE Id_NhomDonVi = '$idNhom'";

        if ($conn->query($sql) === TRUE) {
            $response = array('status' => 'success', 'message' => 'Cập nhật đơn vị thành công!');
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
