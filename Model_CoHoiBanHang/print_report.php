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

// Hiển thị dữ liệu
if ($result->num_rows > 0) {
    echo "<html><head><title>In Dữ Liệu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
    </style></head><body>";
    echo "<h1>Danh Sách Khách Hàng</h1>";
    echo "<table>";
    echo "<tr>
            <th>STT</th>
            <th>Tên</th>
            <th>Tên Công Ty</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Người Phụ Trách</th>
            <th>Tình Trạng</th>
            <th>Nguồn Cơ Hội</th>
            <th>Ngày Liên Hệ</th>
            <th>Khu Vực</th>
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
        echo "</tr>";
    }
    echo "</table>";
    echo "</body></html>";
} else {
    echo "<html><body><p>Không có dữ liệu nào.</p></body></html>";
}

// Đóng kết nối
$conn->close();
?>
