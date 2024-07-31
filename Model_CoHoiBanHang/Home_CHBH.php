<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Khách Hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
        }
        .container {
            display: flex;
            width: 100%;
            height: 100vh;
            gap: 20px;
            padding: 20px;
            box-sizing: border-box;
        }
        .content {
            width: 80%; /* Increase content width if sidebar is narrower */
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            overflow-y: auto;
            border-radius: 5px;
        }
        .sidebar {
            width: 18%; /* Adjusted width to make sidebar narrower */
            background-color: #fff;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            overflow-y: auto;
            border-radius: 5px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin: 20px 0;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        .header {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 10px;
            margin: -20px -20px 20px -20px;
            border-radius: 5px;
        }
        .button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px 2px;
            cursor: pointer;
            border-radius: 5px;
        }
        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar: Danh sách khách hàng -->
        <div class="sidebar">
            <div class="header">
                <h2>Danh Sách Khách Hàng</h2>
            </div>
            
            <div style="text-align: center; margin-top: 20px;">
                <button class="button" onclick="location.href='add_customer.php'">Thêm Khách Hàng</button>
            </div>
        </div>

        <!-- Content: Bảng Danh -->
        <div class="content">
            <div class="header">
                <h2>Chi Tiết Thông Tin</h2>
            </div>
            <?php
            // Thông tin kết nối cơ sở dữ liệu
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

            // Truy vấn dữ liệu từ bảng khachhangch
            $sql = "SELECT Id_KHCH, Ten, TenCongTy, Email, Phone, NguoiPhuTrach, TinhTrang, NguonCoHoi, NgayLienHe, Website, KhuVuc, GiaDuKien, NgayChotDuKien, MoTa FROM khachhangch";
            $result = $conn->query($sql);

            // Kiểm tra và hiển thị dữ liệu
            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr>
                    <th>STT</th>
                    <th>Ten</th>
                    <th>TenCongTy</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>NguoiPhuTrach</th>
                    <th>TinhTrang</th>
                    <th>NguonCoHoi</th>
                    <th>NgayLienHe</th>
                    <th>KhuVuc</th>
                    <th>GiaDuKien</th>
                </tr>";

                // Lặp qua từng dòng kết quả
                $stt = 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $stt++ . "</td>";
                    echo "<td>" . $row["Ten"] . "</td>";
                    echo "<td>" . $row["TenCongTy"] . "</td>";
                    echo "<td>" . $row["Email"] . "</td>";
                    echo "<td>" . $row["Phone"] . "</td>";
                    echo "<td>" . $row["NguoiPhuTrach"] . "</td>";
                    echo "<td>" . $row["TinhTrang"] . "</td>";
                    echo "<td>" . $row["NguonCoHoi"] . "</td>";
                    echo "<td>" . $row["NgayLienHe"] . "</td>";
                    echo "<td>" . $row["KhuVuc"] . "</td>";
                    echo "<td>" . $row["GiaDuKien"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "Không có dữ liệu nào.";
            }

            // Đóng kết nối
            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
