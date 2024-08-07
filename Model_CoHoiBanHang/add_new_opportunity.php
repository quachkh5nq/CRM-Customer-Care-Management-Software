<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'db_crm';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die('Kết nối cơ sở dữ liệu thất bại.');
}

$title = $_POST['title'];
$status = $_POST['status'];
$source = $_POST['source'];
$expected_date = $_POST['expected-date'];
$send_to = implode(',', $_POST['send-to']); // Chuyển danh sách gửi đến thành chuỗi
$in_charge = $_POST['in-charge'];
$overall_status = $_POST['status'];

$sql = "INSERT INTO lichcskh (TieuDe, TinhTrangCoHoi, NguonCoHoi, NgayDuKien, GuiDen, HovaTen, TrangThai)
        VALUES ('$title', '$status', '$source', '$expected_date', '$send_to', '$in_charge', '$overall_status')";

if ($conn->query($sql) === TRUE) {
    header('Location: Home_LichCSKH.php');
} else {
    echo "Lỗi: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
