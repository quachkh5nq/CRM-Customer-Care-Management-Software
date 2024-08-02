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
    echo json_encode(['status' => 'error', 'message' => 'Kết nối cơ sở dữ liệu thất bại.']);
    exit();
}

// Kiểm tra nếu tệp được tải lên
if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] == 0) {
    $file = $_FILES['fileToUpload']['tmp_name'];
    $handle = fopen($file, "r");
    if ($handle !== FALSE) {
        // Đọc từng dòng của tệp CSV
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            // Lấy dữ liệu từ mỗi dòng và gán vào các biến tương ứng
            $ten = $data[0]; // Tên khách hàng
            $tenCongTy = $data[1]; // Tên công ty
            $email = $data[2]; // Địa chỉ email
            $phone = $data[3]; // Số điện thoại
            $chucVu = $data[4]; // Chức vụ
            $diaChi = $data[5]; // Địa chỉ
            $nguoiPhuTrach = $data[6]; // Người phụ trách
            $tinhTrang = $data[7]; // Tình trạng
            $nguonCoHoi = $data[8]; // Nguồn cơ hội
            $ngayLienHe = $data[9]; // Ngày liên hệ
            $website = $data[10]; // Website
            $khuVuc = $data[11]; // Khu vực
            $giaDuKien = $data[12]; // Giá dự kiến
            $ngayChotDuKien = $data[13]; // Ngày chốt dự kiến
            $moTa = $data[14]; // Mô tả

            // Tạo câu truy vấn SQL để chèn dữ liệu vào bảng khachhangch
            $sql = "INSERT INTO khachhangch (Ten, TenCongTy, Email, Phone, ChucVu, DiaChi, NguoiPhuTrach, TinhTrang, NguonCoHoi, NgayLienHe, Website, KhuVuc, GiaDuKien, NgayChotDuKien, MoTa) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            // Chuẩn bị và thực thi câu lệnh
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("sssssssssssssss", $ten, $tenCongTy, $email, $phone, $chucVu, $diaChi, $nguoiPhuTrach, $tinhTrang, $nguonCoHoi, $ngayLienHe, $website, $khuVuc, $giaDuKien, $ngayChotDuKien, $moTa);
                $stmt->execute();
            }
        }
        // Đóng tệp
        fclose($handle);
        echo json_encode(['status' => 'success', 'message' => 'Dữ liệu đã được nhập thành công.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Không thể mở tệp CSV.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Không có tệp nào được tải lên hoặc xảy ra lỗi khi tải lên.']);
}

// Đóng kết nối cơ sở dữ liệu
$conn->close();
?>
