<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <title>Danh Sách Sản Phẩm</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
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
            margin: -20px -20px 20px -20px;
            border-radius: 5px;
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

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 800px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
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

        /* Add some basic styling here */
        h2 {
            margin-top: 0;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .form-col {
            flex: 1;
            min-width: 300px;
        }

        .customer-link {
            color: black;
            /* Thay đổi màu chữ liên kết */
            text-decoration: none;
            /* Bỏ gạch dưới liên kết */
        }

        .customer-link:hover {
            color: #007bff;
            /* Màu chữ khi di chuột qua liên kết, tùy chọn */
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
                    <p><a href="#" style="text-decoration: none; color: black; height: 40px; margin-left: 60px;">Hóa Đơn</a></p>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="button-container">
                <button class="button" onclick="showModal()">
                    <i class="fas fa-plus"></i> Thêm Mới
                </button>

                <button class="button" onclick="">
                    <i class="fas fa-upload"></i> Nhập Từ File
                </button>

                <button class="button" onclick="window.location.href='#';">
                    <i class="fas fa-file-export"></i> Xuất Excel
                </button>

                <button class="button" onclick="printPage(); return false;">
                    <i class="fas fa-print"></i> In Dữ Liệu
                </button>
                <iframe id="print-frame" style="display:none;" src=""></iframe>
            </div>

            <div>
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

                // Truy vấn dữ liệu từ bảng sanpham
                $sql = "SELECT Id_SanPham, TenSanPham, MoTa, Anh, Gia, DonViTien, ThuocNhom, DonVi, Kho FROM sanpham";
                $result = $conn->query($sql);

                // Kiểm tra và in ra dữ liệu
                if ($result->num_rows > 0) {
                    // In tiêu đề bảng
                    echo "<table border='1'>";
                    echo "<tr>
                        <th>STT</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Mô Tả</th>
                        <th>Ảnh</th>
                        <th>Giá</th>
                        <th>Đơn Vị Tiền</th>
                        <th>Thuộc Nhóm</th>
                        <th>Đơn Vị</th>
                        <th>Kho</th>
                        </tr>";

                    // In từng dòng dữ liệu
                    $stt = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $stt++ . "</td>";
                        echo "<td>" . $row["TenSanPham"] . "</td>";
                        echo "<td>" . $row["MoTa"] . "</td>";
                        echo "<td><img src='" . $row["Anh"] . "' alt='Ảnh sản phẩm' style='width: 100px; height: auto;'></td>";
                        echo "<td>" . $row["Gia"] . "</td>";
                        echo "<td>" . $row["DonViTien"] . "</td>";
                        echo "<td>" . $row["ThuocNhom"] . "</td>";
                        echo "<td>" . $row["DonVi"] . "</td>";
                        echo "<td>" . $row["Kho"] . "</td>";
                    
                        echo "</tr>";
                    }

                    echo "</table>";
                } else {
                    echo "Không có dữ liệu.";
                }

                // Đóng kết nối
                $conn->close();
                ?>


                <div id="myModal" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="closeModal()">&times;</span>
                        <h2>Thêm Mới Khách Hàng</h2>
                        <form id="addForm" action="add_khachhang.php" method="post">
                            <div class="form-row">
                                <div class="form-col">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Tên Khách Hàng</label>
                                        <input type="text" id="name" name="name" class="form-control" required>

                                    </div>
                                    <div class="form-group">
                                        <label for="contact" class="form-label">Liên Hệ Chính</label>
                                        <input type="text" id="contact" name="contact" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="website" class="form-label">Trang Web</label>
                                        <input type="text" id="website" name="website" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="taxcode" class="form-label">Mã Số Thuế</label>
                                        <input type="text" id="taxcode" name="taxcode" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="address" class="form-label">Địa Chỉ</label>
                                        <input type="text" id="address" name="address" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" id="phone" name="phone" class="form-control">
                                    </div>
                                </div>
                                <div class="form-col">
                                    <div class="form-group">
                                        <label for="customer_group" class="form-label">Nhóm Khách Hàng</label>
                                        <select id="customer_group" name="customer_group" class="form-control">
                                            <option value="VIP">VIP</option>
                                            <option value="Hài lòng">Hài lòng</option>
                                            <option value="Không hài lòng">Không hài lòng</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="region" class="form-label">Khu Vực</label>
                                        <select id="region" name="region" class="form-control">
                                            <option value="Miền Nam">Miền Nam</option>
                                            <option value="Miền Trung">Miền Trung</option>
                                            <option value="Miền Bắc">Miền Bắc</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="currency" class="form-label">Đơn Vị Tiền</label>
                                        <select id="currency" name="currency" class="form-control">
                                            <option value="USD">USD</option>
                                            <option value="VND">VND</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="establishment_date" class="form-label">Ngày Thành Lập</label>
                                        <input type="date" id="establishment_date" name="establishment_date" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" id="email" name="email" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="status" class="form-label">Trạng Thái</label>
                                        <select id="status" name="status" class="form-control">
                                            <option value="Hoạt động">Hoạt động</option>
                                            <option value="Không hoạt động">Không hoạt động</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="person_in_charge" class="form-label">Người Phụ Trách</label>
                                        <select id="person_in_charge" name="person_in_charge" class="form-control">
                                            <?php
                                            // Kết nối đến cơ sở dữ liệu
                                            $conn = new mysqli($servername, $username, $password, $dbname);

                                            // Kiểm tra kết nối
                                            if ($conn->connect_error) {
                                                die("Kết nối thất bại: " . $conn->connect_error);
                                            }

                                            // Truy vấn dữ liệu từ bảng nhanvien
                                            $sql = "SELECT HovaTen FROM nhanvien";
                                            $result = $conn->query($sql);

                                            // Kiểm tra và in ra dữ liệu
                                            if ($result->num_rows > 0) {
                                                // In từng tùy chọn
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<option value=\"" . $row["HovaTen"] . "\">" . $row["HovaTen"] . "</option>";
                                                }
                                            } else {
                                                echo "<option value=\"\">Không có dữ liệu</option>";
                                            }

                                            // Đóng kết nối
                                            $conn->close();
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="created_date" class="form-label">Ngày Tạo</label>
                                <input type="date" id="created_date" name="created_date" class="form-control">
                            </div>
                            <button type="submit" class="button">Thêm Mới</button>
                        </form>
                    </div>
                </div>

                <script>
                    function showModal() {
                        document.getElementById('myModal').style.display = 'block';
                    }

                    function closeModal() {
                        document.getElementById('myModal').style.display = 'none';
                    }

                    function openModal() {
                        document.getElementById('myModal').style.display = 'block';
                    }

                    function toggleSubMenu() {
                        var submenu = document.getElementById('submenu');
                        var toggleIcon = document.getElementById('toggle-icon');

                        if (submenu.style.display === 'block') {
                            submenu.style.display = 'none';
                            toggleIcon.classList.remove('down');
                        } else {
                            submenu.style.display = 'block';
                            toggleIcon.classList.add('down');
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

                    function deleteCustomer(id) {
                        if (confirm("Bạn có chắc chắn muốn xóa khách hàng này?")) {
                            // Gửi yêu cầu xóa đến server
                            window.location.href = 'delete_khachhang.php?id=' + id;
                        }
                    }
                </script>
            </div>
        </div>
</body>

</html>