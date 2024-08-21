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
                    <i class="fas fa-plus"></i> Thêm Nhóm Sản Phẩm
                </button>

            </div>


            <table id="group-table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên Nhóm</th>
                        <th>Mô Tả</th>
                        <th>Tùy Chọn</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require 'db_conn.php'; // Kết nối cơ sở dữ liệu

                    $sql = "SELECT Id_NhomSanPham, TenNhom, MoTa FROM nhomsanpham";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $stt = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $stt . "</td>";
                            echo "<td>" . htmlspecialchars($row['TenNhom']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['MoTa']) . "</td>";
                            echo "<td>";
                            echo "<button class='button edit-button' data-id='" . $row['Id_NhomSanPham'] . "'>Chỉnh Sửa</button>";
                            echo " <button class='button delete-button' data-id='" . $row['Id_NhomSanPham'] . "'>Xóa</button>";
                            echo "</td>";
                            echo "</tr>";
                            $stt++;
                        }
                    } else {
                        echo "<tr><td colspan='4'>Không có nhóm sản phẩm nào.</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>




            <!-- Modal for adding new group -->
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <h2>Thêm Mới Nhóm Sản Phẩm</h2>
                    <form id="addGroupForm" action="add_group.php" method="POST">
                        <div class="form-group">
                            <label for="tenNhom" class="form-label">Tên Nhóm:</label>
                            <input type="text" id="tenNhom" name="tenNhom" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="moTa" class="form-label">Mô Tả:</label>
                            <textarea id="moTa" name="moTa" class="form-control" required></textarea>
                        </div>
                        <button type="submit" class="button">Lưu</button>
                    </form>
                </div>
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
                }

                document.getElementById('addGroupForm').addEventListener('submit', function(event) {
                    event.preventDefault(); // Ngăn chặn hành vi gửi form mặc định

                    var form = event.target;
                    var formData = new FormData(form);

                    fetch('add_group.php', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                // Hiển thị thông báo thành công (tùy chỉnh theo nhu cầu)
                                alert(data.message);

                                // Đóng modal
                                closeModal();

                                // Chuyển hướng trang sau khi đóng modal
                                window.location.href = 'Home_NhomSanPham.php';
                            } else {
                                // Hiển thị thông báo lỗi (tùy chỉnh theo nhu cầu)
                                alert(data.message);
                            }
                        })
                        .catch(error => {
                            alert('Đã xảy ra lỗi!');
                        });
                });

                // Hàm để đóng modal
                function closeModal() {
                    var modal = document.getElementById('myModal');
                    modal.style.display = 'none';
                }
                document.addEventListener('DOMContentLoaded', function() {
                    // Xử lý sự kiện nút xóa
                    const deleteButtons = document.querySelectorAll('.delete-button');
                    deleteButtons.forEach(button => {
                        button.addEventListener('click', function() {
                            const idNhom = this.getAttribute('data-id');
                            if (confirm('Bạn có chắc chắn muốn xóa nhóm sản phẩm này?')) {
                                fetch('delete_group.php', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/x-www-form-urlencoded'
                                        },
                                        body: new URLSearchParams({
                                            'idNhom': idNhom
                                        })
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.status === 'success') {
                                            alert(data.message);
                                            window.location.href = 'Home_NhomSanPham.php'; // Chuyển hướng về trang Home_NhomSanPham.php
                                        } else {
                                            alert(data.message);
                                        }
                                    })
                                    .catch(error => {
                                        alert('Đã xảy ra lỗi!');
                                    });
                            }
                        });
                    });

                    // Xử lý sự kiện nút chỉnh sửa
                    const editButtons = document.querySelectorAll('.edit-button');
                    editButtons.forEach(button => {
                        button.addEventListener('click', function() {
                            const idNhom = this.getAttribute('data-id');
                            window.location.href = 'edit_nhomsanpham_form.php?id=' + idNhom;
                        });
                    });
                });
            </script>
        </div>
</body>

</html>