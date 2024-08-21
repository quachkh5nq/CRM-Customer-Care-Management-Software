<?php
require 'db_conn.php'; // Kết nối cơ sở dữ liệu

$response = array('status' => 'error', 'message' => 'Có lỗi xảy ra.');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tenDonVi = $conn->real_escape_string($_POST['tenDonVi']);
    $moTa = $conn->real_escape_string($_POST['moTa']);

    $sql = "INSERT INTO nhomdonvi (TenDonVi, MoTa) VALUES ('$tenDonVi', '$moTa')";

    if ($conn->query($sql) === TRUE) {
        $response = array('status' => 'success', 'message' => 'Thêm mới nhóm đơn vị thành công!');
    } else {
        $response['message'] = "Lỗi: " . $conn->error;
    }

    $conn->close();
}

echo json_encode($response);
?>
