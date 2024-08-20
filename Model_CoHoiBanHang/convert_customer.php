<?php
// Kết nối cơ sở dữ liệu
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'db_crm';

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy ID khách hàng cơ hội từ yêu cầu POST
$customerId = $_POST['Id_KHCH'];

// Lấy thông tin khách hàng cơ hội từ bảng khachhangch
$sql = "SELECT TenCongTy, Email, Phone, NguoiPhuTrach, Website, DiaChi, KhuVuc FROM khachhangch WHERE Id_KHCH = $customerId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Lấy dữ liệu từ bảng khachhangch
    $row = $result->fetch_assoc();
    
    // Chuẩn bị câu lệnh INSERT vào bảng khachhang
    $sql_insert = "INSERT INTO khachhang (TenKhachHang, Email, Phone, NguoiPhuTrach, TrangWeb, DiaChi, KhuVuc) 
                   VALUES ('" . $row['TenCongTy'] . "', '" . $row['Email'] . "', '" . $row['Phone'] . "', '" . $row['NguoiPhuTrach'] . "', '" . $row['Website'] . "', '" . $row['DiaChi'] . "', '" . $row['KhuVuc'] . "')";
    
    if ($conn->query($sql_insert) === TRUE) {
        // Xóa khách hàng cơ hội khỏi bảng khachhangch
        $sql_delete = "DELETE FROM khachhangch WHERE Id_KHCH = $customerId";
        if ($conn->query($sql_delete) === TRUE) {
            echo "Chuyển đổi thành công!";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    } else {
        echo "Error inserting record: " . $conn->error;
    }
} else {
    echo "Không tìm thấy khách hàng cơ hội!";
}

$conn->close();
?>
