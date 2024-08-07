<?php
// Lấy dữ liệu từ form
$phone_number = $_POST['phone_number'];
$message = $_POST['message'];

// Thay thế với thông tin Twilio của bạn
$account_sid = 'your_account_sid';
$auth_token = 'your_auth_token';
$twilio_number = 'your_twilio_phone_number';

// URL của API Twilio
$url = 'https://api.twilio.com/2010-04-01/Accounts/' . $account_sid . '/Messages.json';

// Dữ liệu để gửi SMS
$data = [
    'From' => $twilio_number,
    'To' => $phone_number,
    'Body' => $message
];

// Khởi tạo cURL
$ch = curl_init($url);

// Cấu hình cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_USERPWD, $account_sid . ':' . $auth_token);

// Thực hiện cURL
$response = curl_exec($ch);

// Kiểm tra lỗi
if (curl_errno($ch)) {
    echo 'Lỗi cURL: ' . curl_error($ch);
} else {
    // Xử lý phản hồi
    $response_data = json_decode($response, true);
    if (isset($response_data['sid'])) {
        echo 'Tin nhắn đã được gửi thành công!';
    } else {
        echo 'Có lỗi xảy ra khi gửi tin nhắn: ' . $response;
    }
}

// Đóng cURL
curl_close($ch);
?>
