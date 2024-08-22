<?php
require 'db_conn.php';

$response = ['status' => 'error', 'message' => 'Có lỗi xảy ra trong quá trình nhập dữ liệu.'];

if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] == 0) {
    $file = $_FILES['fileToUpload']['tmp_name'];
    $handle = fopen($file, "r");
    if ($handle !== FALSE) {
        // Đọc dòng đầu tiên (nếu có tiêu đề cột)
        fgetcsv($handle);

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $tenSanPham = $data[0];
            $moTa = $data[1];
            $anh = $data[2];
            $gia = $data[3];
            $thuocNhom = $data[4];
            $donVi = $data[5];
            $kho = $data[6];

            $sql = "INSERT INTO sanpham (TenSanPham, MoTa, Anh, Gia, ThuocNhom, DonVi, Kho) VALUES (?, ?, ?, ?, ?, ?, ?)";
            
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("sssdssi", $tenSanPham, $moTa, $anh, $gia, $thuocNhom, $donVi, $kho);
                if (!$stmt->execute()) {
                    // Nếu có lỗi khi chèn dữ liệu, dừng lại và trả về lỗi
                    $response['message'] = 'Lỗi khi chèn dữ liệu: ' . $stmt->error;
                    break;
                }
            } else {
                $response['message'] = 'Lỗi khi chuẩn bị truy vấn: ' . $conn->error;
                break;
            }
        }

        fclose($handle);
        if ($response['message'] === 'Có lỗi xảy ra trong quá trình nhập dữ liệu.') {
            $response = ['status' => 'success', 'message' => 'Dữ liệu đã được nhập thành công.'];
        }
    } else {
        $response['message'] = 'Không thể mở tệp CSV.';
    }
} else {
    $response['message'] = 'Không có tệp nào được tải lên hoặc xảy ra lỗi khi tải lên.';
}

$conn->close();
echo json_encode($response);
?>
