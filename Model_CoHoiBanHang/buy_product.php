<?php
// Bao gồm file kết nối cơ sở dữ liệu
require 'db_conn.php';

// Truy vấn danh sách sản phẩm
$sql = "SELECT Id_SanPham, TenSanPham FROM sanpham";
$result = $conn->query($sql);

$options = '';
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $options .= "<option value='" . $row['Id_SanPham'] . "'>" . htmlspecialchars($row['TenSanPham']) . "</option>";
    }
} else {
    $options = "<option value=''>Không có sản phẩm</option>";
}

// Lấy thông tin hóa đơn và khách hàng từ URL hoặc tham số
$idHoaDon = isset($_GET['Id_HoaDon']) ? intval($_GET['Id_HoaDon']) : 0;
$idKhachHang = isset($_GET['Id_KhachHang']) ? intval($_GET['Id_KhachHang']) : 0;

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mua Sản Phẩm</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 800px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Mua Sản Phẩm</h1>

        <!-- Form mua sản phẩm -->
        <form action="process_purchase.php" method="post">
            <input type="hidden" name="Id_HoaDon" value="<?php echo htmlspecialchars($idHoaDon); ?>">
            <input type="hidden" name="Id_KhachHang" value="<?php echo htmlspecialchars($idKhachHang); ?>">

            <div class="form-group">
                <label for="TenSanPham">Tên Sản Phẩm:</label>
                <select name="TenSanPham" id="TenSanPham" class="form-control" required onchange="updateProductInfo()">
                    <option value="">Chọn sản phẩm</option>
                    <?php echo $options; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="MoTa">Mô Tả:</label>
                <input type="text" name="MoTa" id="MoTa" class="form-control" readonly>
            </div>

            <div class="form-group">
                <label for="Gia">Giá:</label>
                <input type="number" name="Gia" id="Gia" class="form-control" readonly>
            </div>

            <div class="form-group">
                <label for="SoLuong">Số Lượng:</label>
                <input type="number" name="SoLuong" id="SoLuong" class="form-control" min="1" required>
            </div>

            <div class="form-group">
                <label for="TienThue">Tiền Thuế (%):</label>
                <select name="TienThue" id="TienThue" class="form-control" onchange="updateTotal()">
                    <option value="0.10">10%</option>
                    <option value="0.08">8%</option>
                    <option value="0">0%</option>
                </select>
            </div>

            <div class="form-group">
                <label for="TongTien">Tổng Tiền:</label>
                <input type="number" name="TongTien" id="TongTien" class="form-control" readonly>
            </div>

            <button type="submit" class="btn btn-primary">Mua Sản Phẩm</button>
        </form>
    </div>

    <script>
        function updateProductInfo() {
            var productId = document.getElementById('TenSanPham').value;
            if (productId) {
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'get_product_info.php?id=' + productId, true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.error) {
                            alert(response.error);
                            document.getElementById('MoTa').value = '';
                            document.getElementById('Gia').value = '';
                        } else {
                            document.getElementById('MoTa').value = response.MoTa;
                            document.getElementById('Gia').value = response.Gia;
                        }
                        updateTotal();
                    }
                };
                xhr.send();
            } else {
                document.getElementById('MoTa').value = '';
                document.getElementById('Gia').value = '';
                updateTotal();
            }
        }

        function updateTotal() {
            var quantity = parseFloat(document.getElementById('SoLuong').value) || 0;
            var price = parseFloat(document.getElementById('Gia').value) || 0;
            var taxRate = parseFloat(document.getElementById('TienThue').value) || 0;
            var total = (quantity * price) + (quantity * price * taxRate);
            document.getElementById('TongTien').value = total.toFixed(0);
        }

        document.getElementById('SoLuong').addEventListener('input', updateTotal);
        document.getElementById('TienThue').addEventListener('change', updateTotal);
    </script>
</body>

</html>
