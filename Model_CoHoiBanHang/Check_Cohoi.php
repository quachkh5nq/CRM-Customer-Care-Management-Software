<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin khách hàng</title>
    <style>
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
        h2 {
            text-align: center;
            color: #333;
            border-bottom: 2px solid #f4f4f4;
            padding-bottom: 10px;
        }
        .customer-info {
            margin: 20px 0;
        }
        .customer-info p {
            margin: 10px 0;
        }
        .customer-info p span {
            font-weight: bold;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
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

        // Lấy ID từ query string
        $id = $_GET['id'];

        // Truy vấn thông tin khách hàng
        $sql = "SELECT * FROM khachhangch WHERE Id_KHCH = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Hiển thị thông tin chi tiết của khách hàng
            echo "<h2>Thông tin khách hàng</h2>";
            echo "<div class='customer-info'>";
            echo "<p><span>Tên:</span> " . $row['Ten'] . "</p>";
            echo "<p><span>Tên Công Ty:</span> " . $row['TenCongTy'] . "</p>";
            echo "<p><span>Email:</span> " . $row['Email'] . "</p>";
            echo "<p><span>Phone:</span> " . $row['Phone'] . "</p>";
            echo "<p><span>Người Phụ Trách:</span> " . $row['NguoiPhuTrach'] . "</p>";
            echo "<p><span>Tình Trạng:</span> " . $row['TinhTrang'] . "</p>";
            echo "<p><span>Nguồn Cơ Hội:</span> " . $row['NguonCoHoi'] . "</p>";
            echo "<p><span>Liên Hệ:</span> " . $row['NgayLienHe'] . "</p>";
            echo "<p><span>Khu Vực:</span> " . $row['KhuVuc'] . "</p>";
            echo "<p><span>Giá Dự Kiến:</span> " . $row['GiaDuKien'] . "</p>";
            echo "<p><span>Ngày Chốt Dự Kiến:</span> " . $row['NgayChotDuKien'] . "</p>";
            echo "<p><span>Mô Tả:</span> " . $row['MoTa'] . "</p>";
            echo "</div>";
        } else {
            echo "<p>Không tìm thấy thông tin khách hàng.</p>";
        }

        $stmt->close();
        $conn->close();
        ?>
    </div>
</body>
</html>
