<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Hóa Đơn</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 1200px;
        }
        .card {
            margin-bottom: 20px;
        }
        .card-header {
            font-size: 1.25rem;
            font-weight: bold;
        }
        .card-body p {
            margin-bottom: 10px;
        }
        .table thead th {
            background-color: #f8f9fa;
        }
        .table td, .table th {
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <!-- <h1 class="mb-4">Chi Tiết Hóa Đơn</h1> -->

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

        // Lấy Id_HoaDon từ URL
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        // Truy vấn chi tiết hóa đơn từ bảng hoadon
        $sql_invoice = "SELECT Id_HoaDon, Id_khachhang, MaHoaDon, NguoiLapHoaDon, NgayThanhToan, NgayHetHan, TinhTrang 
                        FROM hoadon 
                        WHERE Id_HoaDon = $id";
        $result_invoice = $conn->query($sql_invoice);

        if ($result_invoice->num_rows > 0) {
            $row_invoice = $result_invoice->fetch_assoc();
            echo "<div class='card'>
                    <div class='card-header'>
                        Hóa Đơn: " . $row_invoice["MaHoaDon"] . "
                    </div>
                    <div class='card-body'>
                        <p><strong>Người Lập Hóa Đơn:</strong> " . $row_invoice["NguoiLapHoaDon"] . "</p>
                        <p><strong>Ngày Thanh Toán:</strong> " . $row_invoice["NgayThanhToan"] . "</p>
                        <p><strong>Ngày Hết Hạn:</strong> " . $row_invoice["NgayHetHan"] . "</p>
                        <p><strong>Tình Trạng:</strong> " . $row_invoice["TinhTrang"] . "</p>
                    </div>
                </div>";

            // Truy vấn chi tiết hóa đơn từ bảng ct_hoadon
            $sql_ct_invoice = "SELECT Id_CTHoaDon, TenSanPham, MoTa, SoLuong, Gia, TienThue, TongTien 
                               FROM ct_hoadon 
                               WHERE Id_HoaDon = $id";
            $result_ct_invoice = $conn->query($sql_ct_invoice);

            if ($result_ct_invoice->num_rows > 0) {
                echo "<div class='card'>
                        <div class='card-header'>
                            Chi Tiết Hóa Đơn
                        </div>
                        <div class='card-body'>
                            <table class='table table-bordered'>
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên Sản Phẩm</th>
                                        <th>Mô Tả</th>
                                        <th>Số Lượng</th>
                                        <th>Giá</th>
                                        <th>Tiền Thuế</th>
                                        <th>Tổng Tiền</th>
                                    </tr>
                                </thead>
                                <tbody>";
                $stt = 1;
                while ($row_ct_invoice = $result_ct_invoice->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $stt . "</td>
                            <td>" . htmlspecialchars($row_ct_invoice["TenSanPham"]) . "</td>
                            <td>" . htmlspecialchars($row_ct_invoice["MoTa"]) . "</td>
                            <td>" . number_format($row_ct_invoice["SoLuong"]) . "</td>
                            <td>" . number_format($row_ct_invoice["Gia"], 2) . "</td>
                            <td>" . number_format($row_ct_invoice["TienThue"], 2) . "</td>
                            <td>" . number_format($row_ct_invoice["TongTien"], 2) . "</td>
                          </tr>";
                    $stt++;
                }
                echo "</tbody>
                      </table>
                    </div>
                </div>";
            } else {
                echo "<div class='alert alert-info'>Không có chi tiết hóa đơn nào.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Hóa đơn không tồn tại.</div>";
        }

        // Đóng kết nối
        $conn->close();
        ?>
    </div>
</body>
</html>
