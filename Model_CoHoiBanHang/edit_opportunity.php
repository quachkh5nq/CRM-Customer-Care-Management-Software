<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'db_crm';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die('Kết nối cơ sở dữ liệu thất bại: ' . $conn->connect_error);
}

$customers = [];
$employees = [];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];
    $sql = "SELECT * FROM lichcskh WHERE ID_LichCSKH = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $stmt->close();

    // Lấy danh sách khách hàng
    $sql = "SELECT Ten FROM khachhangch";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $customers[] = $row['Ten'];
    }

    // Lấy danh sách nhân viên
    $sql = "SELECT HovaTen FROM nhanvien";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $employees[] = $row['HovaTen'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $status = $_POST['status'];
    $source = $_POST['source'];
    $expectedDate = $_POST['expected-date'];
    $sendTo = implode(',', $_POST['send-to']);
    $inCharge = $_POST['in-charge'];
    $overallStatus = $_POST['status'];

    $sql = "UPDATE lichcskh SET TieuDe = ?, TinhTrangCoHoi = ?, NguonCoHoi = ?, NgayDuKien = ?, GuiDen = ?, HovaTen = ?, TrangThai = ? WHERE ID_LichCSKH = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $title, $status, $source, $expectedDate, $sendTo, $inCharge, $overallStatus, $id);
    if ($stmt->execute()) {
        header('Location: Home_LichCSKH.php');
        exit();
    } else {
        echo "Lỗi: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Cơ Hội</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin: 15px 0 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        select[multiple] {
            height: auto;
        }
        button {
            display: inline-block;
            margin: 20px 0 10px;
            padding: 10px 20px;
            color: #fff;
            background-color: #007BFF;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button[type="button"] {
            background-color: #6c757d;
        }
        button:hover {
            background-color: #0056b3;
        }
        button[type="button"]:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Chỉnh Sửa Cơ Hội</h2>
        <form method="POST" action="edit_opportunity.php">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($data['ID_LichCSKH']); ?>">
            
            <label for="title">Tiêu Đề:</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($data['TieuDe']); ?>" required>

            <label for="status">Tình Trạng Cơ Hội:</label>
            <input type="text" id="status" name="status" value="<?php echo htmlspecialchars($data['TinhTrangCoHoi']); ?>" required>

            <label for="source">Nguồn Cơ Hội:</label>
            <input type="text" id="source" name="source" value="<?php echo htmlspecialchars($data['NguonCoHoi']); ?>" required>

            <label for="expected-date">Ngày Dự Kiến:</label>
            <input type="date" id="expected-date" name="expected-date" value="<?php echo htmlspecialchars($data['NgayDuKien']); ?>" required>

            <label for="send-to">Gửi Đến:</label>
            <select id="send-to" name="send-to[]" multiple>
                <?php foreach ($customers as $customer) : ?>
                    <option value="<?php echo htmlspecialchars($customer); ?>" <?php echo in_array($customer, explode(',', $data['GuiDen'])) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($customer); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="in-charge">Phụ Trách:</label>
            <select id="in-charge" name="in-charge">
                <?php foreach ($employees as $employee) : ?>
                    <option value="<?php echo htmlspecialchars($employee); ?>" <?php echo $employee === $data['HovaTen'] ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($employee); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="status">Trạng Thái:</label>
            <input type="text" id="status" name="status" value="<?php echo htmlspecialchars($data['TrangThai']); ?>" required>

            <button type="submit">Lưu</button>
            <button type="button" onclick="window.location.href='Home_LichCSKH.php'">Hủy</button>
        </form>
    </div>
</body>
</html>
