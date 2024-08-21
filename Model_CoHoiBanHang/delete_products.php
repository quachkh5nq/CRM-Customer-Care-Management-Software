<?php
require 'db_conn.php'; // Đảm bảo đã có kết nối cơ sở dữ liệu

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete'])) {
        // Lấy danh sách ID sản phẩm cần xóa
        $idsToDelete = $_POST['ids'];

        if (empty($idsToDelete)) {
            echo "Không có sản phẩm nào được chọn để xóa.";
            exit();
        }

        // Tạo câu lệnh SQL để xóa sản phẩm
        $placeholders = implode(',', array_fill(0, count($idsToDelete), '?'));
        $sql = "DELETE FROM sanpham WHERE Id_SanPham IN ($placeholders)";

        // Chuẩn bị và thực thi câu lệnh
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("Lỗi chuẩn bị câu lệnh SQL: " . $conn->error);
        }

        // Liên kết tham số
        $stmt->bind_param(str_repeat('i', count($idsToDelete)), ...$idsToDelete);

        if ($stmt->execute()) {
            echo "Sản phẩm đã được xóa thành công.";
        } else {
            echo "Lỗi: " . $stmt->error;
        }

        // Đóng statement và kết nối
        $stmt->close();
        $conn->close();
        
        // Chuyển hướng về trang danh sách sản phẩm
        header("Location: Home_SanPham.php");
        exit();
    }
}
?>
