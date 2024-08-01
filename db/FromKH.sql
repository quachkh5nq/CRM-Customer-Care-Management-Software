-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 01, 2024 lúc 10:27 AM
-- Phiên bản máy phục vụ: 10.4.11-MariaDB
-- Phiên bản PHP: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `db_crm`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhangch`
--

CREATE TABLE `khachhangch` (
  `Id_KHCH` int(10) NOT NULL,
  `Ten` varchar(255) NOT NULL,
  `TenCongTy` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone` varchar(10) NOT NULL,
  `ChucVu` varchar(255) NOT NULL,
  `DiaChi` text NOT NULL,
  `NguoiPhuTrach` varchar(255) DEFAULT NULL,
  `TinhTrang` varchar(255) NOT NULL,
  `NguonCoHoi` varchar(255) NOT NULL,
  `NgayLienHe` date NOT NULL,
  `Website` varchar(255) NOT NULL,
  `KhuVuc` varchar(255) NOT NULL,
  `GiaDuKien` decimal(10,0) NOT NULL,
  `NgayChotDuKien` date NOT NULL,
  `MoTa` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `khachhangch`
--

INSERT INTO `khachhangch` (`Id_KHCH`, `Ten`, `TenCongTy`, `Email`, `Phone`, `ChucVu`, `DiaChi`, `NguoiPhuTrach`, `TinhTrang`, `NguonCoHoi`, `NgayLienHe`, `Website`, `KhuVuc`, `GiaDuKien`, `NgayChotDuKien`, `MoTa`) VALUES
(1, 'Cong ty ABC', 'ABC Corporation', 'contact@abc.com', '0911234567', 'Giám đốc', '123 Đường ABC, Quận 1, TP.HCM', 'Quách Nhựt Khang', 'Tiềm năng', 'Triển lãm', '2024-07-15', 'abc.com', 'Miền Nam', '20000000', '2024-08-01', 'Khách hàng có nhu cầu về sản phẩm X'),
(2, 'Cong ty DEF', 'DEF Company', 'info@def.com', '0912345678', 'Trưởng phòng', '456 Đường DEF, Quận 3, TP.HCM', '', 'Đang quan tâm', 'Quảng cáo', '2024-07-16', 'def.com', 'Miền Bắc', '15000000', '2024-08-05', 'Khách hàng đang xem xét sản phẩm Y'),
(3, 'Cong ty GHI', 'GHI Enterprises', 'sales@ghi.com', '0913456789', 'Phó giám đốc', '789 Đường GHI, Quận 5, TP.HCM', '', 'Chưa quan tâm', 'Tiếp thị qua email', '2024-07-17', 'ghi.com', 'Miền Trung', '10000000', '2024-08-10', 'Chưa có nhu cầu rõ ràng'),
(4, 'Cong ty JKL', 'JKL Ltd.', 'support@jkl.com', '0914567890', 'Chuyên viên', '101 Đường JKL, Quận 7, TP.HCM', '', 'Tiềm năng', 'Giới thiệu', '2024-07-18', 'jkl.com', 'Miền Nam', '30000000', '2024-08-15', 'Khách hàng quan tâm đến sản phẩm Z'),
(5, 'Cong ty MNO', 'MNO Group', 'contact@mno.com', '0915678901', 'Nhân viên', '123 Đường MNO, Quận 9, TP.HCM', '', 'Đang quan tâm', 'Quảng cáo', '2024-07-19', 'mno.com', 'Miền Bắc', '25000000', '2024-08-20', 'Đang xem xét hợp đồng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lichcskh`
--

CREATE TABLE `lichcskh` (
  `ID_LichCSKH` int(10) NOT NULL,
  `TieuDe` varchar(255) NOT NULL,
  `TinhTrangCoHoi` varchar(255) NOT NULL,
  `NguonCoHoi` varchar(255) NOT NULL,
  `Ten` varchar(255) NOT NULL,
  `UngDung` varchar(255) NOT NULL,
  `HovaTen` varchar(255) NOT NULL,
  `MoTa` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `lichcskh`
--

INSERT INTO `lichcskh` (`ID_LichCSKH`, `TieuDe`, `TinhTrangCoHoi`, `NguonCoHoi`, `Ten`, `UngDung`, `HovaTen`, `MoTa`) VALUES
(1, 'Họp mặt với ABC Corporation', 'Tiềm năng', 'Triển lãm', 'Cong ty ABC', 'Email', 'Nguyen Van A', 'Thảo luận về sản phẩm mới'),
(2, 'Cuộc gọi với DEF Company', 'Đang quan tâm', 'Quảng cáo', 'Cong ty DEF', 'Điện thoại', 'Tran Thi B', 'Giới thiệu sản phẩm Y'),
(3, 'Gửi email cho GHI Enterprises', 'Chưa quan tâm', 'Tiếp thị qua email', 'Cong ty GHI', 'Email', 'Le Van C', 'Cung cấp thêm thông tin sản phẩm'),
(4, 'Cuộc họp với JKL Ltd.', 'Tiềm năng', 'Giới thiệu', 'Cong ty JKL', 'Trực tiếp', 'Pham Thi D', 'Thảo luận chi tiết về sản phẩm Z'),
(5, 'Liên hệ với MNO Group', 'Đang quan tâm', 'Quảng cáo', 'Cong ty MNO', 'Email', 'Hoang Van E', 'Xác nhận lại yêu cầu hợp đồng'),
(6, 'Họp với PQR Corporation', 'Quan tâm nhẹ', 'Hội thảo', 'Cong ty GHI', 'Trực tiếp', 'Pham Thi D', 'Khách hàng mới tiềm năng'),
(7, 'Gọi cho STU Ltd.', 'Rất tiềm năng', 'Đối tác giới thiệu', 'Cong ty ABC', 'Điện thoại', 'Hoang Van E', 'Bàn bạc hợp tác lâu dài');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `Id_NhanVien` int(10) NOT NULL,
  `HovaTen` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `PhongBan` varchar(255) NOT NULL,
  `ThuocNhomKD` varchar(255) NOT NULL,
  `MucLuong` decimal(50,0) NOT NULL,
  `NgaySinhNhat` date NOT NULL,
  `Phone` int(10) NOT NULL,
  `Facebook` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`Id_NhanVien`, `HovaTen`, `Email`, `PhongBan`, `ThuocNhomKD`, `MucLuong`, `NgaySinhNhat`, `Phone`, `Facebook`) VALUES
(6, 'Nguyen Van A', 'nguyenvana@example.com', 'Kinh Doanh', 'Nhom A', '15000000', '1990-01-01', 901123456, 'facebook.com/nguyenvana'),
(7, 'Tran Thi B', 'tranthib@example.com', 'Marketing', 'Nhom B', '14000000', '1992-02-02', 901234567, 'facebook.com/tranthib'),
(8, 'Le Van C', 'levanc@example.com', 'Hanh Chinh', 'Nhom C', '13000000', '1988-03-03', 901345678, 'facebook.com/levanc'),
(9, 'Pham Thi D', 'phamthid@example.com', 'Ke Toan', 'Nhom D', '16000000', '1991-04-04', 901456789, 'facebook.com/phamthid'),
(10, 'Hoang Van E', 'hoangvane@example.com', 'Nhan Su', 'Nhom E', '15500000', '1993-05-05', 901567890, 'facebook.com/hoangvane');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `khachhangch`
--
ALTER TABLE `khachhangch`
  ADD PRIMARY KEY (`Id_KHCH`);

--
-- Chỉ mục cho bảng `lichcskh`
--
ALTER TABLE `lichcskh`
  ADD PRIMARY KEY (`ID_LichCSKH`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`Id_NhanVien`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `khachhangch`
--
ALTER TABLE `khachhangch`
  MODIFY `Id_KHCH` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `lichcskh`
--
ALTER TABLE `lichcskh`
  MODIFY `ID_LichCSKH` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `Id_NhanVien` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
