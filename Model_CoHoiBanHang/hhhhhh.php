<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Chi Ti?t Khách Hàng</title>
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
            <h3 onclick="showSection('support', this)">Hỗ Trợ</h3>
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
                        <button type="button" onclick="hideAddNoteForm()" class="btn btn-secondary">H?y</button>
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
                <h2>Liên H?</h2>
                <table id="contacts-table" class="table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Họ Tên</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Ngày Tạo</th>
                        </tr>
                    </thead>
                    <tbody id="contacts-list">
                        <!-- Contact data will be inserted here -->
                    </tbody>
                </table>
            </div>

            <div id="invoice" class="section hidden">
                <h2>Hóa Ðon</h2>
                <p>Thông tin hóa don s? du?c hi?n th? ? dây.</p>
            </div>

            <div id="merge" class="section hidden">
                <h2>H?p Ð?ng</h2>
                <p>Thông tin h?p d?ng s? du?c hi?n th? ? dây.</p>
            </div>

            <div id="support" class="section hidden">
                <h2>H? Tr?</h2>
                <p>Thông tin h?p d?ng s? du?c hi?n th? ? dây.</p>
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
                        contactsList.innerHTML = '<tr><td colspan="5">Không có liên hệ nào.</td></tr>';
                    } else {
                        data.forEach((contact, index) => {
                            const contactRow = document.createElement('tr');
                            contactRow.innerHTML = `
                        <td>${index + 1}</td>
                        <td>${contact.HoTen}</td>
                        <td>${contact.Email}</td>
                        <td>${contact.Phone}</td>
                        <td>${contact.NgayTao}</td>
                    `;
                            contactsList.appendChild(contactRow);
                        });
                    }
                })
                .catch(error => {
                    console.error('L?i:', error);
                });
        }

        // Kh?i t?o hi?n th? ph?n m?c d?nh
        document.addEventListener('DOMContentLoaded', function() {
            const defaultSection = 'info'; // Ph?n m?c d?nh hi?n th? khi trang t?i
            showSection(defaultSection, document.querySelector(`.left-column h3[onclick*="${defaultSection}"]`));
        });
    </script>
</body>

</html>