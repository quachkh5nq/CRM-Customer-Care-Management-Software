<?php
// Bao gồm file kết nối cơ sở dữ liệu
require 'db_conn.php';

// Lấy ID công việc từ yêu cầu GET
$idCongViec = isset($_GET['idCongViec']) ? $_GET['idCongViec'] : '';

// Lấy thông tin công việc từ cơ sở dữ liệu
$sql = "SELECT * FROM congviec WHERE Id_CongViec = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $idCongViec);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Công việc không tồn tại.";
    exit;
}

$row = $result->fetch_assoc();
$stmt->close();

// Lấy các tùy chọn cho "Liên Quan Đến"
$lienQuanDenOptions = '';
$lienQuanDenSql = "SELECT Id_LienQuanDen, TenLienQuanDen FROM ct_lienquanden";
$lienQuanDenResult = $conn->query($lienQuanDenSql);
if ($lienQuanDenResult->num_rows > 0) {
    while ($lienQuanDenRow = $lienQuanDenResult->fetch_assoc()) {
        $selected = isset($row['TenLienQuanDen']) && ($lienQuanDenRow['TenLienQuanDen'] === $row['TenLienQuanDen']) ? 'selected' : '';
        $lienQuanDenOptions .= "<option value='{$lienQuanDenRow['Id_LienQuanDen']}' $selected>{$lienQuanDenRow['TenLienQuanDen']}</option>";
    }
}

// Lấy các tùy chọn cho "Người Thực Hiện"
$nguoiThucHienOptions = '';
$nguoiThucHienSql = "SELECT Id_NhanVien, HovaTen FROM nhanvien";
$nguoiThucHienResult = $conn->query($nguoiThucHienSql);
$selectedNguoiThucHien = isset($row['HovaTen']) ? explode(', ', $row['HovaTen']) : [];

if ($nguoiThucHienResult->num_rows > 0) {
    while ($nguoiThucHienRow = $nguoiThucHienResult->fetch_assoc()) {
        $selected = in_array($nguoiThucHienRow['HovaTen'], $selectedNguoiThucHien) ? 'selected' : '';
        $nguoiThucHienOptions .= "<option value='{$nguoiThucHienRow['Id_NhanVien']}' $selected>{$nguoiThucHienRow['HovaTen']}</option>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Công Việc</title>
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
        <form method="post" action="Update_CongViec.php">
            <h2>Chỉnh Sửa Công Việc</h2>
            <input type="hidden" name="idCongViec" value="<?php echo htmlspecialchars($row['Id_CongViec']); ?>">

            <div class="form-group">
                <label for="tenCongViec">Tên Công Việc:</label>
                <input type="text" id="tenCongViec" name="tenCongViec" value="<?php echo htmlspecialchars($row['TenCongViec']); ?>" required>
            </div>

            <div class="form-group">
                <label for="moTaCongViec">Mô Tả Công Việc:</label>
                <textarea id="moTaCongViec" name="moTaCongViec" rows="4" required><?php echo htmlspecialchars($row['MoTaCongViec']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="ngayBatDau">Ngày Bắt Đầu:</label>
                <input type="date" id="ngayBatDau" name="ngayBatDau" value="<?php echo htmlspecialchars($row['NgayBatDau']); ?>" required>
            </div>

            <div class="form-group">
                <label for="ngayKetThuc">Ngày Kết Thúc:</label>
                <input type="date" id="ngayKetThuc" name="ngayKetThuc" value="<?php echo htmlspecialchars($row['NgayKetThuc']); ?>" required>
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
                    <option value="Chưa Bắt Đầu" <?php echo ($row['TinhTrang'] == 'Chưa Bắt Đầu') ? 'selected' : ''; ?>>Chưa Bắt Đầu</option>
                    <option value="Đang thực hiện" <?php echo ($row['TinhTrang'] == 'Đang thực hiện') ? 'selected' : ''; ?>>Đang thực hiện</option>
                    <option value="Đang kiểm tra" <?php echo ($row['TinhTrang'] == 'Đang kiểm tra') ? 'selected' : ''; ?>>Đang kiểm tra</option>
                    <option value="Đã hoàn thành" <?php echo ($row['TinhTrang'] == 'Đã hoàn thành') ? 'selected' : ''; ?>>Đã hoàn thành</option>
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
                    <option value="Thấp" <?php echo ($row['MucDo'] == 'Thấp') ? 'selected' : ''; ?>>Thấp</option>
                    <option value="Bình thường" <?php echo ($row['MucDo'] == 'Bình thường') ? 'selected' : ''; ?>>Bình thường</option>
                    <option value="Cao" <?php echo ($row['MucDo'] == 'Cao') ? 'selected' : ''; ?>>Cao</option>
                    <option value="Cấp bách" <?php echo ($row['MucDo'] == 'Cấp bách') ? 'selected' : ''; ?>>Cấp bách</option>
                </select>
            </div>

            <div class="button-container">
                <button type="submit" class="button">
                    <i class="fas fa-save"></i> Cập Nhật
                </button>
                <button type="button" class="button cancel" onclick="window.location.href='Home_CongViec.php'">
                    <i class="fas fa-times"></i> Hủy
                </button>
            </div>
        </form>
    </div>
</body>

</html>
