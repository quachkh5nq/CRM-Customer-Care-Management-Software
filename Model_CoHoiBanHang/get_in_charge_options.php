<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'db_crm';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Kết nối cơ sở dữ liệu thất bại.']));
}

$sql = "SELECT HovaTen FROM nhanvien";
$result = $conn->query($sql);

$options = [];
while ($row = $result->fetch_assoc()) {
    $options[] = ['value' => $row['HovaTen'], 'text' => $row['HovaTen']];
}

$conn->close();
echo json_encode($options);
?>
