<?php
require 'db_conn.php';

if (isset($_POST['selected_items']) && is_array($_POST['selected_items'])) {
    $ids = implode(',', $_POST['selected_items']);
    $sql_delete = "DELETE FROM ct_hoadon WHERE Id_CTHoaDon IN ($ids)";
    
    if ($conn->query($sql_delete) === TRUE) {
        echo "Xóa sản phẩm thành công.";
    } else {
        echo "Lỗi khi xóa sản phẩm: " . $conn->error;
    }
} else {
    echo "Không có sản phẩm nào được chọn.";
}

$conn->close();

// Chuyển hướng về trang chi tiết hóa đơn sau khi xóa
header("Location: Check_HoaDon.php?id=" . intval($_POST['Id_HoaDon']));
exit();
?>
