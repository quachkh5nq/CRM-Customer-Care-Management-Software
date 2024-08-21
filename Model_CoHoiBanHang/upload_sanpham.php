<?php
include 'db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tenSanPham = $_POST['tenSanPham'];
    $moTa = $_POST['moTa'];
    $giaSanPham = $_POST['giaSanPham'];
    $thuocNhom = $_POST['thuocNhom'];
    $donVi = $_POST['donVi'];
    $kho = $_POST['kho'];

    // Xử lý upload ảnh
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["anhSanPham"]["name"]);
    move_uploaded_file($_FILES["anhSanPham"]["tmp_name"], $target_file);
    
    $anhSanPham = $target_file; // Lưu toàn bộ đường dẫn ảnh

    // Thêm sản phẩm vào cơ sở dữ liệu
    $sql = "INSERT INTO sanpham (TenSanPham, MoTa, Anh, Gia, ThuocNhom, DonVi, Kho)
            VALUES ('$tenSanPham', '$moTa', '$anhSanPham', '$giaSanPham', '$thuocNhom', '$donVi', '$kho')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Sản phẩm mới đã được thêm thành công!";
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
}
?>
