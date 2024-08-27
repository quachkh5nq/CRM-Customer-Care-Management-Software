<?php
// Bao gồm file kết nối cơ sở dữ liệu
require 'db_conn.php';

// Lấy ID công việc từ URL
$Id_CongViec = isset($_GET['Id_CongViec']) ? $_GET['Id_CongViec'] : null;

// Truy vấn chi tiết công việc nếu có Id_CongViec
$details = null;
if ($Id_CongViec) {
    $sql = "SELECT Id_CongViec, TenCongViec, MoTaCongViec, NgayBatDau, NgayKetThuc 
            FROM congviec 
            WHERE Id_CongViec = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $Id_CongViec);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $details = $result->fetch_assoc();
    }

    $stmt->close();
}

// Xử lý việc thêm bình luận khi form được gửi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Kiểm tra xem có gửi bình luận không và bình luận có khác rỗng không
    if (isset($_POST['comment']) && trim($_POST['comment']) !== '') {
        $comment = $_POST['comment'];

        $sql = "INSERT INTO comments (Id_CongViec, Comment, created_at) VALUES (?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("is", $Id_CongViec, $comment);
            $stmt->execute();
            $stmt->close();

            // Chuyển hướng lại trang để làm trống nội dung textarea
            header("Location: CT_CongViec.php?Id_CongViec=" . urlencode($Id_CongViec));
            exit();
        } else {
            echo "Lỗi khi chuẩn bị câu lệnh bình luận: " . $conn->error;
        }
    }
}

// Truy vấn bình luận
$comments = [];
if ($Id_CongViec) {
    $sql = "SELECT Id, Comment, created_at FROM comments WHERE Id_CongViec = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $Id_CongViec);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $comments[] = $row;
    }
    $stmt->close();
}

// Đóng kết nối
$conn->close();

// Tính toán thời gian thực hiện và tình trạng công việc
$time_left = '';
$status_message = '';

if ($details) {
    $start_date = new DateTime($details['NgayBatDau']);
    $end_date = new DateTime($details['NgayKetThuc']);
    $now = new DateTime();

    // Tính toán thời gian thực hiện
    $interval = $end_date->diff($start_date);

    $days = $interval->days;
    $hours = $interval->h;
    $minutes = $interval->i;

    if ($end_date > $now) {
        if ($now < $start_date) {
            $status_message = "Chưa bắt đầu";
            $time_left = "Thời gian bắt đầu: " . $start_date->format('d-m-Y H:i:s');
        } else {
            $remaining_interval = $now->diff($end_date);
            $remaining_days = $remaining_interval->days;
            $remaining_hours = $remaining_interval->h;
            $remaining_minutes = $remaining_interval->i;

            $time_left = "$remaining_days ngày $remaining_hours giờ $remaining_minutes phút còn lại";
            $status_message = "Đang tiến hành";
        }
    } else {
        $status_message = "Đã kết thúc";
        $time_left = "Thời gian đã kết thúc";
    }
}

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Công Việc</title>
    <style>
        .container {
            display: flex;
            max-width: 1000px;
            margin: 0 auto;
            border: 1px solid #ccc;
            border-radius: 8px;
            overflow: hidden;
        }

        .sidebar {
            width: 30%;
            background-color: #f8f9fa;
            padding: 20px;
            border-right: 1px solid #ddd;
        }

        .sidebar h3 {
            cursor: pointer;
            padding: 10px 0;
            margin: 0;
            font-size: 18px;
            color: #333;
            border-bottom: 1px solid #ddd;
        }

        .sidebar h3.active {
            font-weight: bold;
            color: #007BFF;
        }

        .content {
            width: 70%;
            padding: 20px;
        }

        .content h2 {
            margin-top: 0;
            font-size: 24px;
        }

        .content p {
            margin-bottom: 15px;
            font-size: 16px;
            line-height: 1.5;
        }

        .section {
            display: none;
        }

        .section.active {
            display: block;
        }

        .comment-box {
            margin-top: 20px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        .comment-box textarea {
            width: calc(100% - 22px);
            height: 100px;
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .comment-box button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .comment-box button:hover {
            background-color: #0056b3;
        }

        .comments-list {
            margin-top: 20px;
            text-align: right;
        }

        .comments-container {
            max-height: 400px;
            overflow-y: auto;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .chat-message {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 10px;
        }

        .message-content {
            background-color: #f1f0f0;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 10px;
            max-width: 80%;
            text-align: left;
            position: relative;
        }

        .comment-timestamp {
            display: block;
            font-size: 12px;
            color: #888;
            text-align: right;
            margin-top: 5px;
        }

        .message-content p {
            margin: 0;
        }

        .chat-message:nth-child(odd) .message-content {
            background-color: #e1e1e1;
            align-self: flex-start;
        }

        .chat-message:nth-child(even) .message-content {
            background-color: #ffffff;
            align-self: flex-end;
            margin-left: auto;
        }
    </style>
    <script>
        function showSection(sectionId) {
            var sections = document.getElementsByClassName('section');
            for (var i = 0; i < sections.length; i++) {
                sections[i].classList.remove('active');
            }
            document.getElementById(sectionId).classList.add('active');

            var sidebarLinks = document.querySelectorAll('.sidebar h3');
            sidebarLinks.forEach(function(link) {
                link.classList.remove('active');
            });

            document.getElementById(sectionId + '-link').classList.add('active');
        }

        window.onload = function() {
            showSection('info'); // Hiển thị mặc định phần thông tin
        };
    </script>
</head>

<body>

    <div class="container">
        <div class="sidebar">
            <h3 id="info-link" onclick="showSection('info')">Thông tin</h3>
            <h3 id="interact-link" onclick="showSection('interact')">Tương Tác</h3>
            <h3 id="template-link" onclick="showSection('template')">Mẫu Kế Hoạch</h3>
        </div>

        <div class="content">
            <div id="info" class="section active">
                <h2>Thông tin công việc</h2>
                <?php if ($details) : ?>
                    <p><strong>Tên công việc:</strong> <?php echo htmlspecialchars($details['TenCongViec']); ?></p>
                    <p><strong>Mô tả:</strong> <?php echo nl2br(htmlspecialchars($details['MoTaCongViec'])); ?></p>
                    <p><strong>Ngày bắt đầu:</strong> <?php echo htmlspecialchars($details['NgayBatDau']); ?></p>
                    <p><strong>Ngày kết thúc:</strong> <?php echo htmlspecialchars($details['NgayKetThuc']); ?></p>
                    <p><strong>Tình trạng:</strong> <?php echo htmlspecialchars($status_message); ?></p>
                    <p><strong>Thời gian còn lại:</strong> <?php echo htmlspecialchars($time_left); ?></p>
                <?php else : ?>
                    <p>Không tìm thấy công việc.</p>
                <?php endif; ?>
            </div>

            <div id="interact" class="section">
                <h2>Tương Tác</h2>
                
                <div class="comments-list">
                    <?php if (count($comments) > 0) : ?>
                        <div class="comments-container">
                            <?php foreach ($comments as $comment) : ?>
                                <div class="chat-message">
                                    <div class="message-content">
                                        <p><?php echo htmlspecialchars($comment['Comment']); ?></p>
                                        <span class="comment-timestamp"><?php echo htmlspecialchars($comment['created_at']); ?></span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <p>Chưa có bình luận nào.</p>
                    <?php endif; ?>
                </div>

                <div class="comment-box">
                    <form action="" method="post">
                        <textarea name="comment" placeholder="Nhập bình luận..."></textarea>
                        <button type="submit">Gửi</button>
                    </form>
                </div>
            </div>

            <div id="template" class="section">
                <h2>Mẫu Kế Hoạch</h2>
                <p>Đang phát triển...</p>
            </div>
        </div>
    </div>
</body>

</html>
