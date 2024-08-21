<?php
// Bao gồm file kết nối cơ sở dữ liệu
require 'db_conn.php';

// Lấy thông tin hóa đơn cần chỉnh sửa
$idHoaDon = isset($_GET['id']) ? intval($_GET['id']) : 0;
$sql_get_invoice = "SELECT * FROM hoadon WHERE Id_HoaDon = $idHoaDon";
$result_get_invoice = $conn->query($sql_get_invoice);

if ($result_get_invoice->num_rows > 0) {
    $row_invoice = $result_get_invoice->fetch_assoc();
} else {
    die("Không tìm thấy hóa đơn.");
}

// Kiểm tra nếu form đã submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $NguoiLapHoaDon = $_POST['NguoiLapHoaDon'];
    $NgayThanhToan = $_POST['NgayThanhToan'];
    $NgayHetHan = $_POST['NgayHetHan'];
    $TinhTrang = $_POST['TinhTrang'];

    // Kiểm tra Ngày Hết Hạn phải lớn hơn Ngày Thanh Toán
    if (strtotime($NgayHetHan) <= strtotime($NgayThanhToan)) {
        $error_message = "Lỗi: Ngày Hết Hạn phải lớn hơn Ngày Thanh Toán.";
    } else {
        // Cập nhật thông tin hóa đơn
        $sql_update = "UPDATE hoadon 
                       SET NguoiLapHoaDon='$NguoiLapHoaDon', NgayThanhToan='$NgayThanhToan', NgayHetHan='$NgayHetHan', TinhTrang='$TinhTrang' 
                       WHERE Id_HoaDon = $idHoaDon";
        
        if ($conn->query($sql_update) === TRUE) {
            header("Location: Check_KhachHang.php?id=" . $row_invoice['Id_khachhang']);
            exit;
        } else {
            $error_message = "Lỗi: " . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Hóa Đơn</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 30px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            border-bottom: 1px solid #e5e5e5;
        }
        .form-control {
            border-radius: 5px;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.075);
        }
        .btn {
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
        }
        .btn-success {
            background-color: #28a745;
            border: none;
        }
        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }
        .btn:hover {
            opacity: 0.9;
        }
        .alert {
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <!-- Nội dung chính -->
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Chỉnh Sửa Hóa Đơn</h4>
            </div>
            <div class="card-body">
                <?php if (isset($error_message)) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error_message; ?>
                    </div>
                <?php } ?>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="NguoiLapHoaDon">Người Lập Hóa Đơn:</label>
                        <select name="NguoiLapHoaDon" id="NguoiLapHoaDon" class="form-control" required>
                            <?php
                            // Kết nối cơ sở dữ liệu và lấy danh sách nhân viên
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            $sql_nv = "SELECT HovaTen FROM nhanvien";
                            $result_nv = $conn->query($sql_nv);
                            
                            if ($result_nv->num_rows > 0) {
                                while ($row_nv = $result_nv->fetch_assoc()) {
                                    $selected = ($row_nv['HovaTen'] == $row_invoice['NguoiLapHoaDon']) ? 'selected' : '';
                                    echo "<option value='" . $row_nv['HovaTen'] . "' $selected>" . $row_nv['HovaTen'] . "</option>";
                                }
                            }
                            $conn->close();
                            ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="NgayThanhToan">Ngày Thanh Toán:</label>
                        <input type="date" name="NgayThanhToan" id="NgayThanhToan" class="form-control" value="<?php echo $row_invoice['NgayThanhToan']; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="NgayHetHan">Ngày Hết Hạn:</label>
                        <input type="date" name="NgayHetHan" id="NgayHetHan" class="form-control" value="<?php echo $row_invoice['NgayHetHan']; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="TinhTrang">Tình Trạng:</label>
                        <select name="TinhTrang" id="TinhTrang" class="form-control" required>
                            <option value="Chưa thanh toán" <?php echo ($row_invoice['TinhTrang'] == 'Chưa thanh toán') ? 'selected' : ''; ?>>Chưa thanh toán</option>
                            <option value="Đã thanh toán" <?php echo ($row_invoice['TinhTrang'] == 'Đã thanh toán') ? 'selected' : ''; ?>>Đã thanh toán</option>
                            <option value="Thanh toán 50%" <?php echo ($row_invoice['TinhTrang'] == 'Thanh toán 50%') ? 'selected' : ''; ?>>Thanh toán 50%</option>
                            <option value="Thanh toán 70%" <?php echo ($row_invoice['TinhTrang'] == 'Thanh toán 70%') ? 'selected' : ''; ?>>Thanh toán 70%</option>
                        </select>
                    </div>
                    
                    <div class="form-group d-flex justify-content-between">
                        <button type="submit" class="btn btn-success">Lưu</button>
                        <a href="Check_KhachHang.php?id=<?php echo $row_invoice['Id_khachhang']; ?>" class="btn btn-secondary">Hủy</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
