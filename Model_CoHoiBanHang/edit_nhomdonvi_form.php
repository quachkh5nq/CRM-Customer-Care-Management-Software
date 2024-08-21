<?php
require 'db_conn.php'; // Kết nối cơ sở dữ liệu

if (isset($_GET['id'])) {
    $idNhom = $conn->real_escape_string($_GET['id']);
    $sql = "SELECT TenDonVi, MoTa FROM nhomdonvi WHERE Id_NhomDonVi = '$idNhom'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        die("Đơn vị không tồn tại.");
    }
} else {
    die("ID đơn vị không được cung cấp.");
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chỉnh Sửa Nhóm Đơn Vị</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 30px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333333;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #555555;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 4px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }
        textarea {
            height: 150px;
            resize: vertical;
        }
        button {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .cancel-button {
            background-color: #6c757d;
        }
        .cancel-button:hover {
            background-color: #5a6268;
        }
    </style>
    <script>
        function updateGroup() {
            const formData = new FormData(document.getElementById('edit-form'));
            
            fetch('edit_nhomdonvi.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert(data.message);
                    window.location.href = 'Home_NhomDonVi.php'; // Quay về trang danh sách
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                alert('Đã xảy ra lỗi!');
            });
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Chỉnh Sửa Nhóm Đơn Vị</h1>
        <form id="edit-form" onsubmit="event.preventDefault(); updateGroup();">
            <input type="hidden" name="idNhom" value="<?php echo htmlspecialchars($_GET['id']); ?>">
            <label for="tenDonVi">Tên Đơn Vị:</label>
            <input type="text" id="tenDonVi" name="tenDonVi" value="<?php echo htmlspecialchars($row['TenDonVi']); ?>" required>
            <label for="moTa">Mô Tả:</label>
            <textarea id="moTa" name="moTa" required><?php echo htmlspecialchars($row['MoTa']); ?></textarea>
            <button type="submit">Lưu</button>
            <button type="button" class="cancel-button" onclick="window.location.href='Home_NhomDonVi.php'">Hủy</button>
        </form>
    </div>
</body>
</html>
