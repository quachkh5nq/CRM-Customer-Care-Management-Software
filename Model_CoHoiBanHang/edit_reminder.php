<?php
// Kết nối cơ sở dữ liệu
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'db_crm';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy ID từ GET
$id_nhacnhokhch = isset($_GET['id_nhacnhokhch']) ? $_GET['id_nhacnhokhch'] : null;

if ($id_nhacnhokhch && is_numeric($id_nhacnhokhch)) {
    // Lấy thông tin nhắc nhở để chỉnh sửa
    $sql = "SELECT * FROM nhacnhokhch WHERE Id_nhacnhokhch = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Lỗi chuẩn bị câu lệnh: " . $conn->error);
    }
    $stmt->bind_param("i", $id_nhacnhokhch);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        die("Không tìm thấy nhắc nhở.");
    }
    
    $stmt->close();
} else {
    die("ID không hợp lệ.");
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa nhắc nhở</title>
    <style>
        /* Style form */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input, textarea {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Chỉnh sửa nhắc nhở</h2>
        <form action="update_reminder.php" method="POST">
            <input type="hidden" name="id_nhacnhokhch" value="<?php echo htmlspecialchars($row['Id_nhacnhokhch']); ?>">
            <input type="text" name="noi_dung" value="<?php echo htmlspecialchars($row['NoiDung']); ?>" placeholder="Nội dung nhắc nhở" required>
            <input type="date" name="ngay_nhac" value="<?php echo htmlspecialchars($row['NgayNhac']); ?>" placeholder="Ngày nhắc" required>
            <input type="text" name="gui_den" value="<?php echo htmlspecialchars($row['GuiDen']); ?>" placeholder="Gửi đến" required>
            <textarea name="trang_thai" placeholder="Trạng thái thông báo" required><?php echo htmlspecialchars($row['TrangThaiThongBao']); ?></textarea>
            <button type="submit">Cập nhật</button>
        </form>
    </div>
</body>
</html>
