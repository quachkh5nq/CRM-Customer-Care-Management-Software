<?php
// Bao gồm file kết nối cơ sở dữ liệu
require 'db_conn.php';

// Xử lý dữ liệu từ form nếu có
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $tenCongViec = isset($_POST['tenCongViec']) ? $_POST['tenCongViec'] : '';
    $moTaCongViec = isset($_POST['moTaCongViec']) ? $_POST['moTaCongViec'] : '';
    $ngayBatDau = isset($_POST['ngayBatDau']) ? $_POST['ngayBatDau'] : '';
    $ngayKetThuc = isset($_POST['ngayKetThuc']) ? $_POST['ngayKetThuc'] : '';
    $lienQuanDenId = isset($_POST['lienQuanDen']) ? $_POST['lienQuanDen'] : '';
    $tinhTrang = isset($_POST['tinhTrang']) ? $_POST['tinhTrang'] : '';
    $nguoiThucHienIds = isset($_POST['nguoiThucHien']) ? $_POST['nguoiThucHien'] : [];
    $mucDo = isset($_POST['mucDo']) ? $_POST['mucDo'] : '';

    // Kiểm tra điều kiện Ngày Kết Thúc phải lớn hơn hoặc bằng Ngày Bắt Đầu
    if ($ngayKetThuc < $ngayBatDau) {
        echo "Ngày Kết Thúc phải lớn hơn hoặc bằng Ngày Bắt Đầu.";
        exit;
    }

    // Kiểm tra xem tất cả các trường bắt buộc đã được gửi từ form hay chưa
    if (empty($tenCongViec) || empty($moTaCongViec) || empty($ngayBatDau) || empty($ngayKetThuc) || empty($lienQuanDenId) || empty($tinhTrang) || empty($mucDo)) {
        echo "Một hoặc nhiều trường không được gửi hoặc không có giá trị.";
        exit;
    }

    // Kiểm tra xem mảng người thực hiện có giá trị hay không
    if (empty($nguoiThucHienIds)) {
        echo "Phải chọn ít nhất một người thực hiện.";
        exit;
    }

    // Lấy tên từ ID "Liên Quan Đến"
    $lienQuanDenSql = "SELECT TenLienQuanDen FROM ct_lienquanden WHERE Id_LienQuanDen = ?";
    $lienQuanDenStmt = $conn->prepare($lienQuanDenSql);
    $lienQuanDenStmt->bind_param('i', $lienQuanDenId);
    $lienQuanDenStmt->execute();
    $lienQuanDenResult = $lienQuanDenStmt->get_result();
    $lienQuanDenName = $lienQuanDenResult->fetch_assoc()['TenLienQuanDen'];

    // Lấy tên từ các ID "Người Thực Hiện"
    $nguoiThucHienNames = [];
    $nguoiThucHienSql = "SELECT HovaTen FROM nhanvien WHERE Id_NhanVien = ?";
    $nguoiThucHienStmt = $conn->prepare($nguoiThucHienSql);
    foreach ($nguoiThucHienIds as $nguoiId) {
        $nguoiThucHienStmt->bind_param('i', $nguoiId);
        $nguoiThucHienStmt->execute();
        $nguoiThucHienResult = $nguoiThucHienStmt->get_result();
        $nguoiThucHienNames[] = $nguoiThucHienResult->fetch_assoc()['HovaTen'];
    }
    $nguoiThucHienNamesStr = implode(',', $nguoiThucHienNames);

    // Chèn dữ liệu vào bảng congviec
    $sql = "INSERT INTO congviec (TenCongViec, MoTaCongViec, NgayBatDau, NgayKetThuc, LienQuanDen, TinhTrang, NguoiThucHien, MucDo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssssss', $tenCongViec, $moTaCongViec, $ngayBatDau, $ngayKetThuc, $lienQuanDenName, $tinhTrang, $nguoiThucHienNamesStr, $mucDo);

    if ($stmt->execute()) {
        header("Location: Home_CongViec.php");
    } else {
        echo "Lỗi: " . $stmt->error;
    }

    $stmt->close();
}

// Lấy dữ liệu để hiển thị trong form
// Lấy các tùy chọn cho "Liên Quan Đến"
$lienQuanDenOptions = '';
$lienQuanDenSql = "SELECT Id_LienQuanDen, TenLienQuanDen FROM ct_lienquanden";
$lienQuanDenResult = $conn->query($lienQuanDenSql);
if ($lienQuanDenResult->num_rows > 0) {
    while ($row = $lienQuanDenResult->fetch_assoc()) {
        $lienQuanDenOptions .= "<option value='{$row['Id_LienQuanDen']}'>{$row['TenLienQuanDen']}</option>";
    }
}

// Lấy các tùy chọn cho "Người Thực Hiện"
$nguoiThucHienOptions = '';
$nguoiThucHienSql = "SELECT Id_NhanVien, HovaTen FROM nhanvien";
$nguoiThucHienResult = $conn->query($nguoiThucHienSql);
if ($nguoiThucHienResult->num_rows > 0) {
    while ($row = $nguoiThucHienResult->fetch_assoc()) {
        $nguoiThucHienOptions .= "<option value='{$row['Id_NhanVien']}'>{$row['HovaTen']}</option>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Công Việc</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
            box-sizing: border-box;
        }

        h2 {
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px;
            margin: 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-group textarea {
            resize: vertical;
        }

        .button-container {
            display: flex;
            justify-content: flex-start;
            gap: 10px;
        }

        button {
            background-color: #4F94CD;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #357ABD;
        }

        .button.cancel {
            background-color: #f44336;
        }

        .button.cancel:hover {
            background-color: #d32f2f;
        }

        .form-group.select-group {
            display: flex;
            flex-direction: column;
        }
    </style>
</head>

<body>
    <div class="container">
        <form method="post" action="Insert_CongViec.php">
            <h2>Thêm Công Việc</h2>

            <!-- Các trường dữ liệu -->
            <div class="form-group">
                <label for="tenCongViec">Tên Công Việc:</label>
                <input type="text" id="tenCongViec" name="tenCongViec" required>
            </div>

            <div class="form-group">
                <label for="moTaCongViec">Mô Tả Công Việc:</label>
                <textarea id="moTaCongViec" name="moTaCongViec" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label for="ngayBatDau">Ngày Bắt Đầu:</label>
                <input type="date" id="ngayBatDau" name="ngayBatDau" required>
            </div>

            <div class="form-group">
                <label for="ngayKetThuc">Ngày Kết Thúc:</label>
                <input type="date" id="ngayKetThuc" name="ngayKetThuc" required>
            </div>

            <div class="form-group select-group">
                <label for="lienQuanDen">Liên Quan Đến:</label>
                <select id="lienQuanDen" name="lienQuanDen" required>
                    <?php echo $lienQuanDenOptions; ?>
                </select>
            </div>

            <div class="form-group select-group">
                <label for="tinhTrang">Tình Trạng:</label>
                <select id="tinhTrang" name="tinhTrang" required>
                    <option value="Chưa Bắt Đầu">Chưa Bắt Đầu</option>
                    <option value="Đang thực hiện">Đang thực hiện</option>
                    <option value="Đang kiểm tra">Đang kiểm tra</option>
                    <option value="Đã hoàn thành">Đã hoàn thành</option>
                </select>
            </div>

            <div class="form-group select-group">
                <label for="nguoiThucHien">Người Thực Hiện:</label>
                <select id="nguoiThucHien" name="nguoiThucHien[]" multiple required>
                    <?php echo $nguoiThucHienOptions; ?>
                </select>
            </div>

            <div class="form-group select-group">
                <label for="mucDo">Mức Độ:</label>
                <select id="mucDo" name="mucDo" required>
                    <option value="Thấp">Thấp</option>
                    <option value="Bình thường">Bình thường</option>
                    <option value="Cao">Cao</option>
                    <option value="Cấp bách">Cấp bách</option>
                </select>
            </div>

            <div class="button-container">
                <button type="submit" class="button">
                    <i class="fas fa-plus"></i> Thêm Mới
                </button>
                <button type="button" class="button cancel" onclick="window.location.href='Home_CongViec.php'">
                    <i class="fas fa-times"></i> Hủy
                </button>
            </div>
        </form>
    </div>
</body>

</html>
