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
                        echo "<td>" . $row["TenCongViec"] . "</td>";
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