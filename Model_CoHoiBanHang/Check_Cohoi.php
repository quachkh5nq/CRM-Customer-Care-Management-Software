<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin và Cơ hội kinh doanh</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
        }

        .sidebar {
            width: 30%;
            padding: 20px;
            border-right: 1px solid #ddd;
        }

        .sidebar h3 {
            margin-top: 0;
        }

        .sidebar a {
            display: block;
            padding: 10px;
            margin-bottom: 10px;
            color: #333;
            text-decoration: none;
            border-radius: 5px;
            border: 1px solid transparent;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #f0f0f0;
            border-color: #ddd;
        }

        .content {
            width: 70%;
            padding: 20px;
        }

        .customer-info,
        .reminders,
        .care {
            display: none;
        }

        .customer-info.active,
        .reminders.active,
        .care.active {
            display: block;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        .button-container {
            margin-top: 20px;
            text-align: left;
        }

        .button-container button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-bottom: 10px;
        }

        .button-container button:hover {
            background-color: #0056b3;
        }

        .button-container button:focus {
            outline: none;
        }

        .reminder-form,
        #sms-form,
        #email-form {
            display: none;
            margin-top: 20px;
        }

        .reminder-form form,
        #sms-form form,
        #email-form form {
            display: flex;
            flex-direction: column;
        }

        .reminder-form input,
        #sms-form input,
        #sms-form textarea,
        #email-form input,
        #email-form textarea {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .reminder-form button,
        #sms-form button,
        #email-form button {
            background-color: #28a745;
            border: none;
            border-radius: 5px;
            padding: 10px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        .reminder-form button:hover,
        #sms-form button:hover,
        #email-form button:hover {
            background-color: #218838;
        }

        #sms-form {
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        #sms-form label,
        #email-form label {
            font-weight: bold;
            margin-bottom: 10px;
        }

        #sms-form input,
        #sms-form textarea,
        #email-form input,
        #email-form textarea {
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
        }

        #sms-form input,
        #email-form input {
            font-size: 14px;
        }

        #sms-form textarea,
        #email-form textarea {
            font-size: 14px;
            height: 100px;
            resize: vertical;
        }

        #sms-form button,
        #email-form button {
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            padding: 12px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            align-self: flex-start;
        }

        #sms-form button:hover,
        #email-form button:hover {
            background-color: #0056b3;
        }

        #email-form {
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
    </style>
    <script>
        function showContent(contentId) {
            var contents = document.querySelectorAll('.content > div');
            contents.forEach(function(content) {
                content.classList.remove('active');
            });

            document.getElementById(contentId).classList.add('active');

            var links = document.querySelectorAll('.sidebar a');
            links.forEach(function(link) {
                link.classList.remove('active');
            });
            document.querySelector('[data-content="' + contentId + '"]').classList.add('active');
        }

        function toggleReminderForm() {
            var form = document.getElementById('reminder-form');
            form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
        }

        function handleContactMethodChange() {
            var contactMethod = document.getElementById('contact_method').value;
            var smsForm = document.getElementById('sms-form');
            var emailForm = document.getElementById('email-form');

            if (contactMethod === 'sms') {
                smsForm.style.display = 'block';
                emailForm.style.display = 'none';
            } else if (contactMethod === 'email') {
                smsForm.style.display = 'none';
                emailForm.style.display = 'block';
            } else {
                smsForm.style.display = 'none';
                emailForm.style.display = 'none';
            }
        }
    </script>
</head>

<body>
    <div class="container">
        <div class="sidebar">
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
            $sql = "SELECT Id_KHCH, Ten FROM khachhangch WHERE Id_KHCH = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<h3>#" . $row['Id_KHCH'] . " - " . $row['Ten'] . "</h3>";
            } else {
                echo "<h3>Không tìm thấy khách hàng</h3>";
            }

            $stmt->close();
            ?>
            <a href="#" data-content="customer-info" onclick="showContent('customer-info'); return false;">Thông tin chung</a>
            <a href="#" data-content="reminders" onclick="showContent('reminders'); return false;">Nhắc nhở</a>
            <a href="#" data-content="care" >Hóa đơn</a>
            <a href="#" data-content="care" >Lịch sử mua hàng</a>
            <a href="#" data-content="care" >Ghi chú</a>
        </div>
        <div class="content">
            <div id="customer-info" class="customer-info active">
                <?php
                // Truy vấn thông tin khách hàng
                $sql = "SELECT * FROM khachhangch WHERE Id_KHCH = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
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
                } else {
                    echo "<p>Không tìm thấy thông tin khách hàng.</p>";
                }

                $stmt->close();
                ?>
            </div>
            <div id="reminders" class="reminders">
                <div class="button-container">
                    <button onclick="toggleReminderForm()">Thêm nhắc nhở</button>
                </div>
                <div id="reminder-form" class="reminder-form">
                    <form action="add_reminder.php" method="POST">
                        <input type="hidden" name="id_khch" value="<?php echo htmlspecialchars($id); ?>">
                        <input type="text" name="noi_dung" placeholder="Nội dung nhắc nhở" required>
                        <input type="date" name="ngay_nhac" placeholder="Ngày nhắc" required>
                        <input type="text" name="gui_den" placeholder="Gửi đến" required>
                        <textarea name="trang_thai" placeholder="Trạng thái thông báo" required></textarea>
                        <button type="submit">Thêm</button>
                    </form>
                </div>
                <?php
                // Truy vấn thông tin nhắc nhở từ bảng nhacnhokhch
                $sql = "SELECT * FROM nhacnhokhch WHERE Id_KHCH = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    echo "<div class='table-container'>";
                    echo "<table>";
                    echo "<tr><th>STT</th><th>Nội Dung</th><th>Ngày Nhắc</th><th>Gửi Đến</th><th>Trạng Thái</th><th>Thao Tác</th></tr>";
                    $stt = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $stt . "</td>";
                        echo "<td>" . htmlspecialchars($row['NoiDung']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['NgayNhac']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['GuiDen']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['TrangThaiThongBao']) . "</td>";
                        echo "<td>
                            <form action='delete_reminder.php' method='POST' style='display:inline;'>
                                <input type='hidden' name='id_nhacnhokhch' value='" . htmlspecialchars($row['Id_nhacnhokhch']) . "'>
                                <button type='submit'>Xóa</button>
                            </form>
                            <form action='edit_reminder.php' method='GET' style='display:inline;'>
                                <input type='hidden' name='id_nhacnhokhch' value='" . htmlspecialchars($row['Id_nhacnhokhch']) . "'>
                                <button type='submit'>Chỉnh sửa</button>
                            </form>
                        </td>";
                        echo "</tr>";
                        $stt++;
                    }
                    echo "</table>";
                    echo "</div>";
                } else {
                    echo "<p>Không có nhắc nhở nào.</p>";
                }

                $stmt->close();
                ?>
            </div>

            <div id="care" class="care">
                <div class="button-container">
                    <form action="send_sms.php" method="POST">
                        <label for="contact_method">Chọn phương thức liên hệ:</label>
                        <select id="contact_method" name="contact_method" onchange="handleContactMethodChange()">
                            <option value="email">Email</option>
                            <option value="sms">SMS</option>
                        </select>

                        <div id="sms-form" style="display: none;">
                            <?php
                            // Kết nối cơ sở dữ liệu
                            $conn = new mysqli($servername, $username, $password, $dbname);

                            if ($conn->connect_error) {
                                die("Kết nối thất bại: " . $conn->connect_error);
                            }

                            // Truy vấn thông tin khách hàng
                            $sql = "SELECT Phone FROM khachhangch WHERE Id_KHCH = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("i", $id);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            $phone = "";
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $phone = htmlspecialchars($row['Phone']);
                            }

                            $stmt->close();
                            $conn->close();
                            ?>
                            <input type="text" name="phone_number" placeholder="Số điện thoại" value="<?php echo $phone; ?>" required>
                            <textarea name="message" placeholder="Tin nhắn" required></textarea>
                            <button type="submit">Gửi SMS</button>
                        </div>

                        <div id="email-form" style="display: none;">
                            <?php
                            // Kết nối cơ sở dữ liệu
                            $conn = new mysqli($servername, $username, $password, $dbname);

                            if ($conn->connect_error) {
                                die("Kết nối thất bại: " . $conn->connect_error);
                            }

                            // Truy vấn thông tin khách hàng
                            $sql = "SELECT Email FROM khachhangch WHERE Id_KHCH = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("i", $id);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            $email = "";
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $email = htmlspecialchars($row['Email']);
                            }

                            $stmt->close();
                            $conn->close();
                            ?>
                            <label for="from_email">Gửi từ:</label>
                            <select id="from_email" name="from_email">
                                <option value="personal">Email cá nhân</option>
                                <option value="system">Email hệ thống</option>
                            </select>
                            <input type="text" name="to_email" placeholder="Gửi đến" value="<?php echo $email; ?>" required>
                            <input type="text" name="subject" placeholder="Tiêu đề email" required>
                            <textarea name="body" placeholder="Nội dung email" required></textarea>
                            <button type="submit">Gửi Email</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</body>

</html>

