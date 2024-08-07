<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Thêm liên kết tới Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Cơ Hội Bán Hàng</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            overflow: hidden;
            /* Ngăn không cho cuộn trang chính khi modal mở */
        }

        .container {
            display: flex;
            width: 100%;
            height: 100vh;
            gap: 20px;
            padding: 20px;
            box-sizing: border-box;
            overflow: hidden;
            /* Đảm bảo không có cuộn dọc trong phần chính */
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
            margin: 10% auto;
            /* Đặt margin cho modal-content để căn giữa modal */
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

        .action-buttons {
            display: none;
            margin-left: 10px;
        }

        .data-row:hover .action-buttons {
            display: inline-block;
        }

        .action-button {
            background-color: #ff6b6b;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
            margin-right: 5px;
        }

        .action-button.edit {
            background-color: #4caf50;
        }

        .upload-modal {
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

        .upload-modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .upload-close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .upload-close:hover,
        .upload-close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .upload-form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .upload-form input[type="file"] {
            margin-bottom: 20px;
        }

        /* Modal container */
        .upload-modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        /* Modal content */
        .upload-modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 40%;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.5s;
        }

        /* Close button */
        .upload-close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .upload-close:hover,
        .upload-close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Form styles */
        .upload-form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .upload-form label {
            margin-bottom: 10px;
            font-size: 18px;
        }

        .upload-form input[type="file"] {
            padding: 10px;
            margin-bottom: 20px;
        }

        .upload-form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .upload-form input[type="submit"]:hover {
            background-color: #45a049;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Thêm CSS cho modal và thông báo */
        .upload-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
        }

        .upload-modal-content {
            background-color: #fff;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        .upload-close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .upload-close:hover,
        .upload-close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .upload-form input[type="file"] {
            margin: 10px 0;
        }

        .alert {
            background-color: #f44336;
            color: white;
            padding: 15px;
            margin: 20px;
            border-radius: 5px;
            display: none;
        }

        .alert.success {
            background-color: #4CAF50;
        }


        /* xuất dữ liệu */
        /* Style cho nút và menu thả xuống */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: #3e8e41;
        }

        .dropbtn {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        /* Check dữ lieu ten khi click vao ten ở bảng khachhangch */
        .customer-link {
            color: black;
            /* Màu chữ đen */
            text-decoration: none;
            /* Không gạch dưới */
        }

        .customer-link:hover {
            text-decoration: underline;
            /* Gạch dưới khi hover (tuỳ chọn) */
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
                    <p><a href="Home_LichCSKH.php" style="text-decoration: none; color: black; height: 40px; margin-left: 30px;">Lịch Chăm Sóc</a></p>
                </div>
            </div>
        </div>

        <!-- Content: Bảng Danh -->
        <!-- <div class="content" id="data-container" style="display: none;"> -->
        <div class="content">

            <!-- Nút nằm ngang -->
            <div class="button-container">
                <button class="button" onclick="showModal()">
                    <i class="fas fa-plus"></i> Thêm Mới
                </button>
                <button class="button" onclick="showUploadModal()">
                    <i class="fas fa-upload"></i> Nhập Từ File
                </button>

                <button class="button" onclick="window.location.href='export_csv.php';">
                    <i class="fas fa-file-export"></i> Xuất Excel
                </button>

                <button class="button" onclick="printPage(); return false;">
                    <i class="fas fa-print"></i> In Dữ Liệu
                </button>
                <iframe id="print-frame" style="display:none;" src=""></iframe>

                <button class="button">
                    <i class="fas fa-chart-bar"></i> Biểu Đồ
                </button>
            </div>

            <!-- Container cho bảng dữ liệu -->
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

                // Truy vấn dữ liệu từ bảng khachhangch và nhanvien
                $sql = "SELECT khachhangch.Id_KHCH, khachhangch.Ten, khachhangch.TenCongTy, khachhangch.Email, khachhangch.Phone, 
               nhanvien.HovaTen AS NguoiPhuTrach, khachhangch.TinhTrang, khachhangch.NguonCoHoi, khachhangch.NgayLienHe, 
               khachhangch.KhuVuc, khachhangch.GiaDuKien, khachhangch.NgayChotDuKien, khachhangch.MoTa
        FROM khachhangch 
        LEFT JOIN nhanvien ON khachhangch.NguoiPhuTrach = nhanvien.HovaTen";
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
            <th>Phụ Trách</th>
            <th>Tình Trạng</th>
            <th>Nguồn</th>
            <th>Liên Hệ</th>
            <th>Khu Vực</th>
        </tr>";

                    // Lặp qua từng dòng kết quả
                    $stt = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr class='data-row'>";
                        echo "<td>" . $stt++ . "</td>";
                        echo "<td><a href='Check_Cohoi.php?id=" . $row["Id_KHCH"] . "' class='customer-link'>" . $row["Ten"] . "</a>
                <span class='action-buttons'>
                    <button class='action-button delete' data-id='" . $row["Id_KHCH"] . "'>Xóa</button>
                    <button class='action-button edit' data-id='" . $row["Id_KHCH"] . "'>Chỉnh sửa</button>
                </span>
              </td>";
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

    <!-- Modal tải lên tệp -->
    <div id="uploadModal" class="upload-modal">
        <div class="upload-modal-content">
            <span class="upload-close" onclick="closeUploadModal()">&times;</span>
            <form id="uploadForm" class="upload-form" enctype="multipart/form-data">
                <label for="fileToUpload">Chọn tệp để tải lên:</label>
                <input type="file" name="fileToUpload" id="fileToUpload" required>
                <input type="submit" value="Tải lên Tệp">
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        /*Xuất file */
        function exportData(type) {
            let url = 'export.php?export=' + type;
            if (type === 'print') {
                window.open(url, '_blank');
            } else {
                window.location.href = url;
            }
        }


        function printPage() {
            var frame = document.getElementById('print-frame');
            frame.src = 'print_report.php'; // Đặt URL của trang in
            frame.onload = function() {
                frame.contentWindow.print(); // Gọi hàm in của frame khi tải xong
            };
        }



        function showUploadModal() {
            document.getElementById('uploadModal').style.display = 'flex';
        }

        function closeUploadModal() {
            document.getElementById('uploadModal').style.display = 'none';
        }

        $(document).ready(function() {
            $('#uploadForm').on('submit', function(event) {
                event.preventDefault(); // Ngăn chặn gửi form theo cách truyền thống

                var formData = new FormData(this);

                $.ajax({
                    url: 'upload_file.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        var result = JSON.parse(response);
                        if (result.status === 'success') {
                            toastr.success(result.message);
                        } else {
                            toastr.error(result.message);
                        }
                        // Đóng modal và quay lại trang chủ sau một thời gian ngắn
                        setTimeout(function() {
                            closeUploadModal();
                            location.reload(); // Tải lại trang để cập nhật dữ liệu
                        }, 2000);
                    },
                    error: function() {
                        toastr.error('Đã xảy ra lỗi khi gửi yêu cầu.');
                    }
                });
            });
        });
        // Toastr options
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "preventDuplicates": true,
            "positionClass": "toast-top-right", // Bạn có thể thay đổi vị trí nếu muốn
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };


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

        document.addEventListener('DOMContentLoaded', function() {
            // Xóa dữ liệu
            document.querySelectorAll('.action-button.delete').forEach(button => {
                button.addEventListener('click', function() {
                    var id = this.getAttribute('data-id');
                    if (confirm('Bạn có chắc chắn muốn xóa không?')) {
                        // Gửi yêu cầu xóa đến server
                        var xhr = new XMLHttpRequest();
                        xhr.open('POST', 'Delete_CoHoi.php', true);
                        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                        xhr.onload = function() {
                            if (xhr.status === 200) {
                                alert('Xóa thành công!');
                                location.reload(); // Tải lại trang sau khi xóa
                            } else {
                                alert('Lỗi khi xóa!');
                            }
                        };
                        xhr.send('id=' + id);
                    }
                });
            });

            // Chỉnh sửa dữ liệu
            document.querySelectorAll('.action-button.edit').forEach(button => {
                button.addEventListener('click', function() {
                    var id = this.getAttribute('data-id');
                    // Hiển thị form chỉnh sửa
                    var modal = document.getElementById('form-modal');
                    var formContent = document.getElementById('form-content');

                    modal.style.display = 'block';
                    document.body.style.overflow = 'hidden';

                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', 'Detail_CH.php?id=' + id, true);
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            formContent.innerHTML = xhr.responseText;
                        } else {
                            formContent.innerHTML = 'Lỗi tải nội dung.';
                        }
                    };
                    xhr.send();
                });
            });
        });


        function closeUploadModal() {
            document.getElementById("uploadModal").style.display = "none";
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