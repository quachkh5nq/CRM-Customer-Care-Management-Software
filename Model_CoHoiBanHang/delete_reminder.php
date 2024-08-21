<?php
// Bao gồm file kết nối cơ sở dữ liệu
require 'db_conn.php';

// Lấy ID từ POST
$id_nhacnhokhch = isset($_POST['id_nhacnhokhch']) ? $_POST['id_nhacnhokhch'] : null;

if ($id_nhacnhokhch && is_numeric($id_nhacnhokhch)) {
    // Lấy Id_KHCH từ nhắc nhở trước khi xóa
    $sql = "SELECT Id_KHCH FROM nhacnhokhch WHERE Id_nhacnhokhch = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_nhacnhokhch);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_khch = $row['Id_KHCH'];
        
        // Xóa nhắc nhở
        $sql = "DELETE FROM nhacnhokhch WHERE Id_nhacnhokhch = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_nhacnhokhch);
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) {
            // Xóa thành công
            header("Location: Check_Cohoi.php?id=$id_khch&message=delete_success");
        } else {
            // Xóa không thành công
            header("Location: Check_Cohoi.php?id=$id_khch&message=delete_error");
        }
    } else {
        // Không tìm thấy nhắc nhở
        header("Location: Check_Cohoi.php?message=delete_error");
    }

    $stmt->close();
} else {
    die("ID không hợp lệ.");
}

$conn->close();
?>
