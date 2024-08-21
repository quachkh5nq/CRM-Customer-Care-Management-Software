<?php
// Bao gồm file kết nối cơ sở dữ liệu
require 'db_conn.php';

// Xử lý form gửi dữ liệu
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $tenSanPham = $_POST['TenSanPham'];
    $moTa = $_POST['MoTa'];
    $gia = $_POST['Gia'];
    $thuocNhomId = $_POST['ThuocNhom'];
    $donViId = $_POST['DonVi'];
    $kho = $_POST['Kho'];

    // Xử lý ảnh
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true); // Tạo thư mục nếu chưa tồn tại
    }
    $target_file = $target_dir . basename($_FILES["Anh"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Kiểm tra loại tệp ảnh
    $check = getimagesize($_FILES["Anh"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "Tệp không phải là ảnh.";
        $uploadOk = 0;
    }

    // Kiểm tra kích thước tệp
    if ($_FILES["Anh"]["size"] > 5000000) { // 5MB
        echo "Xin lỗi, ảnh của bạn quá lớn.";
        $uploadOk = 0;
    }

    // Chỉ cho phép các định dạng ảnh nhất định
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Xin lỗi, chỉ cho phép các định dạng ảnh JPG, JPEG, PNG và GIF.";
        $uploadOk = 0;
    }

    // Kiểm tra nếu $uploadOk bằng 0 do lỗi
    if ($uploadOk == 0) {
        echo "Xin lỗi, ảnh của bạn không được tải lên.";
        $Anh = null; // Đặt giá trị ảnh là null nếu không tải lên được
    } else {
        if (move_uploaded_file($_FILES["Anh"]["tmp_name"], $target_file)) {
            $Anh = $target_file; // Đặt đường dẫn ảnh vào biến $Anh
        } else {
            echo "Xin lỗi, đã xảy ra lỗi khi tải ảnh của bạn lên.";
            $Anh = null;
        }
    }

    // Tạo câu lệnh SQL để chèn dữ liệu vào bảng sanpham
    $sql = "INSERT INTO sanpham (TenSanPham, MoTa, Anh, Gia, ThuocNhom, DonVi, Kho)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Chuẩn bị và liên kết
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Lỗi chuẩn bị câu lệnh SQL (Chèn Sản Phẩm): " . $conn->error);
    }
    $stmt->bind_param("sssisss", $tenSanPham, $moTa, $Anh, $gia, $thuocNhomId, $donViId, $kho);

    // Thực thi câu lệnh
    if ($stmt->execute()) {
        // Đóng statement
        $stmt->close();
        // Đóng kết nối
        $conn->close();
        // Chuyển hướng về trang Home_SanPham.php
        header("Location: Home_SanPham.php");
        exit();
    } else {
        echo "Lỗi: " . $stmt->error;
    }

    // Đóng statement và kết nối nếu có lỗi
    $stmt->close();
    $conn->close();
}
?>
