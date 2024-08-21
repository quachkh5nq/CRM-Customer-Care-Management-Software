<?php
// Bao gồm file kết nối cơ sở dữ liệu
require 'db_conn.php';

// Truy vấn dữ liệu từ bảng lichcskh
$sql = "SELECT ID_LichCSKH, TieuDe, TinhTrangCoHoi, 
NguonCoHoi, NgayDuKien, GuiDen, HovaTen, TrangThai FROM lichcskh";
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
    echo "<h1>Lịch Chăm Sóc</h1>";
    echo "<table>";
    echo "<tr>
            <th>STT</th>
            <th>Tiêu Đề</th>
            <th>Tình Trạng Cơ Hội</th>
            <th>Nguồn Cơ Hội</th>
            <th>Ngày Dự Kiến</th>
            <th>Gửi Đến</th>
            <th>Người Phụ Trách</th>
            <th>Trạng Thái</th>
          </tr>";

    // Lặp qua từng dòng kết quả
    $stt = 1;
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $stt++ . "</td>";
        echo "<td>" . $row["TieuDe"] . "</td>";
        echo "<td>" . $row["TinhTrangCoHoi"] . "</td>";
        echo "<td>" . $row["NguonCoHoi"] . "</td>";
        echo "<td>" . $row["NgayDuKien"] . "</td>";
        echo "<td>" . $row["GuiDen"] . "</td>";
        echo "<td>" . $row["HovaTen"] . "</td>";
        echo "<td>" . $row["TrangThai"] . "</td>";
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
