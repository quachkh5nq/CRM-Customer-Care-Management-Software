<?php
// Bao gồm file kết nối cơ sở dữ liệu
require 'db_conn.php';

// Lấy thông tin hợp đồng cần chỉnh sửa
$idHopDong = isset($_GET['id']) ? intval($_GET['id']) : 0;
$sql_get_merge = "SELECT * FROM hopdong WHERE Id_HopDong = $idHopDong";
$result_get_merge = $conn->query($sql_get_merge);

if ($result_get_merge->num_rows > 0) {
    $row_merge = $result_get_merge->fetch_assoc();
} else {
    die("Không tìm thấy hợp đồng.");
}

// Kiểm tra nếu form đã submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $TenHopDong = $_POST['TenMerge'];
    $LoaiHopDong = $_POST['LoaiMerge'];
    $GiaTriHopDong = $_POST['GiaTriMerge'];
    $NgayBatDau = $_POST['NgayBatDau'];
    $NgayKetThuc = $_POST['NgayKetThuc'];
    $ChuKy = $_POST['ChuKy'];

    // Kiểm tra Ngày Kết Thúc phải lớn hơn Ngày Bắt Đầu
    if (strtotime($NgayKetThuc) <= strtotime($NgayBatDau)) {
        $error_message = "Lỗi: Ngày Kết Thúc phải lớn hơn Ngày Bắt Đầu.";
    } else {
        // Cập nhật thông tin hợp đồng
        $sql_update = "UPDATE hopdong 
                       SET TenHopDong='$TenHopDong', LoaiHopDong='$LoaiHopDong', GiaTriHopDong='$GiaTriHopDong', NgayBatDau='$NgayBatDau', NgayKetThuc='$NgayKetThuc', ChuKy='$ChuKy' 
                       WHERE Id_HopDong = $idHopDong";
        
        if ($conn->query($sql_update) === TRUE) {
            header("Location: Check_KhachHang.php?id=" . $row_merge['Id_khachhang']);
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
    <title>Chỉnh Sửa Hợp Đồng</title>
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
                <h4 class="mb-0">Chỉnh Sửa Hợp Đồng</h4>
            </div>
            <div class="card-body">
                <?php if (isset($error_message)) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error_message; ?>
                    </div>
                <?php } ?>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="TenMerge">Tên Hợp Đồng:</label>
                        <input type="text" name="TenMerge" id="TenMerge" class="form-control" value="<?php echo htmlspecialchars($row_merge['TenHopDong']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="LoaiMerge">Loại Hợp Đồng:</label>
                        <select name="LoaiMerge" id="LoaiMerge" class="form-control" required>
                            <?php
                            // Kết nối cơ sở dữ liệu và lấy danh sách loại hợp đồng
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            $sql_loai_hd = "SELECT TenLoaiHopDong FROM ct_loaihopdong";
                            $result_loai_hd = $conn->query($sql_loai_hd);
                            
                            if ($result_loai_hd->num_rows > 0) {
                                while ($row_loai_hd = $result_loai_hd->fetch_assoc()) {
                                    $selected = ($row_loai_hd['TenLoaiHopDong'] == $row_merge['LoaiHopDong']) ? 'selected' : '';
                                    echo "<option value='" . htmlspecialchars($row_loai_hd['TenLoaiHopDong']) . "' $selected>" . htmlspecialchars($row_loai_hd['TenLoaiHopDong']) . "</option>";
                                }
                            }
                            $conn->close();
                            ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="GiaTriMerge">Giá Trị Hợp Đồng:</label>
                        <input type="number" name="GiaTriMerge" id="GiaTriMerge" class="form-control" value="<?php echo htmlspecialchars($row_merge['GiaTriHopDong']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="NgayBatDau">Ngày Bắt Đầu:</label>
                        <input type="date" name="NgayBatDau" id="NgayBatDau" class="form-control" value="<?php echo htmlspecialchars($row_merge['NgayBatDau']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="NgayKetThuc">Ngày Kết Thúc:</label>
                        <input type="date" name="NgayKetThuc" id="NgayKetThuc" class="form-control" value="<?php echo htmlspecialchars($row_merge['NgayKetThuc']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="ChuKy">Chu Kỳ:</label>
                        <input type="text" name="ChuKy" id="ChuKy" class="form-control" value="<?php echo htmlspecialchars($row_merge['ChuKy']); ?>" required>
                    </div>
                    
                    <div class="form-group d-flex justify-content-between">
                        <button type="submit" class="btn btn-success">Lưu</button>
                        <a href="Check_KhachHang.php?id=<?php echo $row_merge['Id_khachhang']; ?>" class="btn btn-secondary">Hủy</a>
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
