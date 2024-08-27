<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <title>Danh Sách Công Việc</title>

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

        /* Form heading */
        .modal-content h2 {
            text-align: center;
            margin-bottom: 20px;
            font-family: 'Arial', sans-serif;
            color: #333;
        }

        /* Close button */
        .close {
            color: #aaa;
            float: right;
            font-size: 24px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        /* Form group */
        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        /* Input styles */
        .form-control {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        /* Button styles */
        .button-primary {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .button-primary:hover {
            background-color: #0056b3;
        }

        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-success {
            background-color: #28a745;
            color: white;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
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

                <button class="button" onclick="window.location.href='Insert_CongViec.php';">
                    <i class="fas fa-plus"></i> Thêm Mới
                </button>

                <button class="button" onclick="showUploadModal()">
                    <i class="fas fa-upload"></i> Thêm Nhóm Liên Quan
                </button>


            </div>

            <!-- Modal thêm nhóm liên quan -->
            <!-- Modal thêm nhóm liên quan -->
            <div id="uploadModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeUploadModal()">&times;</span>
                    <h2>Thêm Nhóm Liên Quan</h2>
                    <form id="uploadForm" action="upload_lienquanden.php" method="POST">
                        <div class="form-group">
                            <label for="TenLienQuanDen">Tên Nhóm Liên Quan:</label>
                            <input type="text" id="TenLienQuanDen" name="TenLienQuanDen" class="form-control" placeholder="Nhập tên nhóm liên quan" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Thêm</button>
                            <button type="button" class="btn btn-secondary" onclick="closeUploadModal()">Hủy</button>
                        </div>
                    </form>
                </div>
            </div>



            <div>
                <?php
                // Bao gồm file kết nối cơ sở dữ liệu
                require 'db_conn.php';

                // Truy vấn dữ liệu từ bảng congviec
                $sql = "SELECT Id_CongViec, TenCongViec, MoTaCongViec, NgayBatDau, NgayKetThuc, LienQuanDen, TinhTrang, NguoiThucHien, MucDo FROM congviec";
                $result = $conn->query($sql);

                // Kiểm tra và hiển thị dữ liệu
                if ($result->num_rows > 0) {
                    echo "<table>";
                    echo "<tr>
                <th>STT</th>
                <th>Tên Công Việc</th>
                <th>Mô Tả Công Việc</th>
                <th>Ngày Bắt Đầu</th>
                <th>Ngày Kết Thúc</th>
                <th>Liên Quan Đến</th>
                <th>Tình Trạng</th>
                <th>Người Thực Hiện</th>
                <th>Mức Độ</th>
                <th>Hành Động</th>
            </tr>";

                    // Lặp qua từng dòng kết quả
                    $stt = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr class='data-row'>";
                        echo "<td>" . $stt++ . "</td>";
                        echo "<td><a href='CT_CongViec.php?Id_CongViec=" . $row['Id_CongViec'] . "' style='color: black; text-decoration: none;'>" . $row['TenCongViec'] . "</a></td>";

                        echo "<td>" . $row["MoTaCongViec"] . "</td>";
                        echo "<td>" . $row["NgayBatDau"] . "</td>";
                        echo "<td>" . $row["NgayKetThuc"] . "</td>";
                        echo "<td>" . $row["LienQuanDen"] . "</td>";
                        echo "<td>" . $row["TinhTrang"] . "</td>";
                        echo "<td>" . $row["NguoiThucHien"] . "</td>";
                        echo "<td>" . $row["MucDo"] . "</td>";
                        echo "<td>
                    <span class='action-buttons'>
                        <button class='action-button delete' data-id='" . $row["Id_CongViec"] . "'>Xóa</button>
                        <button class='action-button edit' data-id='" . $row["Id_CongViec"] . "'>Chỉnh sửa</button>
                    </span>
                  </td>";
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

                function openModal() {
                    document.getElementById('myModal').style.display = 'block';
                    loadDropdowns();
                }

                function closeModal() {
                    document.getElementById('myModal').style.display = 'none';
                }

                document.addEventListener('DOMContentLoaded', function() {
                    // Xóa công việc
                    document.querySelectorAll('.action-button.delete').forEach(function(button) {
                        button.addEventListener('click', function() {
                            if (confirm('Bạn có chắc chắn muốn xóa công việc này?')) {
                                let idCongViec = this.getAttribute('data-id');
                                fetch('Delete_CongViec.php', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/x-www-form-urlencoded'
                                        },
                                        body: 'idCongViec=' + encodeURIComponent(idCongViec)
                                    })
                                    .then(response => {
                                        if (!response.ok) {
                                            throw new Error('Network response was not ok');
                                        }
                                        return response.text();
                                    })
                                    .then(result => {
                                        alert('Công việc đã được xóa thành công.');
                                        // Tải lại trang để cập nhật danh sách công việc
                                        window.location.reload();
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                        alert('Đã xảy ra lỗi khi xóa công việc.');
                                    });
                            }
                        });
                    });


                    // Chỉnh sửa công việc
                    document.querySelectorAll('.action-button.edit').forEach(function(button) {
                        button.addEventListener('click', function() {
                            let idCongViec = this.getAttribute('data-id');
                            window.location.href = 'Edit_CongViec.php?idCongViec=' + encodeURIComponent(idCongViec);
                        });
                    });
                });

                // Hiển thị modal
                function showUploadModal() {
                    document.getElementById("uploadModal").style.display = "block";
                }

                // Đóng modal
                function closeUploadModal() {
                    document.getElementById("uploadModal").style.display = "none";
                }

                // Đóng modal khi người dùng nhấn ra ngoài
                window.onclick = function(event) {
                    var modal = document.getElementById("uploadModal");
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                }
            </script>
        </div>
</body>

</html>