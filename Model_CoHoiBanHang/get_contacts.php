<?php
// Bao gồm file kết nối cơ sở dữ liệu
require 'db_conn.php';

// Lấy id khách hàng từ tham số URL
$customerId = intval($_GET['id']);

// Câu lệnh SQL để lấy thông tin liên hệ chính từ bảng khách hàng
$sqlMainContact = "SELECT `LienHeChinh`, `Email`, `Phone`, `NgayTao` FROM `khachhang` WHERE `Id_khachhang` = ?";
$stmt = $conn->prepare($sqlMainContact);
$stmt->bind_param("i", $customerId);
$stmt->execute();
$result = $stmt->get_result();

// Nếu có kết quả, lấy thông tin liên hệ chính
$mainContact = null;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $mainContact = [
        'Id_LienHe' => $customerId, // Dùng Id_khachhang làm Id_LienHe cho liên hệ chính
        'HoTen' => $row['LienHeChinh'],
        'Email' => $row['Email'],
        'Phone' => $row['Phone'],
        'NgayTao' => $row['NgayTao']
    ];
}

// Câu lệnh SQL để lấy các liên hệ từ bảng ct_lienhe
$sqlContacts = "SELECT `Id_LienHe`, `HoTen`, `Email`, `Phone`, `NgayTao` FROM `ct_lienhe` WHERE `Id_KhachHang` = ?";
$stmt = $conn->prepare($sqlContacts);
$stmt->bind_param("i", $customerId);
$stmt->execute();
$result = $stmt->get_result();

// Tạo mảng để chứa dữ liệu liên hệ
$contacts = [];
while ($row = $result->fetch_assoc()) {
    $contacts[] = $row;
}

// Đóng kết nối
$stmt->close();
$conn->close();

// Tạo mảng kết quả với liên hệ chính ở đầu và các liên hệ khác tiếp theo
$response = [];
if ($mainContact) {
    $response[] = $mainContact;
}
$response = array_merge($response, $contacts);

// Xuất dữ liệu dưới dạng JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
