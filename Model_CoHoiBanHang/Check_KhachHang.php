<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Chi Tiết Khách Hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            display: flex;
            border: 1px solid #ddd;
            /* Optional: adds a border around the container */
        }

        .left-column {
            flex: 1;
            padding-right: 20px;
            border-right: 2px solid #ddd;
            /* Adds a vertical line to the right of the left column */
        }

        .left-column h3 {
            cursor: pointer;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            background-color: #f8f9fa;
            color: black;
            transition: background-color 0.3s, color 0.3s;
        }

        .left-column h3:hover {
            background-color: #e2e6ea;
        }

        .left-column h3.selected {
            background-color: #cce5ff;
            color: #004085;
        }

        .right-column {
            flex: 2;
            padding-left: 20px;
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

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            background-color: #f9f9f9;
        }

        .hidden {
            display: none;
        }

        /* get note */
        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .table th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        .table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .table tr:hover {
            background-color: #f1f1f1;
        }

        /* Nút Thêm ghi Chú */

        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: #fff;
            font-size: 16px;
            margin: 5px;
        }

        .btn-primary {
            background-color: #007bff;
        }

        .btn-success {
            background-color: #28a745;
        }

        .btn-secondary {
            background-color: #6c757d;
        }

        .hidden {
            display: none;
        }

        #add-note-form {
            margin: 20px 0;
        }

        #add-note-form .form-group {
            margin-bottom: 15px;
        }

        .hidden {
            display: none;
        }

        .section:not(.hidden) {
            display: block;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="left-column">
            <h3 onclick="showSection('info', this)">Thông Tin</h3>
            <h3 onclick="showSection('notes', this)">Ghi Chú</h3>
            <h3 onclick="showSection('contact', this)">Liên Hệ</h3>
            <h3 onclick="showSection('invoice', this)">Hóa Ðơn</h3>
            <h3 onclick="showSection('merge', this)">Hợp Ðồng</h3>
        </div>
        <div class="right-column">
            <div id="info" class="section hidden">
                <h2>Thông Tin Chi Tiết Khách Hàng</h2>
                <?php
                // Thông tin k?t n?i co s? d? li?u
                $servername = 'localhost';
                $username = 'root';
                $password = '';
                $dbname = 'db_crm';

                // T?o k?t n?i
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Ki?m tra k?t n?i
                if ($conn->connect_error) {
                    die("Kết nối thất bại: " . $conn->connect_error);
                }

                // L?y ID t? tham s? URL
                $id = intval($_GET['id']);

                // Truy v?n d? li?u t? b?ng khachhang
                $sql = "SELECT * FROM khachhang WHERE Id_khachhang = $id";
                $result = $conn->query($sql);

                // Ki?m tra và in ra d? li?u
                if ($result->num_rows > 0) {
                    // L?y d? li?u
                    $row = $result->fetch_assoc();
                    echo "<div class='form-group'>
                            <label class='form-label'>Tên Khách Hàng:</label>
                            <input type='text' class='form-control' value='" . $row["TenKhachHang"] . "' readonly>
                        </div>";
                    echo "<div class='form-group'>
                            <label class='form-label'>Liên Hệ Chính:</label>
                            <input type='text' class='form-control' value='" . $row["LienHeChinh"] . "' readonly>
                        </div>";
                    echo "<div class='form-group'>
                            <label class='form-label'>Trang Web:</label>
                            <input type='text' class='form-control' value='" . $row["TrangWeb"] . "' readonly>
                        </div>";
                    echo "<div class='form-group'>
                            <label class='form-label'>Mã Số Thuế:</label>
                            <input type='text' class='form-control' value='" . $row["MaSoThue"] . "' readonly>
                        </div>";
                    echo "<div class='form-group'>
                            <label class='form-label'>Ðịa Chỉ:</label>
                            <input type='text' class='form-control' value='" . $row["DiaChi"] . "' readonly>
                        </div>";
                    echo "<div class='form-group'>
                            <label class='form-label'>Phone:</label>
                            <input type='text' class='form-control' value='" . $row["Phone"] . "' readonly>
                        </div>";
                    echo "<div class='form-group'>
                            <label class='form-label'>Nhóm Khách Hàng:</label>
                            <input type='text' class='form-control' value='" . $row["NhomKhachHang"] . "' readonly>
                        </div>";
                    echo "<div class='form-group'>
                            <label class='form-label'>Khu Vực:</label>
                            <input type='text' class='form-control' value='" . $row["KhuVuc"] . "' readonly>
                        </div>";
                    echo "<div class='form-group'>
                            <label class='form-label'>Ðơn Vị Tiền:</label>
                            <input type='text' class='form-control' value='" . $row["DonViTien"] . "' readonly>
                        </div>";
                    echo "<div class='form-group'>
                            <label class='form-label'>Ngày Thành Lập:</label>
                            <input type='text' class='form-control' value='" . $row["NgayThanhLap"] . "' readonly>
                        </div>";
                    echo "<div class='form-group'>
                            <label class='form-label'>Email:</label>
                            <input type='text' class='form-control' value='" . $row["Email"] . "' readonly>
                        </div>";
                    echo "<div class='form-group'>
                            <label class='form-label'>Trạng Thái:</label>
                            <input type='text' class='form-control' value='" . $row["TrangThai"] . "' readonly>
                        </div>";
                    echo "<div class='form-group'>
                            <label class='form-label'>Người Phụ Trách:</label>
                            <input type='text' class='form-control' value='" . $row["NguoiPhuTrach"] . "' readonly>
                        </div>";
                    echo "<div class='form-group'>
                            <label class='form-label'>Ngày Tạo:</label>
                            <input type='text' class='form-control' value='" . $row["NgayTao"] . "' readonly>
                        </div>";
                } else {
                    echo "Không có dữ liệu cho khách hàng này.";
                }

                // Ðóng k?t n?i
                $conn->close();
                ?>
            </div>

            <!-- Placeholder sections for notes, contact, and invoice -->
            <div id="notes" class="section hidden">
                <h2>Ghi Chú</h2>
                <button onclick="showAddNoteForm()" class="btn btn-primary">Thêm Ghi Chú</button>
                <div id="add-note-form" class="hidden">
                    <h3>Thêm Ghi Chú Mới</h3>
                    <form id="note-form">
                        <div class="form-group">
                            <label for="moTa" class="form-label">Mô Tả:</label>
                            <textarea id="moTa" class="form-control" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Lưu Ghi Chú</button>
                        <button type="button" onclick="hideAddNoteForm()" class="btn btn-secondary">Hủy</button>
                    </form>
                </div>
                <table id="notes-table" class="table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mô Tả</th>
                            <th>Ngày Tạo</th>
                            <th>Tùy Chọn</th>
                        </tr>
                    </thead>
                    <tbody id="notes-list">
                        <!-- D? li?u ghi chú s? du?c chèn vào dây -->
                    </tbody>
                </table>
            </div>



            <div id="contact" class="section hidden">
                <h2>Liên Hệ</h2>
                <button onclick="showAddContactForm()" class="btn btn-primary">Thêm Ghi Chú</button>
                <div id="add-contact-form" class="hidden">
                    <h3>Thêm Liên Hệ Mới</h3>
                    <form id="contact-form">
                        <div class="form-group">
                            <label for="hoTen" class="form-label">Họ Tên:</label>
                            <input type="text" id="hoTen" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="phone" class="form-label">Phone:</label>
                            <input type="text" id="phone" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success">Luu</button>
                        <button type="button" class="btn btn-secondary" onclick="hideAddContactForm()">Hủy</button>
                    </form>
                </div>
                <table id="contacts-table" class="table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Họ Tên</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Ngày Tạo</th>
                            <th>Tùy Chọn</th>
                        </tr>
                    </thead>
                    <tbody id="contacts-list">
                        <!-- Contact data will be inserted here -->
                    </tbody>
                </table>
            </div>



            <div id="invoice" class="section">
                <h2>Hóa Đơn</h2>
                <!-- Button để hiển thị form thêm mới hóa đơn -->
                <button onclick="showAddInvoiceForm()" class="btn btn-primary mb-3">Thêm Mới Hóa Đơn</button>

                <!-- Form thêm mới hóa đơn -->
                <div id="add-invoice-form" style="display:none;">
                    <h3>Thêm Mới Hóa Đơn</h3>
                    <form action="add_invoice.php" method="post" onsubmit="return validateForm()">
                        <input type="hidden" name="Id_khachhang" id="Id_khachhang" value="<?php echo $id; ?>">

                        <div class="form-group">
                            <label for="NguoiLapHoaDon">Người Lập Hóa Đơn:</label>
                            <select name="NguoiLapHoaDon" id="NguoiLapHoaDon" class="form-control" required>
                                <?php
                                // Kết nối cơ sở dữ liệu và lấy danh sách nhân viên
                                $conn = new mysqli($servername, $username, $password, $dbname);
                                $sql_nv = "SELECT HovaTen FROM nhanvien";
                                $result_nv = $conn->query($sql_nv);

                                if ($result_nv->num_rows > 0) {
                                    while ($row_nv = $result_nv->fetch_assoc()) {
                                        echo "<option value='" . $row_nv['HovaTen'] . "'>" . $row_nv['HovaTen'] . "</option>";
                                    }
                                }
                                $conn->close();
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="NgayThanhToan">Ngày Thanh Toán:</label>
                            <input type="date" name="NgayThanhToan" id="NgayThanhToan" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="NgayHetHan">Ngày Hết Hạn:</label>
                            <input type="date" name="NgayHetHan" id="NgayHetHan" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="TinhTrang">Tình Trạng:</label>
                            <select name="TinhTrang" id="TinhTrang" class="form-control" required>
                                <option value="Chưa thanh toán">Chưa thanh toán</option>
                                <option value="Đã thanh toán">Đã thanh toán</option>
                                <option value="Thanh toán 50%">Thanh toán 50%</option>
                                <option value="Thanh toán 70%">Thanh toán 70%</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success">Lưu</button>
                        <button type="button" class="btn btn-secondary" onclick="hideAddInvoiceForm()">Hủy</button>
                    </form>
                </div>

                <?php
                // Kết nối cơ sở dữ liệu
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

                // Lấy Id_khachhang từ URL
                $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

                // Truy vấn hóa đơn từ bảng hoadon
                $sql_invoice = "SELECT Id_HoaDon, Id_khachhang, MaHoaDon, NguoiLapHoaDon, NgayThanhToan, NgayHetHan, TinhTrang 
        FROM hoadon 
        WHERE Id_khachhang = $id";
                $result_invoice = $conn->query($sql_invoice);

                // Kiểm tra và in ra dữ liệu hóa đơn
                if ($result_invoice->num_rows > 0) {
                    echo "<table class='table table-hover'>
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã Hóa Đơn</th>
                        <th>Người Lập Hóa Đơn</th>
                        <th>Ngày Thanh Toán</th>
                        <th>Ngày Hết Hạn</th>
                        <th>Tình Trạng</th>
                        <th>Tùy Chỉnh</th>
                    </tr>
                </thead>
                <tbody>";
                    $stt = 1;
                    while ($row_invoice = $result_invoice->fetch_assoc()) {
                        echo "<tr onclick=\"viewInvoiceDetails(" . $row_invoice['Id_HoaDon'] . ")\">
                    <td>" . $stt . "</td>
                    <td class='clickable' onclick=\"viewInvoiceDetails(" . $row_invoice['Id_HoaDon'] . ")\">" . $row_invoice["MaHoaDon"] . "</td>
                    <td>" . $row_invoice["NguoiLapHoaDon"] . "</td>
                    <td>" . $row_invoice["NgayThanhToan"] . "</td>
                    <td>" . $row_invoice["NgayHetHan"] . "</td>
                    <td>" . $row_invoice["TinhTrang"] . "</td>
                    <td>
                        <button onclick=\"editInvoice(" . $row_invoice['Id_HoaDon'] . ", event)\" class='btn btn-warning btn-sm'>Chỉnh sửa</button>
                        <button onclick=\"deleteInvoice(" . $row_invoice['Id_HoaDon'] . ", event)\" class='btn btn-danger btn-sm'>Xóa</button>
                    </td>
                </tr>";
                        $stt++;
                    }
                    echo "</tbody>
            </table>";
                } else {
                    echo "Không có hóa đơn nào.";
                }

                // Đóng kết nối
                $conn->close();
                ?>
            </div>


            <div id="merge" class="section hidden">
                <h2>Hợp Ðồng</h2>
                <!-- Button để hiển thị form thêm mới hóa đơn -->
                <button onclick="showAddMergeForm()" class="btn btn-primary mb-3">Thêm Mới Merge</button>

                <!-- Form thêm mới Merge -->
                <div id="add-merge-form" style="display:none;">
                    <form action="add_merge.php" method="post" onsubmit="return validateMergeForm()">
                        <input type="hidden" name="Id_khachhang" id="Id_khachhang" value="<?php echo $id; ?>">

                        <div class="form-group">
                            <label for="TenMerge">Tên Merge:</label>
                            <input type="text" name="TenMerge" id="TenMerge" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="LoaiMerge">Loại Merge:</label>
                            <select name="LoaiMerge" id="LoaiMerge" class="form-control" required>
                                <?php
                                // Kết nối cơ sở dữ liệu
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

                                // Truy vấn loại hợp đồng từ bảng ct_loaihopdong
                                $sql_loai = "SELECT TenLoaiHopDong FROM ct_loaihopdong";
                                $result_loai = $conn->query($sql_loai);

                                // Kiểm tra và in ra dữ liệu loại hợp đồng
                                if ($result_loai->num_rows > 0) {
                                    while ($row_loai = $result_loai->fetch_assoc()) {
                                        echo "<option value=\"" . htmlspecialchars($row_loai["TenLoaiHopDong"]) . "\">" . htmlspecialchars($row_loai["TenLoaiHopDong"]) . "</option>";
                                    }
                                } else {
                                    echo "<option value=\"\">Không có loại hợp đồng nào.</option>";
                                }

                                // Đóng kết nối
                                $conn->close();
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="GiaTriMerge">Giá Trị Merge:</label>
                            <input type="number" name="GiaTriMerge" id="GiaTriMerge" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="NgayBatDau">Ngày Bắt Đầu:</label>
                            <input type="date" name="NgayBatDau" id="NgayBatDau" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="NgayKetThuc">Ngày Kết Thúc:</label>
                            <input type="date" name="NgayKetThuc" id="NgayKetThuc" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="ChuKy">Chu Kỳ:</label>
                            <input type="text" name="ChuKy" id="ChuKy" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-success">Lưu</button>
                        <button type="button" class="btn btn-secondary" onclick="hideAddMergeForm()">Hủy</button>
                    </form>
                </div>


                <!-- Bảng hiển thị danh sách Merge -->
                <div id="merge-list">
                    <?php
                    // Kết nối cơ sở dữ liệu
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

                    // Lấy Id_khachhang từ URL
                    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

                    // Truy vấn Merge từ bảng hopdong
                    $sql_merge = "SELECT Id_HopDong, TenHopDong, LoaiHopDong, GiaTriHopDong, NgayBatDau, NgayKetThuc, ChuKy 
    FROM hopdong 
    WHERE Id_khachhang = $id";
                    $result_merge = $conn->query($sql_merge);

                    // Kiểm tra và in ra dữ liệu Merge
                    if ($result_merge->num_rows > 0) {
                        echo "<table class='table table-hover'>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên Merge</th>
                    <th>Loại Merge</th>
                    <th>Giá Trị</th>
                    <th>Ngày Bắt Đầu</th>
                    <th>Ngày Kết Thúc</th>
                    <th>Chu Kỳ</th>
                    <th>Tùy Chỉnh</th>
                </tr>
            </thead>
            <tbody>";
                        $stt = 1;
                        while ($row_merge = $result_merge->fetch_assoc()) {
                            echo "<tr onclick=\"viewMergeDetails(" . $row_merge['Id_HopDong'] . ")\">
                <td>" . $stt . "</td>
                <td class='clickable'>" . $row_merge["TenHopDong"] . "</td>
                <td>" . $row_merge["LoaiHopDong"] . "</td>
                <td>" . $row_merge["GiaTriHopDong"] . "</td>
                <td>" . $row_merge["NgayBatDau"] . "</td>
                <td>" . $row_merge["NgayKetThuc"] . "</td>
                <td>" . $row_merge["ChuKy"] . "</td>
                <td>
                    <button onclick=\"editMerge(" . $row_merge['Id_HopDong'] . ", event)\" class='btn btn-warning btn-sm'>Chỉnh sửa</button>
                    <button onclick=\"deleteMerge(" . $row_merge['Id_HopDong'] . ", event)\" class='btn btn-danger btn-sm'>Xóa</button>
                </td>
            </tr>";
                            $stt++;
                        }
                        echo "</tbody>
        </table>";
                    } else {
                        echo "Không có Merge nào.";
                    }

                    // Đóng kết nối
                    $conn->close();
                    ?>
                </div>


            </div>

        </div>


        <script>
            function showSection(sectionId, element) {
                // ?n t?t c? các ph?n
                document.querySelectorAll('.section').forEach(function(section) {
                    section.classList.add('hidden');
                });

                // ?n t?t c? các tiêu d? bên trái
                document.querySelectorAll('.left-column h3').forEach(function(header) {
                    header.classList.remove('selected');
                });

                // Hi?n th? ph?n du?c ch?n
                document.getElementById(sectionId).classList.remove('hidden');

                // Ðánh d?u tiêu d? dang du?c ch?n
                element.classList.add('selected');

                // T?i d? li?u ghi chú n?u ph?n 'notes' du?c ch?n
                if (sectionId === 'notes') {
                    const id = new URLSearchParams(window.location.search).get('id');
                    fetch('get_notes.php?id=' + id)
                        .then(response => response.json())
                        .then(data => {
                            const notesList = document.getElementById('notes-list');
                            notesList.innerHTML = '';

                            if (data.length === 0) {
                                notesList.innerHTML = '<tr><td colspan="4">Không có ghi chú nào.</td></tr>';
                            } else {
                                data.forEach((note, index) => {
                                    const noteRow = document.createElement('tr');
                                    noteRow.innerHTML = `
                            <td>${index + 1}</td>
                            <td>${note.MoTa}</td>
                            <td>${note.NgayTao}</td>
                            <td>
                                <button class="btn btn-warning" onclick="editNote(${note.Id_GhiChu}, '${note.MoTa}')">Chỉnh sửa</button>
                                <button class="btn btn-danger" onclick="deleteNote(${note.Id_GhiChu})">Xóa</button>
                            </td>
                        `;
                                    notesList.appendChild(noteRow);
                                });
                            }
                        })
                        .catch(error => {
                            console.error('L?i:', error);
                        });
                }
                // T?i d? li?u liên h? n?u ph?n 'contact' du?c ch?n
                if (sectionId === 'contact') {
                    showContacts();
                }
            }

            function showAddNoteForm() {
                document.getElementById('add-note-form').classList.remove('hidden');
            }

            function hideAddNoteForm() {
                document.getElementById('add-note-form').classList.add('hidden');
            }

            document.getElementById('note-form').addEventListener('submit', function(event) {
                event.preventDefault();
                const id = new URLSearchParams(window.location.search).get('id');
                const moTa = document.getElementById('moTa').value;

                fetch('add_note.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `id=${id}&moTa=${encodeURIComponent(moTa)}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Ghi chúđã được thêm.');
                            document.getElementById('moTa').value = '';
                            hideAddNoteForm();
                            showSection('notes', document.querySelector('.left-column h3.selected'));
                        } else {
                            alert('Ðã xảy ra lỗi.');
                        }
                    })
                    .catch(error => {
                        console.error('Lỗi:', error);
                    });
            });

            function editNote(noteId, currentMoTa) {
                const newMoTa = prompt('Nhập mô tả mới:', currentMoTa);
                if (newMoTa !== null && newMoTa !== currentMoTa) {
                    fetch('edit_note.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `noteId=${noteId}&moTa=${encodeURIComponent(newMoTa)}`
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert('Ghi chú dã được cập nhật.');
                                showSection('notes', document.querySelector('.left-column h3.selected'));
                            } else {
                                alert('Ðã xảy ra lỗi.');
                            }
                        })
                        .catch(error => {
                            console.error('Lỗi:', error);
                        });
                }
            }

            function deleteNote(noteId) {
                if (confirm('Bạn có chắc muốn xóa ghi chú này không?')) {
                    fetch('delete_note.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `noteId=${noteId}`
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert('Ghi chú dã được xóa.');
                                showSection('notes', document.querySelector('.left-column h3.selected'));
                            } else {
                                alert('Ðã xảy ra lỗi.');
                            }
                        })
                        .catch(error => {
                            console.error('Lỗi:', error);
                        });
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                // Hi?n th? m?c 'Thông Tin' khi trang du?c t?i
                var defaultSection = 'info';
                var defaultElement = document.querySelector('.left-column h3[onclick*="' + defaultSection + '"]');

                if (defaultElement) {
                    showSection(defaultSection, defaultElement);
                }
            });

            function showContacts() {
                const id = new URLSearchParams(window.location.search).get('id');
                fetch('get_contacts.php?id=' + id)
                    .then(response => response.json())
                    .then(data => {
                        const contactsList = document.getElementById('contacts-list');
                        contactsList.innerHTML = '';

                        if (data.length === 0) {
                            contactsList.innerHTML = '<tr><td colspan="6">Không có liên hệ nào.</td></tr>';
                        } else {
                            data.forEach((contact, index) => {
                                const contactRow = document.createElement('tr');
                                contactRow.innerHTML = `
                        <td>${index + 1}</td>
                        <td>${contact.HoTen}</td>
                        <td>${contact.Email}</td>
                        <td>${contact.Phone}</td>
                        <td>${contact.NgayTao}</td>
                        <td>
                            <button class="btn btn-warning" onclick="editContact(${contact.Id_LienHe}, '${contact.HoTen}', '${contact.Email}', '${contact.Phone}')">Chỉnh sửa</button>
                            <button class="btn btn-danger" onclick="deleteContact(${contact.Id_LienHe})">Xóa</button>
                        </td>
                    `;
                                contactsList.appendChild(contactRow);
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Lỗi:', error);
                    });
            }


            // Kh?i t?o hi?n th? ph?n m?c d?nh
            document.addEventListener('DOMContentLoaded', function() {
                const defaultSection = 'info'; // Ph?n m?c d?nh hi?n th? khi trang t?i
                showSection(defaultSection, document.querySelector(`.left-column h3[onclick*="${defaultSection}"]`));
            });


            function showAddContactForm() {
                document.getElementById('add-contact-form').classList.remove('hidden');
            }

            function hideAddContactForm() {
                document.getElementById('add-contact-form').classList.add('hidden');
            }

            document.getElementById('contact-form').addEventListener('submit', function(event) {
                event.preventDefault();
                const id = new URLSearchParams(window.location.search).get('id');
                const hoTen = document.getElementById('hoTen').value.trim();
                const email = document.getElementById('email').value.trim();
                const phone = document.getElementById('phone').value.trim();

                fetch('add_contact.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `id=${id}&hoTen=${encodeURIComponent(hoTen)}&email=${encodeURIComponent(email)}&phone=${encodeURIComponent(phone)}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Ghi chú đã được thêm.');
                            document.getElementById('hoTen').value = '';
                            document.getElementById('email').value = '';
                            document.getElementById('phone').value = '';
                            hideAddNoteForm();
                            showSection('contacts', document.querySelector('.left-column h3.selected'));
                        } else {
                            alert('Ðã xảy ra lỗi.');
                        }
                    })
                    .catch(error => {
                        console.error('Lỗi:', error);
                    });
            });

            function editContact(contactId, currentHoTen, currentEmail, currentPhone) {
                // Nhập thông tin mới cho các trường liên hệ
                const newHoTen = prompt('Nhập họ tên mới:', currentHoTen);
                const newEmail = prompt('Nhập email mới:', currentEmail);
                const newPhone = prompt('Nhập số điện thoại mới:', currentPhone);

                // Kiểm tra nếu có bất kỳ thay đổi nào
                if (newHoTen !== null && newEmail !== null && newPhone !== null) {
                    // Kiểm tra xem thông tin có thay đổi không
                    if (newHoTen !== currentHoTen || newEmail !== currentEmail || newPhone !== currentPhone) {
                        // Gửi yêu cầu cập nhật dữ liệu
                        fetch('edit_contact.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded',
                                },
                                body: `contactId=${contactId}&hoTen=${encodeURIComponent(newHoTen)}&email=${encodeURIComponent(newEmail)}&phone=${encodeURIComponent(newPhone)}`
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alert('Thông tin liên hệ đã được cập nhật.');
                                    showContacts(); // Làm mới danh sách liên hệ sau khi cập nhật
                                } else {
                                    alert('Đã xảy ra lỗi khi cập nhật thông tin.');
                                }
                            })
                            .catch(error => {
                                console.error('Lỗi:', error);
                            });
                    }
                }
            }

            function deleteContact(contactId) {
                if (confirm('Bạn có chắc muốn xóa liên hệ này không?')) {
                    fetch('delete_contact.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `contactId=${contactId}`
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert('Liên hệ đã được xóa.');
                                showContacts(); // Refresh the contact list
                            } else {
                                alert('Đã xảy ra lỗi: ' + data.error);
                            }
                        })
                        .catch(error => {
                            console.error('Lỗi:', error);
                        });
                }
            }

            // Hóa Đơn

            function showAddInvoiceForm() {
                document.getElementById("add-invoice-form").style.display = "block";
            }

            function hideAddInvoiceForm() {
                document.getElementById("add-invoice-form").style.display = "none";
            }

            function validateForm() {
                var ngayThanhToan = document.getElementById('NgayThanhToan').value;
                var ngayHetHan = document.getElementById('NgayHetHan').value;

                if (new Date(ngayHetHan) <= new Date(ngayThanhToan)) {
                    alert("Ngày Hết Hạn phải lớn hơn Ngày Thanh Toán.");
                    return false; // Ngăn việc gửi form
                }

                return true;
            }

            function editInvoice(idHoaDon, event) {
                // Ngăn không cho sự kiện click trên nút gây ra sự kiện click của hàng
                event.stopPropagation();
                // Mở form chỉnh sửa hóa đơn
                window.location.href = `edit_invoice.php?id=${idHoaDon}`;
            }

            function deleteInvoice(idHoaDon, event) {
                // Ngăn không cho sự kiện click trên nút gây ra sự kiện click của hàng
                event.stopPropagation();
                if (confirm("Bạn có chắc chắn muốn xóa hóa đơn này không?")) {
                    // Gửi yêu cầu xóa đến server
                    window.location.href = `delete_invoice.php?id=${idHoaDon}`;
                }
            }

            function viewInvoiceDetails(invoiceId) {
                window.location.href = 'Check_HoaDon.php?id=' + invoiceId;
            }


            // Hiển thị form thêm mới hợp đồng
            function showAddMergeForm() {
                document.getElementById("add-merge-form").style.display = "block";
            }

            // Ẩn form thêm mới hợp đồng
            function hideAddMergeForm() {
                document.getElementById("add-merge-form").style.display = "none";
            }

            // Xác thực form thêm mới hợp đồng
            function validateMergeForm() {
                var ngayBatDau = document.getElementById('NgayBatDau').value;
                var ngayKetThuc = document.getElementById('NgayKetThuc').value;

                if (new Date(ngayKetThuc) <= new Date(ngayBatDau)) {
                    alert("Ngày Kết Thúc phải lớn hơn Ngày Bắt Đầu.");
                    return false; // Ngăn việc gửi form
                }

                return true;
            }

            // Chỉnh sửa hợp đồng
            function editMerge(idMerge, event) {
                // Ngăn không cho sự kiện click trên nút gây ra sự kiện click của hàng
                event.stopPropagation();
                // Mở form chỉnh sửa hợp đồng
                window.location.href = `edit_merge.php?id=${idMerge}`;
            }

            // Xóa hợp đồng
            function deleteMerge(idMerge, event) {
                // Ngăn không cho sự kiện click trên nút gây ra sự kiện click của hàng
                event.stopPropagation();
                if (confirm("Bạn có chắc chắn muốn xóa hợp đồng này không?")) {
                    // Gửi yêu cầu xóa đến server
                    window.location.href = `delete_merge.php?id=${idMerge}`;
                }
            }

            // Xem chi tiết hợp đồng
            // function viewMergeDetails(mergeId) {
            //     window.location.href = 'Check_Merge.php?id=' + mergeId;
            // }
        </script>
</body>

</html>