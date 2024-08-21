<?php
require 'db_conn.php';

// Kiểm tra xem có dữ liệu gửi từ form không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy thông tin từ form
    $idSanPham = $_POST['Id_SanPham'];
    $tenSanPham = $_POST['TenSanPham'];
    $moTa = $_POST['MoTa'];
    $gia = $_POST['Gia'];
    $thuocNhom = $_POST['ThuocNhom'];
    $donVi = $_POST['DonVi'];
    $kho = $_POST['Kho'];
    
    // Xử lý ảnh
    if (isset($_FILES['Anh']) && $_FILES['Anh']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["Anh"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        // Kiểm tra loại tệp ảnh
        $check = getimagesize($_FILES["Anh"]["tmp_name"]);
        if ($check === false) {
            echo "Tệp không phải là ảnh.";
            $uploadOk = 0;
        }
        
        // Kiểm tra kích thước tệp
        if ($_FILES["Anh"]["size"] > 5000000) {
            echo "Ảnh quá lớn.";
            $uploadOk = 0;
        }
        
        // Chỉ cho phép các định dạng ảnh nhất định
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Chỉ cho phép JPG, JPEG, PNG và GIF.";
            $uploadOk = 0;
        }
        
        // Kiểm tra nếu $uploadOk bằng 0 do lỗi
        if ($uploadOk == 0) {
            echo "Ảnh không được tải lên.";
            $anh = $_POST['current_anh']; // Giữ lại ảnh cũ nếu không tải lên được ảnh mới
        } else {
            if (move_uploaded_file($_FILES["Anh"]["tmp_name"], $target_file)) {
                $anh = $target_file;
            } else {
                echo "Lỗi khi tải ảnh lên.";
                $anh = $_POST['current_anh']; // Giữ lại ảnh cũ nếu có lỗi khi tải ảnh mới
            }
        }
    } else {
        $anh = $_POST['current_anh']; // Giữ lại ảnh cũ nếu không có ảnh mới
    }

    // Cập nhật dữ liệu
    $sql = "UPDATE sanpham 
            SET TenSanPham = ?, MoTa = ?, Gia = ?, ThuocNhom = ?, DonVi = ?, Kho = ?, Anh = ? 
            WHERE Id_SanPham = ?";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Lỗi chuẩn bị câu lệnh SQL: " . $conn->error);
    }

    // Liên kết các tham số với câu lệnh SQL
    $stmt->bind_param("ssiiisss", $tenSanPham, $moTa, $gia, $thuocNhom, $donVi, $kho, $anh, $idSanPham);

    // Thực thi câu lệnh
    if ($stmt->execute()) {
        header("Location: Home_SanPham.php");
    } else {
        echo "Lỗi: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
