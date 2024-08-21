<?php
// Bao gồm file kết nối cơ sở dữ liệu
require 'db_conn.php';

$sql = "SELECT HovaTen FROM nhanvien";
$result = $conn->query($sql);

$options = [];
while ($row = $result->fetch_assoc()) {
    $options[] = ['value' => $row['HovaTen'], 'text' => $row['HovaTen']];
}

$conn->close();
echo json_encode($options);
?>
