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
                    <p><a href="Home_NhomSanPham.php" style="text-decoration: none; color: black; height: 20px; margin-left: 60px;">Nhóm Sản Phẩm</a></p>
                    <p><a href="Home_NhomDonVi.php" style="text-decoration: none; color: black; height: 20px; margin-left: 60px;">Nhóm Đơn Vị</a></p>
                    <p><a href="#" style="text-decoration: none; color: black; height: 40px; margin-left: 60px;">Hóa Đơn</a></p>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="button-container">

                <button class="button" onclick="openModal()">
                    <i class="fas fa-plus"></i> Thêm Mới
                </button>

                <button class="button" onclick="">
                    <i class="fas fa-upload"></i> Nhập Từ File
                </button>

                <button class="button" onclick="window.location.href='#';">
                    <i class="fas fa-file-export"></i> Xuất Excel
                </button>

                <button class="button" onclick="printPage(); return false;">
                    <i class="fas fa-print"></i> In Danh Sách Sản Phẩm
                </button>
                <iframe id="print-frame" style="display:none;" src=""></iframe>
            </div>


            <!-- Modal -->
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <h2>Thêm Mới Sản Phẩm</h2>
                    <form id="addProductForm" action="add_product.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="TenSanPham" class="form-label">Tên Sản Phẩm</label>
                            <input type="text" id="TenSanPham" name="TenSanPham" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="MoTa" class="form-label">Mô Tả</label>
                            <textarea id="MoTa" name="MoTa" class="form-control" rows="4" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="Anh" class="form-label">Ảnh</label>
                            <input type="file" id="Anh" name="Anh" class="form-control" accept="image/*" required>
                        </div>
                        <div class="form-group">
                            <label for="Gia" class="form-label">Giá</label>
                            <input type="number" id="Gia" name="Gia" class="form-control" step="0.01" required>
                        </div>

                        <div class="form-group">
                            <label for="ThuocNhom" class="form-label">Thuộc Nhóm</label>
                            <select id="ThuocNhom" name="ThuocNhom" class="form-control" required>
                                <!-- Option will be filled by PHP -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="DonVi" class="form-label">Đơn Vị</label>
                            <select id="DonVi" name="DonVi" class="form-control" required>
                                <!-- Option will be filled by PHP -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Kho" class="form-label">Kho</label>
                            <input type="text" id="Kho" name="Kho" class="form-control" required>
                        </div>
                        <button type="submit" class="button">Lưu</button>
                    </form>
                </div>
            </div>


            <div>
                <form action="delete_products.php" method="post">
                    <table border="1" cellpadding="10">
                        <tr>
                            <th>Chọn</th>
                            <th>STT</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Mô Tả</th>
                            <th>Ảnh</th>
                            <th>Giá</th>
                            <th>Nhóm</th>
                            <th>Đơn Vị</th>
                            <th>Kho</th>
                            <th>Tùy Chọn</th> <!-- Thêm cột Tùy Chọn -->
                        </tr>
                        <?php
                        require 'db_conn.php'; // Đảm bảo đã có kết nối cơ sở dữ liệu

                        $sql = "
            SELECT 
                s.Id_SanPham,
                s.TenSanPham,
                s.MoTa,
                s.Anh,
                s.Gia,
                n.TenNhom AS TenNhom,
                d.TenDonVi AS TenDonVi,
                s.Kho
            FROM 
                sanpham s
            JOIN 
                nhomsanpham n ON s.ThuocNhom = n.Id_NhomSanPham
            JOIN 
                nhomdonvi d ON s.DonVi = d.Id_NhomDonVi
        ";

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $stt = 1; // Khởi tạo số thứ tự
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td><input type='checkbox' name='ids[]' value='" . $row['Id_SanPham'] . "'></td>";
                                echo "<td>" . $stt . "</td>"; // Hiển thị STT
                                echo "<td>" . $row['TenSanPham'] . "</td>";
                                echo "<td>" . $row['MoTa'] . "</td>";
                                echo "<td><img src='" . $row['Anh'] . "' alt='" . $row['TenSanPham'] . "' width='100'></td>";
                                echo "<td>" . $row['Gia'] . "</td>";
                                echo "<td>" . $row['TenNhom'] . "</td>";
                                echo "<td>" . $row['TenDonVi'] . "</td>";
                                echo "<td>" . $row['Kho'] . "</td>";
                                echo "<td>
                        <a href='edit_product_form.php?id=" . $row['Id_SanPham'] . "' class='btn btn-warning'>Chỉnh Sửa</a>
                      </td>";
                                echo "</tr>";
                                $stt++;
                            }
                        } else {
                            echo "<tr><td colspan='9'>Không có sản phẩm nào.</td></tr>";
                        }

                        $conn->close();
                        ?>
                    </table>
                    <input type="submit" name="delete" value="Xóa Sản Phẩm">
                </form>
            </div>



            <script>
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

                function openModal() {
                    document.getElementById('myModal').style.display = 'block';
                    loadDropdowns();
                }

                function closeModal() {
                    document.getElementById('myModal').style.display = 'none';
                }

                function loadDropdowns() {
                    fetch('get_dropdowns.php')
                        .then(response => response.json())
                        .then(data => {
                            const thuocNhomSelect = document.getElementById('ThuocNhom');
                            const donViSelect = document.getElementById('DonVi');

                            data.thuocNhom.forEach(item => {
                                const option = document.createElement('option');
                                option.value = item.Id_NhomSanPham;
                                option.text = item.TenNhom;
                                thuocNhomSelect.appendChild(option);
                            });

                            data.donVi.forEach(item => {
                                const option = document.createElement('option');
                                option.value = item.Id_NhomDonVi;
                                option.text = item.TenDonVi;
                                donViSelect.appendChild(option);
                            });
                        });
                }
                
            </script>
        </div>
</body>

</html>