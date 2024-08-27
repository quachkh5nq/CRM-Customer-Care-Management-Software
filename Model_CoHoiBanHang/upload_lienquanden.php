<?php
// Bao gồm file kết nối cơ sở dữ liệu
require 'db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tenLienQuanDen = $_POST['TenLienQuanDen'];

    $sql = "INSERT INTO ct_lienquanden (TenLienQuanDen) VALUES ('$tenLienQuanDen')";

    if ($conn->query($sql) === TRUE) {
        header("Location: Home_CongViec.php");
        echo "Thêm nhóm liên quan thành công";
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
