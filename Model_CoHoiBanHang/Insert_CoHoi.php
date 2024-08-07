<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Quản lý Khách Hàng</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            display: flex;
            width: 90%;
            max-width: 1200px;
            gap: 20px;
            padding: 20px;
            box-sizing: border-box;
        }

        .content {
            width: 100%;
            background-color: #fff;
            padding: 40px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            border-radius: 8px;
        }

        .header {
            background-color: #4F94CD;
            color: white;
            text-align: center;
            padding: 15px 0;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .form-container {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            margin-top: 0;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .form-group textarea {
            resize: vertical;
        }

        .form-group input[type="submit"] {
            background-color: #4F94CD;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .form-group input[type="submit"]:hover {
            background-color: #357ABD;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #4F94CD;
            outline: none;
            box-shadow: 0 0 8px rgba(79, 148, 205, 0.3);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="content">
            <div class="header">
                <h2>Thêm Thông Tin Cơ hội bán Hàng</h2>
            </div>

            <!-- Form Thêm Mới -->
            <div class="form-container">
                <form action="insert_customer.php" method="post">
                    <div class="form-group">
                        <label for="name">Tên:</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="company">Tên Công Ty:</label>
                        <input type="text" id="company" name="company" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="text" id="phone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="chucvu">Chức Vụ:</label>
                        <input type="text" id="chucvu" name="chucvu" required>
                    </div>
                    <div class="form-group">
                        <label for="diachi">Địa Chỉ:</label>
                        <textarea id="diachi" name="diachi" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="nguoiphutrach">Người Phụ Trách:</label>
                        <select id="nguoiphutrach" name="nguoiphutrach">
                            <!-- PHP để tạo các tùy chọn -->
                            <?php
                            // Kết nối cơ sở dữ liệu
                            $conn = new mysqli('localhost', 'root', '', 'db_crm');
                            if ($conn->connect_error) {
                                die("Kết nối thất bại: " . $conn->connect_error);
                            }

                            // Lấy dữ liệu từ bảng nhanvien
                            $sql = "SELECT Id_NhanVien, HovaTen FROM nhanvien";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['Id_NhanVien'] . "'>" . $row['HovaTen'] . "</option>";
                                }
                            } else {
                                echo "<option value=''>Không có nhân viên</option>";
                            }

                            // Đóng kết nối
                            $conn->close();
                            ?>
                        </select>

                    </div>

                    <div class="form-group">
                        <label for="tinhtrang">Tình Trạng:</label>
                        <select id="tinhtrang" name="tinhtrang">
                            <option value="Tiềm năng">Tiềm năng</option>
                            <option value="Đang xử lý">Đang xử lý</option>
                            <option value="Hoàn thành">Hoàn thành</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nguoncohoi">Nguồn Cơ Hội:</label>
                        <select id="nguoncohoi" name="nguoncohoi">
                            <option value="Quảng cáo">Quảng cáo</option>
                            <option value="Khách hàng giới thiệu">Khách hàng giới thiệu</option>
                            <option value="Trực tiếp">Trực tiếp</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ngaylienhe">Ngày Liên Hệ:</label>
                        <input type="date" id="ngaylienhe" name="ngaylienhe" required>
                    </div>
                    <div class="form-group">
                        <label for="website">Website:</label>
                        <input type="text" id="website" name="website" required>
                    </div>
                    <div class="form-group">
                        <label for="khuvuc">Khu Vực:</label>
                        <select id="khuvuc" name="khuvuc">
                            <option value="Hà Nội">Hà Nội</option>
                            <option value="TP. Hồ Chí Minh">TP. Hồ Chí Minh</option>
                            <option value="Đà Nẵng">Đà Nẵng</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="giadukien">Giá Dự Kiến:</label>
                        <input type="number" id="giadukien" name="giadukien" required>
                    </div>
                    <div class="form-group">
                        <label for="ngaychotdukien">Ngày Chốt Dự Kiến:</label>
                        <input type="date" id="ngaychotdukien" name="ngaychotdukien" required>
                    </div>
                    <div class="form-group">
                        <label for="mota">Mô Tả:</label>
                        <textarea id="mota" name="mota" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Thêm">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>