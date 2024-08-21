<?php
require 'db_conn.php'; // Đảm bảo đã có kết nối cơ sở dữ liệu

// Lấy ID sản phẩm từ URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID sản phẩm không hợp lệ.");
}

$id = intval($_GET['id']);

// Truy vấn để lấy thông tin sản phẩm hiện tại
$sql = "
    SELECT 
        s.Id_SanPham,
        s.TenSanPham,
        s.MoTa,
        s.Anh,
        s.Gia,
        s.ThuocNhom,
        s.DonVi,
        s.Kho,
        n.TenNhom AS TenNhom,
        d.TenDonVi AS TenDonVi
    FROM 
        sanpham s
    JOIN 
        nhomsanpham n ON s.ThuocNhom = n.Id_NhomSanPham
    JOIN 
        nhomdonvi d ON s.DonVi = d.Id_NhomDonVi
    WHERE 
        s.Id_SanPham = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Sản phẩm không tồn tại.");
}

$product = $result->fetch_assoc();

// Lấy danh sách nhóm và đơn vị để chọn
$sql_nhom = "SELECT Id_NhomSanPham, TenNhom FROM nhomsanpham";
$sql_donvi = "SELECT Id_NhomDonVi, TenDonVi FROM nhomdonvi";

$nhom_result = $conn->query($sql_nhom);
$donvi_result = $conn->query($sql_donvi);

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Chỉnh Sửa Sản Phẩm</title>
    <style>
        /* style.css */
        /* style.css */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .product-form {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 15px;
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group textarea,
        .form-group select {
            width: 100%;
            /* Chiếm toàn bộ chiều rộng của khung chứa */
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            /* Đảm bảo padding và border được tính vào tổng chiều rộng */
        }

        .form-group input[type="file"] {
            padding: 5px;
        }

        .current-image img {
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .submit-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
        }

        .submit-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Chỉnh Sửa Sản Phẩm</h1>
        <form action="edit_sanpham.php" method="post" enctype="multipart/form-data" class="product-form">
            <input type="hidden" name="Id_SanPham" value="<?php echo htmlspecialchars($product['Id_SanPham']); ?>">

            <div class="form-group">
                <label for="TenSanPham">Tên Sản Phẩm:</label>
                <input type="text" id="TenSanPham" name="TenSanPham" value="<?php echo htmlspecialchars($product['TenSanPham']); ?>" required>
            </div>

            <div class="form-group">
                <label for="MoTa">Mô Tả:</label>
                <textarea id="MoTa" name="MoTa" required><?php echo htmlspecialchars($product['MoTa']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="Anh">Ảnh Hiện Tại:</label>
                <div class="current-image">
                    <img src="<?php echo htmlspecialchars($product['Anh']); ?>" alt="<?php echo htmlspecialchars($product['TenSanPham']); ?>" width="150">
                </div>
                <label for="Anh">Chọn Ảnh Mới:</label>
                <input type="file" id="Anh" name="Anh">
            </div>

            <div class="form-group">
                <label for="Gia">Giá:</label>
                <input type="number" id="Gia" name="Gia" value="<?php echo htmlspecialchars($product['Gia']); ?>" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="ThuocNhom">Nhóm:</label>
                <select id="ThuocNhom" name="ThuocNhom" required>
                    <?php while ($row = $nhom_result->fetch_assoc()): ?>
                        <option value="<?php echo $row['Id_NhomSanPham']; ?>" <?php if ($row['Id_NhomSanPham'] == $product['ThuocNhom']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($row['TenNhom']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="DonVi">Đơn Vị:</label>
                <select id="DonVi" name="DonVi" required>
                    <?php while ($row = $donvi_result->fetch_assoc()): ?>
                        <option value="<?php echo $row['Id_NhomDonVi']; ?>" <?php if ($row['Id_NhomDonVi'] == $product['DonVi']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($row['TenDonVi']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="Kho">Kho:</label>
                <input type="text" id="Kho" name="Kho" value="<?php echo htmlspecialchars($product['Kho']); ?>" required>
            </div>

            <div class="form-group">
                <input type="submit" value="Cập Nhật Sản Phẩm" class="submit-btn">
            </div>
        </form>
    </div>
</body>

</html>