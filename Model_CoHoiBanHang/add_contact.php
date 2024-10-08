<?php
// Bao gồm file kết nối cơ sở dữ liệu
require 'db_conn.php';

// Kiểm tra dữ liệu POST có tồn tại không
if (isset($_POST['id'], $_POST['hoTen'], $_POST['email'], $_POST['phone'])) {
    // Lấy dữ liệu từ POST và xử lý an toàn
    $id = intval($_POST['id']); // ID khách hàng từ URL
    $hoTen = $conn->real_escape_string($_POST['hoTen']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);

    // Thực thi truy vấn thêm liên hệ
    $sql = "INSERT INTO ct_lienhe (Id_KhachHang, HoTen, Email, Phone, NgayTao) 
            VALUES ($id, '$hoTen', '$email', '$phone', NOW())";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Thiếu dữ liệu đầu vào']);
}

// Đóng kết nối
$conn->close();
?>
