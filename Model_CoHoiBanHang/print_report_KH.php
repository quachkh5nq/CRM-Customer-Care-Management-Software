<?php
// Bao gồm file kết nối cơ sở dữ liệu
require 'db_conn.php';

// Truy vấn dữ liệu từ bảng khachhangch
$sql = "SELECT Id_khachhang, TenKhachHang, LienHeChinh, TrangWeb, MaSoThue, NhomKhachHang, DiaChi, KhuVuc, 
            Phone, DonViTien, NgayThanhLap, 
            Email, TrangThai, NguoiPhuTrach, NgayTao FROM khachhang";
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
            <th>Tên Khách Hàng</th>
            <th>Liên Hệ Chính</th>
            <th>Nhóm Khách Hàng</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Trạng Thái</th>
            <th>Người Phụ Trách</th>
            <th>Ngày Tạo</th>
          </tr>";

    // Lặp qua từng dòng kết quả
    $stt = 1;
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $stt++ . "</td>";
        echo "<td>" . $row["TenKhachHang"] . "</td>";
        echo "<td>" . $row["LienHeChinh"] . "</td>";
        echo "<td>" . $row["NhomKhachHang"] . "</td>";
        echo "<td>" . $row["Phone"] . "</td>";
        echo "<td>" . $row["Email"] . "</td>";
        echo "<td>" . $row["TrangThai"] . "</td>";
        echo "<td>" . $row["NguoiPhuTrach"] . "</td>";
        echo "<td>" . $row["NgayTao"] . "</td>";
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
