<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <title>Lịch Chăm Sóc</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            overflow: hidden;
        }

        .container {
            display: flex;
            width: 100%;
            height: 100vh;
            gap: 20px;
            padding: 20px;
            box-sizing: border-box;
            overflow: hidden;
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
            position: relative;
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
            border-radius: 5px;
            margin: -20px -20px 20px -20px;
        }

        .button {
            background-color: #E8E8E8;
            color: white;
            border: none;
            padding: 10px 20px;
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

        /* Modal Styles */
        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 5px;
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

        /* Các style khác */
        .action-buttons {
            display: none;
            position: absolute;
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 5px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            z-index: 10;
        }

        tr:hover .action-buttons {
            display: inline-block;
        }

        .table-container {
            position: relative;
        }

        .submenu2 {
            display: none;
            margin-top: 10px;
        }

        .submenu2 p {
            margin: 0;
        }

        .submenu2 a {
            display: block;
            padding: 5px 0;
            text-decoration: none;
            color: black;
        }

        .submenu2 a:hover {
            color: #007bff;
        }

        .toggle-icon2 {
            transition: transform 0.3s ease;
        }

        .toggle-icon2.down {
            transform: rotate(90deg);
        }

        .submenu3 {
            display: none;
            margin-top: 10px;
        }

        .submenu3 p {
            margin: 0;
        }

        .submenu3 a {
            display: block;
            padding: 5px 0;
            text-decoration: none;
            color: black;
        }

        .submenu3 a:hover {
            color: #007bff;
        }

        .toggle-icon3 {
            transition: transform 0.3s ease;
        }

        .toggle-icon3.down {
            transform: rotate(90deg);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <div class="header">
                <h2>Chức năng</h2>
            </div>

            <div style="text-align: left; margin-top: 20px;">
                <p>
                    <a href="javascript:void(0);" style="text-decoration: none; color: black;" onclick="toggleSubMenu()">
                        <img src="icon/shopping-cart.png" alt="Icon Bán Hàng" style="width: 20px; height: 20px; margin-right: 10px;">
                        Khách Hàng
                        <i id="toggle-icon" class="fas fa-chevron-right toggle-icon" style="width: 10px; height: 10px; margin-left: 130px;"></i>
                    </a>
                </p>
                <div id="submenu" class="submenu">
                    <p><a href="index.php" style="text-decoration: none; color: black; height: 20px; margin-left: 30px;">Danh Sách Cơ Hội</a></p>
                    <p><a href="Home_LichCSKH.php" style="text-decoration: none; color: black; height: 40px; margin-left: 30px;">Lịch Chăm Sóc</a></p>
                    <p><a href="Home_KhachHang.php" style="text-decoration: none; color: black; height: 20px; margin-left: 30px;">Danh Sách Khách Hàng</a></p>
                </div>
            </div>

            <div style="text-align: left; margin-top: 20px;">
                <p>
                    <a href="javascript:void(0);" style="text-decoration: none; color: black;" onclick="toggleSubMenu2()">
                        <img src="icon/supplier-alt.png" alt="Icon Sản phẩm" style="width: 20px; height: 20px; margin-right: 10px;">
                        Sản phẩm
                        <i id="toggle-icon2" class="fas fa-chevron-right toggle-icon2" style="width: 10px; height: 10px; margin-left: 145px;"></i>
                    </a>
                </p>
                <div id="submenu2" class="submenu2">
                    <p><a href="Home_SanPham.php" style="text-decoration: none; color: black; height: 20px; margin-left: 60px;">Danh Sách Sản phẩm</a></p>
                    <p><a href="Home_NhomSanPham.php" style="text-decoration: none; color: black; height: 20px; margin-left: 60px;">Nhóm Sản Phẩm</a></p>
                    <p><a href="Home_NhomDonVi.php" style="text-decoration: none; color: black; height: 20px; margin-left: 60px;">Nhóm Đơn Vị</a></p>
                    <!-- <p><a href="#" style="text-decoration: none; color: black; height: 40px; margin-left: 60px;">Hóa Đơn</a></p> -->
                </div>
            </div>

            <div style="text-align: left; margin-top: 20px;">
                <p>
                    <a href="javascript:void(0);" style="text-decoration: none; color: black;" onclick="toggleSubMenu3()">
                        <img src="icon/briefcase.png" alt="Icon Sản phẩm" style="width: 20px; height: 20px; margin-right: 10px;">
                        Công Việc
                        <i id="toggle-icon3" class="fas fa-chevron-right toggle-icon2" style="width: 10px; height: 10px; margin-left: 145px;"></i>
                    </a>
                </p>
                <div id="submenu3" class="submenu3">
                    <p><a href="Home_CongViec.php" style="text-decoration: none; color: black; height: 20px; margin-left: 60px;">Danh Sách Công Việc</a></p>
                    <p><a href="#" style="text-decoration: none; color: black; height: 20px; margin-left: 60px;">Dự Án</a></p>
                    <p><a href="#" style="text-decoration: none; color: black; height: 20px; margin-left: 60px;">Hỗ Trợ Khách Hàng</a></p>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="button-container">
                <button class="button" onclick="showModal()">
                    <i class="fas fa-plus"></i> Thêm Mới
                </button>

                <button class="button" onclick="window.location.href='export_lichcskh.php';">
                    <i class="fas fa-file-export"></i> Xuất Excel
                </button>

                <button class="button" onclick="printPage(); return false;">
                    <i class="fas fa-print"></i> In Dữ Liệu
                </button>
                <iframe id="print-frame" style="display:none;" src=""></iframe>
            </div>

            <div>
                <?php
                // Bao gồm file kết nối cơ sở dữ liệu
                require 'db_conn.php';

                $sql = "SELECT ID_LichCSKH, TieuDe, TinhTrangCoHoi, NguonCoHoi, NgayDuKien, GuiDen, HovaTen, TrangThai FROM lichcskh";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<table>
        <tr>
            <th>STT</th>
            <th>Tiêu Đề</th>
            <th>Tình Trạng</th>
            <th>Nguồn Cơ hội</th>
            <th>Ngày Chăm Sóc</th>
            <th>Gửi Đến</th>
            <th>Phụ Trách</th>
            <th>Trạng Thái</th>
        </tr>";
                    $stt = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr class='row'>
        <td>" . $stt . "</td>
        <td>" . $row["TieuDe"] . "
            <div class='actions'>
                <button onclick='editRecord(" . $row["ID_LichCSKH"] . ")'>Sửa</button>
                <button onclick='deleteOpportunity(" . $row["ID_LichCSKH"] . ")'>Xóa</button>
            </div>
        </td>
        <td>" . $row["TinhTrangCoHoi"] . "</td>
        <td>" . $row["NguonCoHoi"] . "</td>
        <td>" . $row["NgayDuKien"] . "</td>
        <td>" . $row["GuiDen"] . "</td>
        <td>" . $row["HovaTen"] . "</td>
        <td>" . $row["TrangThai"] . "</td>
    </tr>";
                        $stt++;
                    }
                    echo "</table>";
                } else {
                    echo "Không có dữ liệu.";
                }

                $conn->close();
                ?>
            </div>
        </div>
    </div>

    <div id="add-new-modal" style="display:none;">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Thêm Mới Cơ Hội</h2>
            <form id="add-new-form" method="POST" action="add_new_opportunity.php">
                <label for="title">Tiêu Đề:</label>
                <input type="text" id="title" name="title" required><br><br>

                <label for="status">Tình Trạng Cơ Hội:</label>
                <input type="text" id="status" name="status" required><br><br>

                <label for="source">Nguồn Cơ Hội:</label>
                <input type="text" id="source" name="source" required><br><br>

                <label for="expected-date">Ngày Dự Kiến:</label>
                <input type="date" id="expected-date" name="expected-date" required><br><br>

                <label for="send-to">Gửi Đến:</label>
                <select id="send-to" name="send-to[]" multiple style="width: 100%; height: 100px;">
                    <!-- Options will be populated by JavaScript -->
                </select><br><br>

                <label for="in-charge">Phụ Trách:</label>
                <select id="in-charge" name="in-charge" style="width: 100%;">
                    <!-- Options will be populated by JavaScript -->
                </select><br><br>

                <label for="status">Trạng Thái:</label>
                <input type="text" id="status" name="status" required><br><br>

                <button type="submit">Lưu</button>
                <button type="button" onclick="closeModal()">Hủy</button>
            </form>
        </div>
    </div>

    <script>
        function showModal() {
            document.getElementById('add-new-modal').style.display = 'block';
            loadSendToOptions();
            loadInChargeOptions();
        }
        /*Xuất file */
        function exportData(type) {
            let url = 'export.php?export=' + type;
            if (type === 'print') {
                window.open(url, '_blank');
            } else {
                window.location.href = url;
            }
        }

        function closeModal() {
            document.getElementById('add-new-modal').style.display = 'none';
        }

        function loadSendToOptions() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'get_send_to_options.php', true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var options = JSON.parse(xhr.responseText);
                    var select = document.getElementById('send-to');
                    select.innerHTML = '';
                    options.forEach(function(option) {
                        var opt = document.createElement('option');
                        opt.value = option.value;
                        opt.textContent = option.text;
                        select.appendChild(opt);
                    });
                }
            };
            xhr.send();
        }

        function loadInChargeOptions() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'get_in_charge_options.php', true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var options = JSON.parse(xhr.responseText);
                    var select = document.getElementById('in-charge');
                    select.innerHTML = '';
                    options.forEach(function(option) {
                        var opt = document.createElement('option');
                        opt.value = option.value;
                        opt.textContent = option.text;
                        select.appendChild(opt);
                    });
                }
            };
            xhr.send();
        }

        function printPage() {
            var frame = document.getElementById('print-frame');
            frame.src = 'print_reportlichcskh.php'; // Đặt URL của trang in
            frame.onload = function() {
                frame.contentWindow.print(); // Gọi hàm in của frame khi tải xong
            };
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('list-opportunities').addEventListener('click', function() {
                window.location.href = 'Home_CHBH.php';
            });
        });

        function toggleSubMenu() {
            var submenu = document.getElementById('submenu');
            var icon = document.getElementById('toggle-icon');
            if (submenu.style.display === 'none' || submenu.style.display === '') {
                submenu.style.display = 'block';
                icon.classList.add('down');
            } else {
                submenu.style.display = 'none';
                icon.classList.remove('down');
            }
        }

        function toggleSubMenu2() {
            var submenu = document.getElementById('submenu2');
            var toggleIcon = document.getElementById('toggle-icon2');

            if (submenu.style.display === 'block') {
                submenu.style.display = 'none';
                toggleIcon.classList.remove('down');
            } else {
                submenu.style.display = 'block';
                toggleIcon.classList.add('down');
            }
        }

        function toggleSubMenu3() {
            var submenu = document.getElementById('submenu3');
            var toggleIcon = document.getElementById('toggle-icon3');

            if (submenu.style.display === 'block') {
                submenu.style.display = 'none';
                toggleIcon.classList.remove('down');
            } else {
                submenu.style.display = 'block';
                toggleIcon.classList.add('down');
            }
        }

        function editRecord(id) {
            // Hiển thị modal hoặc chuyển hướng đến trang chỉnh sửa
            window.location.href = 'edit_opportunity.php?id=' + id;
        }

        function deleteOpportunity(id) {
            if (confirm('Bạn có chắc chắn muốn xóa cơ hội này?')) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'delete_opportunity.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        // Xóa thành công, làm mới trang
                        window.location.href = 'Home_LichCSKH.php';
                    } else {
                        alert('Lỗi khi xóa: ' + xhr.responseText);
                    }
                };
                xhr.send('ID_LichCSKH=' + encodeURIComponent(id));
            }
        }
    </script>
</body>

</html>