<?php
require 'db_conn.php'; // Kết nối cơ sở dữ liệu

$response = array('status' => 'error', 'message' => 'Có lỗi xảy ra.');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['idNhomDonVi'])) {
        $idNhomDonVi = $conn->real_escape_string($_POST['idNhomDonVi']);

        $sql = "DELETE FROM nhomdonvi WHERE Id_NhomDonVi = '$idNhomDonVi'";

        if ($conn->query($sql) === TRUE) {
            $response = array('status' => 'success', 'message' => 'Xóa nhóm đơn vị thành công!');
        } else {
            $response['message'] = "Lỗi: " . $conn->error;
        }
    } else {
        $response['message'] = "ID nhóm đơn vị không được cung cấp.";
    }

    $conn->close();
}

echo json_encode($response);
?>
