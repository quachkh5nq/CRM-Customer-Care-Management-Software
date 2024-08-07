<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'db_crm';

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die('Kết nối cơ sở dữ liệu thất bại: ' . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy ID từ yêu cầu POST
    $id = $_POST['ID_LichCSKH'];

    // Xác thực ID để tránh SQL Injection
    if (is_numeric($id)) {
        // Chuẩn bị câu lệnh DELETE
        $sql = "DELETE FROM lichcskh WHERE ID_LichCSKH = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        // Thực hiện câu lệnh và kiểm tra kết quả
        if ($stmt->execute()) {
            // Xóa thành công, chuyển hướng về trang chính
            header('Location: Home_LichCSKH.php');
            exit();
        } else {
            echo "Lỗi khi xóa: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "ID không hợp lệ.";
    }

    $conn->close();
} else {
    header('HTTP/1.0 405 Method Not Allowed');
}
?>
