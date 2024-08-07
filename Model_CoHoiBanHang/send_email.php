<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy thông tin từ form
    $email_from = $_POST['email_from'];
    $recipient_email = $_POST['recipient_email'];
    $email_subject = $_POST['email_subject'];
    $email_body = $_POST['email_body'];

    // Cấu hình email cá nhân và hệ thống
    $personal_email = 'your-personal-email@example.com'; // Địa chỉ email cá nhân
    $system_email = 'system-email@example.com'; // Địa chỉ email hệ thống
    $smtp_server = 'smtp.example.com'; // Máy chủ SMTP
    $smtp_username = 'smtp-username'; // Tài khoản SMTP
    $smtp_password = 'smtp-password'; // Mật khẩu SMTP

    // Xác định địa chỉ email gửi đi
    $from_email = ($email_from == 'personal') ? $personal_email : $system_email;

    // Cấu hình tiêu đề email
    $headers = "From: $from_email\r\n";
    $headers .= "Reply-To: $from_email\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Gửi email
    if (mail($recipient_email, $email_subject, $email_body, $headers)) {
        echo "Email đã được gửi thành công!";
    } else {
        echo "Có lỗi xảy ra khi gửi email.";
    }
}
?>
