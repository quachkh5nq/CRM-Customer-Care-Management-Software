<?php
require 'db_conn.php'; // Đảm bảo đã có kết nối cơ sở dữ liệu

$data = [];

// Lấy dữ liệu cho combobox 'ThuocNhom'
$sql = "SELECT Id_NhomSanPham, TenNhom FROM nhomsanpham";
$result = $conn->query($sql);
$data['thuocNhom'] = [];
while ($row = $result->fetch_assoc()) {
    $data['thuocNhom'][] = $row;
}

// Lấy dữ liệu cho combobox 'DonVi'
$sql = "SELECT Id_NhomDonVi, TenDonVi FROM nhomdonvi";
$result = $conn->query($sql);
$data['donVi'] = [];
while ($row = $result->fetch_assoc()) {
    $data['donVi'][] = $row;
}

// Trả dữ liệu dưới dạng JSON
header('Content-Type: application/json');
echo json_encode($data);

$conn->close();
