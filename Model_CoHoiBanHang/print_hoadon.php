<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa Đơn Sản Phẩm</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f5f5f5;
        }

        .invoice-box {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            background: #fff;
        }

        .invoice-box h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        .invoice-box table th,
        .invoice-box table td {
            padding: 8px;
            vertical-align: top;
            border-bottom: 1px solid #ddd;
        }

        .invoice-box table th {
            background: #f7f7f7;
            font-weight: bold;
        }

        .invoice-box table td {
            text-align: right;
        }

        .invoice-box table td:first-child,
        .invoice-box table th:first-child {
            text-align: left;
        }

        .invoice-box .total {
            font-weight: bold;
            border-top: 2px solid #eee;
        }

        .invoice-box .invoice-info {
            margin-bottom: 20px;
        }

        .invoice-box .invoice-info div {
            margin-bottom: 5px;
        }

        .summary {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-top: 20px;
        }

        .summary .label {
            font-size: 18px;
            font-weight: bold;
            margin-right: 10px;
        }

        .summary .value {
            font-size: 18px;
            color: #333;
        }

        .summary .value select {
            padding: 5px;
            font-size: 16px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .summary .value span {
            padding: 5px;
            font-size: 18px;
            font-weight: bold;
            color: #2c3e50;
        }

        .actions {
            text-align: center;
            margin-top: 20px;
        }

        .actions button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            margin-right: 10px;
        }

        .actions button:hover {
            background-color: #45a049;
        }

        .search-bar {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
        }

        .search-bar input[type="text"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            max-width: 300px;
            margin-right: 10px;
        }

        .search-bar button {
            padding: 10px 20px;
            background-color: #2196F3;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .search-bar button:hover {
            background-color: #1e88e5;
        }

        .select-buttons {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .select-buttons button {
            padding: 10px 20px;
            background-color: #FFC107;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 10px;
        }

        .select-buttons button:hover {
            background-color: #ffb300;
        }

        @media print {

            .invoice-box table td,
            .invoice-box table th {
                font-size: 12px;
            }

            .summary,
            .search-bar,
            .select-buttons,
            .actions {
                display: none;
            }
        }

        .invoice-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .invoice-header img {
            max-width: 150px;
            /* Tăng kích thước tối đa của logo */
        }

        .invoice-header h1 {
            font-size: 24px;
            margin: 0;
            text-align: center;
            flex-grow: 1;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <div class="invoice-header">
            <img src="img/Logo/adotech.png" alt="Logo Adotech">
            <h1>Hóa Đơn Sản Phẩm</h1>
        </div>

        <div class="invoice-info">
            <div><strong>Cửa Hàng:</strong> Adotech</div>
            <div><strong>Địa chỉ:</strong> 194 Nguyễn Phúc Chu, Phường 15, Quận Tân Bình, Tp. Hồ Chí Minh</div>
            <div><strong>Điện thoại:</strong> Số điện thoại của cửa hàng</div>
            <div><strong>Ngày:</strong> <?php echo date("d/m/Y"); ?></div>
        </div>

        <div class="search-bar">
            <input type="text" id="searchProduct" placeholder="Tìm kiếm sản phẩm...">
            <button onclick="searchProduct();">Tìm Kiếm</button>
        </div>

        <div class="select-buttons">
            <button onclick="selectAll();">Chọn Tất Cả</button>
            <button onclick="deselectAll();">Bỏ Chọn Tất Cả</button>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Chọn</th>
                    <th>Sản Phẩm</th>
                    <th>Số Lượng</th>
                    <th>Đơn Giá</th>
                    <th>Thành Tiền</th>
                </tr>
            </thead>
            <tbody id="productTable">
                <!-- Dữ liệu sản phẩm sẽ được điền ở đây -->
                <?php
                require 'db_conn.php';
                $sql = "SELECT * FROM sanpham";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td><input type="checkbox" class="product-checkbox" onchange="calculateTotal();"></td>';
                        echo '<td>' . $row['TenSanPham'] . '</td>';
                        echo '<td><input type="number" class="quantity" value="1" min="1" data-price="' . $row['Gia'] . '" style="width: 50px;" onchange="calculateTotal();"></td>';
                        echo '<td>' . number_format($row['Gia'], 0, ',', '.') . ' </td>';
                        echo '<td class="total-price">' . number_format($row['Gia'], 0, ',', '.') . ' </td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="5">Không có sản phẩm nào.</td></tr>';
                }

                $conn->close();
                ?>
            </tbody>
        </table>

        <div class="summary">
            <div class="label">Chiết Khấu:</div>
            <div class="value">
                <select id="discount" onchange="calculateTotal();">
                    <option value="0">0%</option>
                    <option value="10">10%</option>
                </select>
            </div>
        </div>

        <div class="summary">
            <div class="label">Thuế:</div>
            <div class="value">
                <select id="tax" onchange="calculateTotal();">
                    <option value="0">0%</option>
                    <option value="8">8%</option>
                </select>
            </div>
        </div>

        <div class="summary">
            <div class="label">Tổng Cộng:</div>
            <div class="value">
                <span id="totalAmount">0 VND</span>
            </div>
        </div>

        <div class="actions">
            <button onclick="printInvoice();">In Hóa Đơn</button>
        </div>
    </div>

    <script>
        function calculateTotal() {
            let total = 0;
            let discount = parseFloat(document.getElementById('discount').value) / 100;
            let tax = parseFloat(document.getElementById('tax').value) / 100;

            document.querySelectorAll('.product-checkbox:checked').forEach(function(checkbox) {
                let row = checkbox.closest('tr');
                let quantity = parseInt(row.querySelector('.quantity').value);
                let price = parseFloat(row.querySelector('.quantity').getAttribute('data-price'));
                total += quantity * price;
            });

            let discountAmount = total * discount;
            let taxAmount = (total - discountAmount) * tax;
            let finalTotal = total - discountAmount + taxAmount;

            document.getElementById('totalAmount').innerText = finalTotal.toFixed(0).replace(/\d(?=(?:\d{3})+(?!\d))/g, '$&,') + ' VND';
        }

        function printInvoice() {
            let originalContent = document.body.innerHTML;
            let printContent = '<html><head><style>@media print { .invoice-box .actions, .invoice-box .search-bar, .invoice-box .select-buttons { display: none; } }</style></head><body>';
            printContent += '<div class="invoice-box">';
            printContent += '<div class="invoice-header">';
            printContent += '<img src="img/Logo/adotech.png" alt="Adotech Logo" style="max-width: 150px;">'; // Thêm hình ảnh logo ở đây
            printContent += '<h1>Hóa Đơn Sản Phẩm</h1>';
            printContent += '</div>';
            printContent += document.querySelector('.invoice-info').outerHTML;
            printContent += '<table><thead><tr><th>Sản Phẩm</th><th>Số Lượng</th><th>Đơn Giá</th><th>Thành Tiền</th></tr></thead><tbody>';

            document.querySelectorAll('.product-checkbox:checked').forEach(function(checkbox) {
                let row = checkbox.closest('tr');
                let productName = row.cells[1].innerText;
                let quantity = row.querySelector('.quantity').value;
                let price = row.querySelector('.quantity').getAttribute('data-price');
                let totalPrice = (quantity * price).toFixed(0).replace(/\d(?=(?:\d{3})+(?!\d))/g, '$&,');

                printContent += '<tr>';
                printContent += '<td>' + productName + '</td>';
                printContent += '<td>' + quantity + '</td>';
                printContent += '<td>' + parseFloat(price).toFixed(0).replace(/\d(?=(?:\d{3})+(?!\d))/g, '$&,') + '</td>';
                printContent += '<td>' + totalPrice + '</td>';
                printContent += '</tr>';
            });

            printContent += '</tbody></table>';
            printContent += '<div class="summary">';
            printContent += '<div class="label">Chiết Khấu:</div>';
            printContent += '<div class="value">' + document.getElementById('discount').value + '%</div>';
            printContent += '</div>';
            printContent += '<div class="summary">';
            printContent += '<div class="label">Thuế:</div>';
            printContent += '<div class="value">' + document.getElementById('tax').value + '%</div>';
            printContent += '</div>';
            printContent += '<div class="summary">';
            printContent += '<div class="label">Tổng Cộng:</div>';
            printContent += '<div class="value">' + document.getElementById('totalAmount').innerText + '</div>';
            printContent += '</div>';
            printContent += '</div></body></html>';

            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;
        }

        function selectAll() {
            document.querySelectorAll('.product-checkbox').forEach(function(checkbox) {
                checkbox.checked = true;
            });
            calculateTotal();
        }

        function deselectAll() {
            document.querySelectorAll('.product-checkbox').forEach(function(checkbox) {
                checkbox.checked = false;
            });
            calculateTotal();
        }

        function searchProduct() {
            let input = document.getElementById('searchProduct').value.toLowerCase();
            document.querySelectorAll('#productTable tr').forEach(function(row) {
                let productName = row.cells[1].innerText.toLowerCase();
                row.style.display = productName.includes(input) ? '' : 'none';
            });
        }
    </script>
</body>

</html>