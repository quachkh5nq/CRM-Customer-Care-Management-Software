<?php
// Bao gồm file kết nối cơ sở dữ liệu
require 'db_conn.php';

// Lấy ID công việc từ yêu cầu POST
$idCongViec = isset($_POST['idCongViec']) ? $_POST['idCongViec'] : '';

// Kiểm tra xem ID công việc có giá trị không
if (empty($idCongViec)) {
    die("ID công việc không hợp lệ."); // Sử dụng die() để dừng mã thực thi
}

// Xóa công việc từ cơ sở dữ liệu
$sql = "DELETE FROM congviec WHERE Id_CongViec = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $idCongViec);

if ($stmt->execute()) {
    // Chuyển hướng sau khi xóa thành công
    header("Location: Home_CongViec.php");
    exit(); // Đảm bảo rằng không có mã thêm nào chạy sau khi chuyển hướng
} else {
    die("Lỗi: " . $stmt->error); // Sử dụng die() để dừng mã và hiển thị lỗi
}

$stmt->close();
$conn->close();
?>
