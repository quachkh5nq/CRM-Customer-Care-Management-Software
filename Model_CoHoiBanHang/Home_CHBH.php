<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Quản lý Khách Hàng</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            overflow: hidden; /* Ngăn không cho cuộn trang chính khi modal mở */
        }

        .container {
            display: flex;
            width: 100%;
            height: 100vh;
            gap: 20px;
            padding: 20px;
            box-sizing: border-box;
            overflow: hidden; /* Đảm bảo không có cuộn dọc trong phần chính */
        }

        .content {
            width: 80%;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            border-radius: 5px;
        }

        .sidebar {
            width: 14%;
            background-color: #fff;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            border-radius: 5px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin: 20px 0;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #4F94CD;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .button-container {
            margin-top: 20px;
            display: flex;
            gap: 10px;
        }

        .header {
            background-color: #B0E0E6;
            color: white;
            text-align: center;
            padding: 1px;
            margin: -20px -20px 20px -20px;
            border-radius: 5px;
        }

        .button {
            background-color: #E8E8E8;
            color: white;
            border: none;
            padding: 10px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 5px 2px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .button:hover {
            background-color: #B0E0E6;
        }

        .submenu {
            display: none;
            padding-left: 30px;
        }

        .submenu p {
            margin: 0;
        }

        .submenu a {
            text-decoration: none;
            color: black;
        }

        .toggle-icon {
            font-size: 16px;
            margin-left: 20px;
            transition: transform 0.3s;
        }

        .toggle-icon.down {
            transform: rotate(90deg);
        }

        .sidebar a {
            display: flex;
            align-items: center;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 10% auto; /* Đặt margin cho modal-content để căn giữa modal */
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 800px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Sidebar: Danh sách khách hàng -->
        <div class="sidebar">
            <div class="header">
                <h2>Chức năng</h2>
            </div>

            <div style="text-align: left; margin-top: 20px;">
                <p>
                    <a href="javascript:void(0);" style="text-decoration: none; color: black;" onclick="toggleSubMenu()">
                        <img src="icon/shopping-cart.png" alt="Icon Bán Hàng" style="width: 20px; height: 20px; margin-right: 10px;">
                        Cơ Hội Bán Hàng
                        <i id="toggle-icon" class="fas fa-chevron-right toggle-icon" style="width: 10px; height: 10px; margin-left: 65px;"></i>
                    </a>
                </p>
                <div id="submenu" class="submenu">
                    <p><a href="javascript:void(0);" id="list-opportunities" style="text-decoration: none; color: black; height: 20px; margin-left: 30px;">Danh Sách Cơ Hội</a></p>
                    <p><a href="care_schedule.php" style="text-decoration: none; color: black; height: 40px; margin-left: 30px;">Lịch Chăm Sóc</a></p>
                </div>
            </div>
        </div>

        <!-- Content: Bảng Danh -->
        <div class="content" id="data-container" style="display: none;">

            <!-- Nút nằm ngang -->
            <div class="button-container">
                <button class="button" onclick="showModal()">
                    <i class="fas fa-plus"></i> Thêm Mới
                </button>
                <button class="button">
                    <i class="fas fa-upload"></i> Nhập Từ File
                </button>
                <button class="button">
                    <i class="fas fa-file-export"></i> Xuất Excel
                </button>
                <button class="button">
                    <i class="fas fa-chart-bar"></i> Biểu Đồ
                </button>
            </div>

            <!-- Container cho bảng dữ liệu -->
            <div>
                <?php
                // Thông tin kết nối cơ sở dữ lsệu
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
                            <th>Tên</th>
                            <th>Tên Công Ty</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Người Phụ Trách</th>
                            <th>Tình Trạng</th>
                            <th>Nguồn Cơ Hội</th>
                            <th>Liên Hệ</th>
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
                } else {
                    echo "Không có dữ liệu nào.";
                }

                // Đóng kết nối
                $conn->close();
                ?>
            </div>
        </div>
    </div>

    <script>
        function toggleSubMenu() {
            var submenu = document.getElementById('submenu');
            var icon = document.getElementById('toggle-icon');
            if (submenu.style.display === 'block') {
                submenu.style.display = 'none';
                icon.classList.remove('down');
            } else {
                submenu.style.display = 'block';
                icon.classList.add('down');
            }
        }

        function toggleDataContainer() {
            var dataContainer = document.getElementById('data-container');
            if (dataContainer.style.display === 'block') {
                dataContainer.style.display = 'none';
            } else {
                dataContainer.style.display = 'block';
            }
        }

        document.getElementById('list-opportunities').addEventListener('click', toggleDataContainer);

        function showModal() {
            var modal = document.getElementById('form-modal');
            var formContent = document.getElementById('form-content');

            // Hiển thị modal và ngăn cuộn trang chính
            modal.style.display = 'block';
            document.body.style.overflow = 'hidden';

            // Tải nội dung từ Insert_CoHoi.php
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'Insert_CoHoi.php', true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    formContent.innerHTML = xhr.responseText;
                } else {
                    formContent.innerHTML = 'Lỗi tải nội dung.';
                }
            };
            xhr.send();
        }

        function closeModal() {
            document.getElementById('form-modal').style.display = 'none';
            document.body.style.overflow = ''; // Khôi phục khả năng cuộn trang chính
        }
    </script>

    <!-- Modal -->
    <div id="form-modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div id="form-content">
                <!-- Nội dung sẽ được tải vào đây -->
            </div>
        </div>
    </div>
</body>

</html>
