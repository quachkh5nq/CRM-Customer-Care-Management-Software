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

        .table td,
        .table th {
            vertical-align: middle;
        }

        .btn-custom {
            background-color: #007bff;
            color: white;
        }

        .btn-custom:hover {
            background-color: #0056b3;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <?php
        // Bao gồm file kết nối cơ sở dữ liệu
        require 'db_conn.php';

        // Lấy Id_HoaDon từ URL
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        // Truy vấn chi tiết hóa đơn từ bảng hoadon
        $sql_invoice = "SELECT Id_HoaDon, Id_KhachHang, MaHoaDon, NguoiLapHoaDon, NgayThanhToan, NgayHetHan, TinhTrang 
                        FROM hoadon 
                        WHERE Id_HoaDon = $id";
        $result_invoice = $conn->query($sql_invoice);

        if ($result_invoice->num_rows > 0) {
            $row_invoice = $result_invoice->fetch_assoc();
            $idKhachHang = $row_invoice["Id_KhachHang"];
            echo "<div class='card'>
                    <div class='card-header'>
                        Hóa Đơn: " . $row_invoice["MaHoaDon"] . "
                    </div>
                    <div class='card-body'>
                        <p><strong>Người Lập Hóa Đơn:</strong> " . $row_invoice["NguoiLapHoaDon"] . "</p>
                        <p><strong>Ngày Thanh Toán:</strong> " . $row_invoice["NgayThanhToan"] . "</p>
                        <p><strong>Ngày Hết Hạn:</strong> " . $row_invoice["NgayHetHan"] . "</p>
                        <p><strong>Tình Trạng:</strong> " . $row_invoice["TinhTrang"] . "</p>
                        <!-- Nút Mua Sản Phẩm -->
                        <a href='buy_product.php?Id_HoaDon=" . $row_invoice["Id_HoaDon"] . "&Id_KhachHang=" . $idKhachHang . "' class='btn btn-custom'>Mua Sản Phẩm</a>
                    </div>
                </div>";

            // Truy vấn chi tiết hóa đơn từ bảng ct_hoadon
            $sql_ct_invoice = "SELECT Id_CTHoaDon, TenSanPham, MoTa, SoLuong, Gia, TienThue, TongTien 
                               FROM ct_hoadon 
                               WHERE Id_HoaDon = $id";
            $result_ct_invoice = $conn->query($sql_ct_invoice);

            if ($result_ct_invoice->num_rows > 0) {
                echo "<form action='delete_ct_hoadon.php' method='POST'>
                        <div class='card'>
                        <div class='card-header'>
                            Chi Tiết Hóa Đơn
                        </div>
                        <div class='card-body'>
                            <table class='table table-bordered'>
                                <thead>
                                    <tr>
                                        <th><input type='checkbox' id='select_all'></th>
                                        <th>STT</th>
                                        <th>Tên Sản Phẩm</th>
                                        <th>Mô Tả</th>
                                        <th>Số Lượng</th>
                                        <th>Giá</th>
                                        <th>Tiền Thuế</th>
                                        <th>Tổng Tiền</th>
                                        <th>Hành Động</th>
                                    </tr>
                                </thead>
                                <tbody>";
                $stt = 1;
                while ($row_ct_invoice = $result_ct_invoice->fetch_assoc()) {
                    echo "<tr>
                            <td><input type='checkbox' name='selected_items[]' value='" . $row_ct_invoice["Id_CTHoaDon"] . "'></td>
                            <td>" . $stt . "</td>
                            <td>" . htmlspecialchars($row_ct_invoice["TenSanPham"]) . "</td>
                            <td>" . htmlspecialchars($row_ct_invoice["MoTa"]) . "</td>
                            <td>" . number_format($row_ct_invoice["SoLuong"]) . "</td>
                            <td>" . number_format($row_ct_invoice["Gia"]) . "</td>
                            <td>" . number_format($row_ct_invoice["TienThue"], 2) . "</td>
                            <td>" . number_format($row_ct_invoice["TongTien"]) . "</td>
                            <td>
                                <a href='edit_product.php?Id_CTHoaDon=" . $row_ct_invoice["Id_CTHoaDon"] . "&Id_HoaDon=" . $id . "' class='btn btn-warning btn-sm'>Chỉnh Sửa</a>
                            </td>
                          </tr>";
                    $stt++;
                }
                echo "</tbody>
                      </table>
                      <!-- Nút Xóa Sản Phẩm Đã Chọn -->
                      <button type='submit' class='btn btn-danger'>Xóa Sản Phẩm Đã Chọn</button>
                    </div>
                </div>
                <input type='hidden' name='Id_HoaDon' value='$id'>
                </form>";
            } else {
                echo "<div class='alert alert-info'>Không có chi tiết hóa đơn nào.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Hóa đơn không tồn tại.</div>";
        }

        // Đóng kết nối
        $conn->close();
        ?>

        <script>
            // Tự động chọn tất cả checkbox
            document.getElementById('select_all').onclick = function() {
                var checkboxes = document.querySelectorAll('input[name=\"selected_items[]\"]');
                for (var checkbox of checkboxes) {
                    checkbox.checked = this.checked;
                }
            }
        </script>
    </div>
</body>

</html>
