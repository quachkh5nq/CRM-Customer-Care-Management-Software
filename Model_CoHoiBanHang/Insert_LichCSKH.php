<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <title>Cơ Hội Bán Hàng</title>

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
                        Cơ Hội Bán Hàng
                        <i id="toggle-icon" class="fas fa-chevron-right toggle-icon" style="width: 10px; height: 10px; margin-left: 65px;"></i>
                    </a>
                </p>
                <div id="submenu" class="submenu">
                    <p><a href="Home_CHBH.php" style="text-decoration: none; color: black; height: 20px; margin-left: 30px;">Danh Sách Cơ Hội</a></p>
                    <p><a href="javascript:void(0);" id="list-opportunities" style="text-decoration: none; color: black; height: 40px; margin-left: 30px;">Lịch Chăm Sóc</a></p>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="button-container">
                <button class="button" onclick="showModal()">
                    <i class="fas fa-plus"></i> Thêm Mới
                </button>

                <button class="button" onclick="window.location.href='export_csv.php';">
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

                $sql = "SELECT TieuDe, TinhTrangCoHoi, NguonCoHoi, NgayDuKien, GuiDen, HovaTen, TrangThai FROM lichcskh";
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
                        echo "<tr>
                <td>" . $stt++ . "</td>
                <td>" . $row["TieuDe"] . "</td>
                <td>" . $row["TinhTrangCoHoi"] . "</td>
                <td>" . $row["NguonCoHoi"] . "</td>
                <td>" . $row["NgayDuKien"] . "</td>
                <td>" . $row["GuiDen"] . "</td>
                <td>" . $row["HovaTen"] . "</td>
                <td>" . $row["TrangThai"] . "</td>
            </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "Không có dữ liệu";
                }

                $conn->close();
                ?>
            </div>
        </div>
    </div>

    <!-- Modal Thêm Mới -->
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
            var printFrame = document.getElementById('print-frame');
            printFrame.src = 'data:text/html,' + encodeURIComponent(document.querySelector('.content').innerHTML);
            printFrame.onload = function() {
                printFrame.contentWindow.focus();
                printFrame.contentWindow.print();
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
    </script>
</body>

</html>