<?php
// Bao gồm file kết nối cơ sở dữ liệu
require 'db_conn.php';

$sql = "SELECT Ten FROM khachhangch";
$result = $conn->query($sql);

$options = [];
while ($row = $result->fetch_assoc()) {
    $options[] = ['value' => $row['Ten'], 'text' => $row['Ten']];
}

$conn->close();
echo json_encode($options);
?>
