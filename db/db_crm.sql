-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 27, 2024 lúc 04:36 AM
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
-- Cấu trúc bảng cho bảng `congviec`
--

CREATE TABLE `congviec` (
  `Id_CongViec` int(10) NOT NULL,
  `TenCongViec` varchar(255) NOT NULL,
  `MoTaCongViec` text NOT NULL,
  `NgayBatDau` date NOT NULL,
  `NgayKetThuc` date NOT NULL,
  `LienQuanDen` varchar(255) NOT NULL,
  `TinhTrang` varchar(255) NOT NULL,
  `NguoiThucHien` varchar(255) NOT NULL,
  `MucDo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `congviec`
--

INSERT INTO `congviec` (`Id_CongViec`, `TenCongViec`, `MoTaCongViec`, `NgayBatDau`, `NgayKetThuc`, `LienQuanDen`, `TinhTrang`, `NguoiThucHien`, `MucDo`) VALUES
(1, 'Thiết kế giao diện', 'Thiết kế giao diện người dùng cho website', '2024-08-01', '2024-08-07', 'Dự Án', 'Đã hoàn thành', 'Nguyễn Văn A', 'Cao'),
(2, 'Phát triển backend', 'Xây dựng hệ thống backend', '2024-08-05', '2024-08-15', 'Dự Án', 'Đang thực hiện', 'Trần Văn B', 'Cao'),
(3, 'Kiểm thử phần mềm', 'Kiểm thử chức năng và hiệu suất', '2024-08-10', '2024-08-20', 'Dự Án', 'Chưa bắt đầu', 'Lê Thị C', 'Bình thường'),
(4, 'Viết tài liệu hướng dẫn', 'Tạo tài liệu hướng dẫn sử dụng phần mềm', '2024-08-08', '2024-08-12', 'Hợp Đồng', 'Đã hoàn thành', 'Phạm Văn D', 'Thấp'),
(5, 'Phân tích yêu cầu', 'Phân tích yêu cầu người dùng và hệ thống', '2024-08-03', '2024-08-06', 'Dự Án', 'Đã hoàn thành', 'Hoàng Thị E', 'Cao'),
(6, 'Thực hiện khảo sát', 'Khảo sát nhu cầu và mong muốn của khách hàng', '2024-08-07', '2024-08-10', 'Hợp Đồng', 'Đang thực hiện', 'Ngô Văn F', 'Cấp bách'),
(7, 'Tối ưu hóa cơ sở dữ liệu', 'Tối ưu hóa các truy vấn và chỉ mục', '2024-08-09', '2024-08-13', 'Dự Án', 'Đang thực hiện', 'Vũ Thị G', 'Cao'),
(8, 'Triển khai dự án', 'Triển khai dự án lên môi trường sản xuất', '2024-08-11', '2024-08-17', 'Hợp Đồng', 'Chưa bắt đầu', 'Đặng Văn H', 'Cao'),
(9, 'Hỗ trợ khách hàng', 'Giải quyết vấn đề và câu hỏi từ khách hàng', '2024-08-12', '2024-08-14', 'Dự Án', 'Đang kiểm tra', 'Tran Thi B', 'Thấp'),
(10, 'Tạo báo cáo cuối kỳ ', 'Tạo báo cáo và thống kê số liệu dự án', '2024-08-15', '2024-08-20', 'Dự Án', 'Chưa Bắt Đầu', 'Quách Văn Nhủ, Khang', 'Cao');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ct_ghichu`
--

CREATE TABLE `ct_ghichu` (
  `Id_GhiChu` int(10) NOT NULL,
  `Id_KhachHang` int(10) NOT NULL,
  `MoTa` varchar(255) NOT NULL,
  `NgayTao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `ct_ghichu`
--

INSERT INTO `ct_ghichu` (`Id_GhiChu`, `Id_KhachHang`, `MoTa`, `NgayTao`) VALUES
(2, 2, 'aaaaa', '2024-08-13'),
(4, 1, 'Call khách hàng ở phương xa nhá các em1', '2024-08-13'),
(5, 2, 'Em ơi', '2024-08-20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ct_hoadon`
--

CREATE TABLE `ct_hoadon` (
  `Id_CTHoaDon` int(10) NOT NULL,
  `Id_HoaDon` int(10) NOT NULL,
  `Id_khachhang` int(10) NOT NULL,
  `TenSanPham` varchar(255) NOT NULL,
  `MoTa` varchar(255) NOT NULL,
  `SoLuong` int(10) NOT NULL,
  `Gia` double NOT NULL,
  `TienThue` double NOT NULL,
  `TongTien` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `ct_hoadon`
--

INSERT INTO `ct_hoadon` (`Id_CTHoaDon`, `Id_HoaDon`, `Id_khachhang`, `TenSanPham`, `MoTa`, `SoLuong`, `Gia`, `TienThue`, `TongTien`) VALUES
(23, 3, 2, 'Máy in HP LaserJet Pro', 'Máy in laser HP với khả năng in nhanh và tiết kiệm mực.', 4, 250000, 0.08, 1080000),
(27, 13, 1, 'Máy tính bảng Apple iPad Air', 'Máy tính bảng Apple với màn hình Retina 10.9 inch.', 2, 600000, 0.1, 1320000),
(29, 13, 1, '5', 'Loa Bluetooth di động với âm thanh mạnh mẽ và thời lượng pin dài.', 5, 180000, 0.1, 990000),
(30, 14, 1, '2', 'Điện thoại thông minh Samsung với camera chất lượng cao.', 60, 800000, 0.1, 52800000),
(31, 3, 2, '1', '1', 2, 12, 0.1, 26),
(32, 3, 2, 'Điện Thoại', 'Asssssssssssssssssss', 3, 12000000, 0.1, 39600000),
(33, 3, 2, 'CỬA ĐI 1 CÁNH MỞ QUAY (SP NHÔM DINOSTAR)', 'Độ dày: khuôn bao khung và cánh cửa dày 1.4mm Màu sắc: ghi, trắng Kính an toàn 6.38mm Phụ kiện Kinlong 3 bản lề 4D, khóa đa điểm Gioăng kép ống cao su 2 lớp EPDM Vít, ốc Inox Keo Apolo - A500', 6, 20000000, 0.08, 129600000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ct_lienhe`
--

CREATE TABLE `ct_lienhe` (
  `Id_LienHe` int(10) NOT NULL,
  `Id_KhachHang` int(10) NOT NULL,
  `HoTen` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone` varchar(10) NOT NULL,
  `NgayTao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `ct_lienhe`
--

INSERT INTO `ct_lienhe` (`Id_LienHe`, `Id_KhachHang`, `HoTen`, `Email`, `Phone`, `NgayTao`) VALUES
(3, 2, '22', '222@gmail.com', '1234567890', '2024-08-14'),
(4, 1, 'Thư', 'khang@gmail.com', '1234567890', '2024-08-14');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ct_lienquanden`
--

CREATE TABLE `ct_lienquanden` (
  `Id_LienQuanDen` int(10) NOT NULL,
  `TenLienQuanDen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `ct_lienquanden`
--

INSERT INTO `ct_lienquanden` (`Id_LienQuanDen`, `TenLienQuanDen`) VALUES
(1, 'Dự Án'),
(2, 'Hóa Đơn'),
(3, 'Khách Hàng'),
(4, 'Báo Giá'),
(5, 'Hợp Đồng'),
(6, 'Yêu Cầu hỗ Trợ'),
(7, 'Chi Phí'),
(8, 'Cơ Hội'),
(9, 'Đề Xuất');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ct_loaihopdong`
--

CREATE TABLE `ct_loaihopdong` (
  `Id_LoaiHopDong` int(10) NOT NULL,
  `TenLoaiHopDong` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `ct_loaihopdong`
--

INSERT INTO `ct_loaihopdong` (`Id_LoaiHopDong`, `TenLoaiHopDong`) VALUES
(1, 'Hợp đồng CRM'),
(2, 'Hợp đồng thiết kế Logo'),
(3, 'Hợp đồng thiết kế web'),
(4, 'Hợp đồng dịch vụ tên miền'),
(5, 'Hợp đồng thiết kế profile công ty'),
(6, 'Hợp đồng thiết kế bao bì sản phẩm'),
(7, 'Hợp đồng thiết kế bộ nhận diện thương hiệu');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadon`
--

CREATE TABLE `hoadon` (
  `Id_HoaDon` int(10) NOT NULL,
  `Id_khachhang` int(10) NOT NULL,
  `MaHoaDon` varchar(255) NOT NULL,
  `NguoiLapHoaDon` varchar(255) NOT NULL,
  `NgayThanhToan` date NOT NULL,
  `NgayHetHan` date NOT NULL,
  `TinhTrang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `hoadon`
--

INSERT INTO `hoadon` (`Id_HoaDon`, `Id_khachhang`, `MaHoaDon`, `NguoiLapHoaDon`, `NgayThanhToan`, `NgayHetHan`, `TinhTrang`) VALUES
(1, 1, 'HD001', 'Khang', '2024-08-01', '2024-08-15', 'Thanh toán 50%'),
(3, 2, 'HD003', 'Khang', '2024-08-03', '2024-08-17', 'Đã thanh toán'),
(13, 1, 'HD004', 'Tran Thi B', '2024-08-10', '2024-08-14', 'Chưa thanh toán'),
(14, 1, 'HD005', 'Le Van C', '2024-08-10', '2024-08-22', 'Thanh toán 70%');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hopdong`
--

CREATE TABLE `hopdong` (
  `Id_HopDong` int(10) NOT NULL,
  `Id_khachhang` int(10) NOT NULL,
  `TenHopDong` varchar(255) NOT NULL,
  `LoaiHopDong` varchar(255) NOT NULL,
  `GiaTriHopDong` double NOT NULL,
  `NgayBatDau` date NOT NULL,
  `NgayKetThuc` date NOT NULL,
  `ChuKy` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `hopdong`
--

INSERT INTO `hopdong` (`Id_HopDong`, `Id_khachhang`, `TenHopDong`, `LoaiHopDong`, `GiaTriHopDong`, `NgayBatDau`, `NgayKetThuc`, `ChuKy`) VALUES
(1, 2, 'Hợp đồng SlimEmail1222', 'Hợp đồng CRM', 48000000, '2024-08-01', '2024-10-17', 'Chưa ký');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `Id_khachhang` int(10) NOT NULL,
  `TenKhachHang` varchar(255) NOT NULL,
  `LienHeChinh` varchar(255) NOT NULL,
  `TrangWeb` varchar(255) NOT NULL,
  `MaSoThue` int(50) NOT NULL,
  `NhomKhachHang` varchar(255) NOT NULL,
  `DiaChi` text NOT NULL,
  `KhuVuc` varchar(255) NOT NULL,
  `Phone` varchar(10) NOT NULL,
  `DonViTien` varchar(50) NOT NULL,
  `NgayThanhLap` date NOT NULL,
  `Email` varchar(255) NOT NULL,
  `TrangThai` varchar(255) NOT NULL,
  `NguoiPhuTrach` varchar(255) NOT NULL,
  `NgayTao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`Id_khachhang`, `TenKhachHang`, `LienHeChinh`, `TrangWeb`, `MaSoThue`, `NhomKhachHang`, `DiaChi`, `KhuVuc`, `Phone`, `DonViTien`, `NgayThanhLap`, `Email`, `TrangThai`, `NguoiPhuTrach`, `NgayTao`) VALUES
(1, 'CÔNG TY TNHH NGĂN NẮP JOYDY', 'Ms Nga', 'joudy.com', 556789542, 'VIP', 'Số 10 ngõ 86 Đường Nguyễn Văn Cừ, Phường Hồng Hải, Thành phố Hạ Long, Tỉnh Quảng Ninh', 'Miền Bắc', '0987654572', 'VND', '0000-00-00', 'macnga@joydy.vn', 'Hoạt Động', 'Trần Văn Hiệp', '0000-00-00'),
(2, 'CÔNG TY CỔ PHẦN LẮP MÁY - THÍ NGHIỆM CƠ ĐIỆN', 'aaa', 'aaa', 1234, 'aaa', 'aaa', 'aaa', '1234567890', 'usd', '2024-08-02', 'aaa@gmail.com', 'aaa', 'aaa', '2024-08-27'),
(6, '1', 'Anh', 'anh.com', 1234545, 'VIP', 'a', 'Miền Nam', '1234567890', 'USD', '2024-08-08', 'anh@gmail.com', 'Hoạt động', 'Quách Văn Nhủ', '2024-08-30');

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
(1, 'Hoàng Thái Tú', 'ABC Corporation1', 'contact@abc.com', '0911234567', 'Giám đốc 1', '123 Đường ABC, Quận 1, TP.HCM', 'Quách Văn Nhủ', 'Hoàn thành', 'Quảng cáo', '2024-07-15', 'abc.com', 'Miền Nam', '20000000', '2024-08-01', 'Khách hàng có nhu cầu về sản phẩm X'),
(2, 'Trần Thái Hoàng', 'DEF Company', 'info@def.com', '0912345678', 'Trưởng phòng', '456 Đường DEF, Quận 3, TP.HCM', 'Quách Văn Nhủ', 'Tiềm năng', 'Quảng cáo', '2024-07-16', 'def.com', 'Miền Bắc', '15000000', '2024-08-05', 'Khách hàng đang xem xét sản phẩm Y'),
(3, 'Nguyễn Long Phi', 'GHI Enterprises', 'sales@ghi.com', '0913456789', 'Phó giám đốc', '789 Đường GHI, Quận 5, TP.HCM', 'Quách Văn Nhủ', 'Tiềm năng', 'Quảng cáo', '2024-07-17', 'ghi.com', 'Miền Trung', '10000000', '2024-08-10', 'Chưa có nhu cầu rõ ràng'),
(4, 'Hoàng Việt Long', 'JKL Ltd.', 'support@jkl.com', '0914567890', 'Chuyên viên', '101 Đường JKL, Quận 7, TP.HCM', 'Quách Văn Nhủ', 'Tiềm năng', 'Quảng cáo', '2024-07-18', 'jkl.com', 'Miền Nam', '30000000', '2024-08-15', 'Khách hàng quan tâm đến sản phẩm Z'),
(11, 'Quách Nhựt Khang 2', 'Công ty TNHH Thiên Khang Group', 'quachkhangnhut@gmail.com', '0823494680', 'CEO kiêm CTO', '16/12 Nguyễn Hữu Dật, P.Tây Thạnh, Q.Tân Phú', 'Quách Văn Nhủ', 'Tiềm năng', 'Quảng cáo', '2024-05-10', 'thienkhang.id.vn', 'Miền Nam', '23000000', '2024-05-21', 'Công TY TNHH');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lichcskh`
--

CREATE TABLE `lichcskh` (
  `ID_LichCSKH` int(10) NOT NULL,
  `TieuDe` varchar(255) NOT NULL,
  `TinhTrangCoHoi` varchar(255) NOT NULL,
  `NguonCoHoi` varchar(255) NOT NULL,
  `NgayDuKien` date NOT NULL,
  `GuiDen` varchar(255) NOT NULL,
  `HovaTen` varchar(255) NOT NULL,
  `TrangThai` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `lichcskh`
--

INSERT INTO `lichcskh` (`ID_LichCSKH`, `TieuDe`, `TinhTrangCoHoi`, `NguonCoHoi`, `NgayDuKien`, `GuiDen`, `HovaTen`, `TrangThai`) VALUES
(1, 'Phát triển kinh tế', 'Tiềm năng', 'Facebook', '0000-00-00', 'Hoàng Thái Tú', 'Khang', 'Chưa Gửi');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhacnhokhch`
--

CREATE TABLE `nhacnhokhch` (
  `Id_nhacnhokhch` int(10) NOT NULL,
  `Id_KHCH` int(10) NOT NULL,
  `NoiDung` text NOT NULL,
  `NgayNhac` date NOT NULL,
  `GuiDen` varchar(255) NOT NULL,
  `TrangThaiThongBao` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `nhacnhokhch`
--

INSERT INTO `nhacnhokhch` (`Id_nhacnhokhch`, `Id_KHCH`, `NoiDung`, `NgayNhac`, `GuiDen`, `TrangThaiThongBao`) VALUES
(1, 1, 'Call Khach Hàng', '2024-08-15', 'Khang Quách', 'Yes'),
(2, 1, 'Xóa Dữu liệu Bảng', '2024-08-15', 'Thư Đặng', 'No'),
(10, 2, 'Call khách hàng', '2024-08-09', 'â', 'â');

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
  `Phone` varchar(10) NOT NULL,
  `Facebook` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`Id_NhanVien`, `HovaTen`, `Email`, `PhongBan`, `ThuocNhomKD`, `MucLuong`, `NgaySinhNhat`, `Phone`, `Facebook`) VALUES
(1, 'Quách Văn Nhủ', 'nhuquach@gmai.com', 'Kinh Doanh', 'Ban', '23000000', '0000-00-00', '923456987', 'Quách Nhủ'),
(2, 'Khang', 'Khang@gmail.com', 'kinh te', 'Tai Chinh', '24000000', '0000-00-00', '987654321', 'khangQuach'),
(3, 'Nguyen Van A', 'nguyenvana@example.com', 'Kinh doanh', 'Nhóm A', '5000', '1985-03-10', '0901234567', 'facebook.com/nguyenvana'),
(4, 'Tran Thi B', 'tranthib@example.com', 'Kinh doanh', 'Nhóm B', '4500', '1990-07-22', '0902345678', 'facebook.com/tranthib'),
(5, 'Le Van C', 'levanc@example.com', 'Kỹ thuật', 'Nhóm C', '6000', '1988-11-15', '0903456789', 'facebook.com/levanc'),
(6, 'Pham Thi D', 'phamthid@example.com', 'Kỹ thuật', 'Nhóm A', '5500', '1987-02-20', '0904567890', 'facebook.com/phamthid'),
(7, 'Hoang Van E', 'hoangvane@example.com', 'Hành chính', 'Nhóm B', '4000', '1992-05-30', '0905678901', 'facebook.com/hoangvane'),
(8, 'Ngoc Thi F', 'ngocthf@example.com', 'Hành chính', 'Nhóm C', '4200', '1993-08-12', '0906789012', 'facebook.com/ngocthf'),
(9, 'Vu Van G', 'vuvang@example.com', 'Marketing', 'Nhóm A', '4700', '1986-12-01', '0907890123', 'facebook.com/vuvang'),
(10, 'Mai Thi H', 'maithih@example.com', 'Marketing', 'Nhóm B', '4600', '1991-06-18', '0908901234', 'facebook.com/maithih'),
(11, 'Dinh Van I', 'dinhvani@example.com', 'Tài chính', 'Nhóm C', '5200', '1984-10-25', '0909012345', 'facebook.com/dinhvani'),
(12, 'Kim Thi J', 'kimthij@example.com', 'Tài chính', 'Nhóm A', '5300', '1989-04-14', '0900123456', 'facebook.com/kimthij');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhomdonvi`
--

CREATE TABLE `nhomdonvi` (
  `Id_NhomDonVi` int(10) NOT NULL,
  `TenDonVi` varchar(255) NOT NULL,
  `MoTa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `nhomdonvi`
--

INSERT INTO `nhomdonvi` (`Id_NhomDonVi`, `TenDonVi`, `MoTa`) VALUES
(1, 'Chiếc', 'Đơn vị đo lường cho các sản phẩm có thể đếm được như laptop, điện thoại.'),
(2, 'Bộ', 'Đơn vị đo lường cho các sản phẩm được bán theo bộ, ví dụ như bộ bàn phím và chuột.'),
(3, 'Cái', 'Đơn vị đo lường cho các sản phẩm như màn hình, loa.'),
(4, 'Hộp', 'Đơn vị đo lường cho các sản phẩm được đóng gói trong hộp như phần mềm, ổ cứng.'),
(5, 'Thùng', 'Đơn vị đo lường cho các sản phẩm được đóng gói trong thùng lớn.'),
(6, 'Gói', 'Đơn vị đo lường cho các sản phẩm nhỏ, gọn hoặc đóng gói như phụ kiện.'),
(7, 'Mét', 'Đơn vị đo lường cho các sản phẩm theo chiều dài.'),
(8, 'Kilogram', 'Đơn vị đo lường cho các sản phẩm có khối lượng như giấy in.'),
(9, 'Lít', 'Đơn vị đo lường cho các sản phẩm chất lỏng.'),
(14, '3', '3');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhomsanpham`
--

CREATE TABLE `nhomsanpham` (
  `Id_NhomSanPham` int(10) NOT NULL,
  `TenNhom` varchar(255) NOT NULL,
  `MoTa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `nhomsanpham`
--

INSERT INTO `nhomsanpham` (`Id_NhomSanPham`, `TenNhom`, `MoTa`) VALUES
(1, 'Laptop', 'Các loại máy tính xách tay từ nhiều thương hiệu nổi tiếng.'),
(2, 'Smartphone', 'Các loại điện thoại thông minh với nhiều tính năng hiện đại.'),
(3, 'Tablet', 'Các loại máy tính bảng cho nhu cầu giải trí và làm việc.'),
(4, 'Tai nghe', 'Các loại tai nghe chất lượng cao từ các nhà sản xuất hàng đầu.'),
(5, 'Loa', 'Các loại loa di động và loa gia đình với âm thanh tuyệt hảo.'),
(6, 'Màn hình', 'Màn hình máy tính với độ phân giải cao cho trải nghiệm tốt nhất.'),
(7, 'Bàn phím', 'Các loại bàn phím cơ và bàn phím văn phòng.'),
(8, 'Chuột', 'Các loại chuột máy tính với thiết kế đa dạng và tiện ích.'),
(9, 'Ổ cứng', 'Ổ cứng lưu trữ dữ liệu với dung lượng và tốc độ cao.'),
(10, 'Máy in', 'Các loại máy in laser và máy in phun.'),
(11, 'Phụ kiện', 'Các loại phụ kiện hỗ trợ cho máy tính và thiết bị điện tử.');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `Id_SanPham` int(10) NOT NULL,
  `TenSanPham` varchar(255) NOT NULL,
  `MoTa` varchar(500) NOT NULL,
  `Anh` blob NOT NULL,
  `Gia` double NOT NULL,
  `ThuocNhom` varchar(255) NOT NULL,
  `DonVi` varchar(255) NOT NULL,
  `Kho` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`Id_SanPham`, `TenSanPham`, `MoTa`, `Anh`, `Gia`, `ThuocNhom`, `DonVi`, `Kho`) VALUES
(2, 'Điện Thoại', 'Asssssssssssssssssss2', 0x75706c6f6164732f62692d71757965742d636875702d68696e682d6465702d64756f692d6e756f632d362e6a7067, 2300000, '4', '3', 'Q4'),
(4, 'CỬA ĐI 1 CÁNH MỞ QUAY (SP NHÔM DINOSTAR)', 'Độ dày: khuôn bao khung và cánh cửa dày 1.4mm Màu sắc: ghi, trắng Kính an toàn 6.38mm Phụ kiện Kinlong 3 bản lề 4D, khóa đa điểm Gioăng kép ống cao su 2 lớp EPDM Vít, ốc Inox Keo Apolo - A500', 0x75706c6f6164732f696d616765732e6a7067, 20000000, '5', '1', 'Tân Phú'),
(5, 'Laptop gaming Lenovo LOQ 15ARP9 83JC007HVN', 'Với cấu hình mạnh mẽ, thiết kế tối ưu, laptop Lenovo LOQ 15ARP9 83JC0040VN không chỉ là lựa chọn hoàn hảo cho các game thủ mà còn là người bạn đồng hành đắc lực cho những nhà sáng tạo nội dung. GEARVN sẽ đánh giá chi tiết sản phẩm này trong phần dưới đây để anh em có cái nhìn tổng quan nhất về em máy này.Với cấu hình mạnh mẽ, thiết kế tối ưu, laptop Lenovo LOQ 15ARP9 83JC0040VN không chỉ là lựa chọn hoàn hảo cho các game thủ mà còn là người bạn đồng hành đắc lực cho những nhà sáng tạo nội dung. ', 0x75706c6f6164732f4c6567696f6e2e6a7067, 24000000, '1', '3', 'Tân Bình'),
(6, 'Laptop gaming MSI Thin 15 B13UC 1411VN', 'MSI Thin 15 B13UC 1411VN là một lựa chọn hấp dẫn cho mọi game thủ với mức giá cạnh tranh so với các dòng máy gaming khác. Máy sở hữu cấu hình mạnh mẽ của dòng chip Intel (thế hệ mới nhất) kết hợp 8GB RAM hoàn toàn đáp ứng các yêu cầu chơi game ở mức cài đặt cao, thiết kế đồ họa, lướt web, xem phim một cách mượt mà nhất.', 0x75706c6f6164732f417375732e6a7067, 32000000, '1', '1', 'Quận 1'),
(7, 'Laptop gaming ASUS ROG Zephyrus G16 GA605WI QR090WS', 'Một chiếc laptop với hiệu năng khủng, thiết kế cao cấp được ví như một cỗ máy chiến đấu hạng cao là một lựa chọn phù hợp cho những game thủ hoặc những bạn đam mê công nghệ, và đó là Laptop gaming ASUS ROG Zephyrus G16 GA605WI QR090WS. Được trang bị bộ vi xử lý hện đại, bộ lưu trữ lớn, màn hình 16 inch rộng rãi đã giúp bạn có thể dễ dàng xử lý các tác vụ văn phòng, chơi game thỏa thích.', 0x75706c6f6164732f6c656e6f766f2e6a7067, 70800000, '1', '1', 'Tân Phú');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `congviec`
--
ALTER TABLE `congviec`
  ADD PRIMARY KEY (`Id_CongViec`);

--
-- Chỉ mục cho bảng `ct_ghichu`
--
ALTER TABLE `ct_ghichu`
  ADD PRIMARY KEY (`Id_GhiChu`);

--
-- Chỉ mục cho bảng `ct_hoadon`
--
ALTER TABLE `ct_hoadon`
  ADD PRIMARY KEY (`Id_CTHoaDon`);

--
-- Chỉ mục cho bảng `ct_lienhe`
--
ALTER TABLE `ct_lienhe`
  ADD PRIMARY KEY (`Id_LienHe`);

--
-- Chỉ mục cho bảng `ct_lienquanden`
--
ALTER TABLE `ct_lienquanden`
  ADD PRIMARY KEY (`Id_LienQuanDen`);

--
-- Chỉ mục cho bảng `ct_loaihopdong`
--
ALTER TABLE `ct_loaihopdong`
  ADD PRIMARY KEY (`Id_LoaiHopDong`);

--
-- Chỉ mục cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`Id_HoaDon`);

--
-- Chỉ mục cho bảng `hopdong`
--
ALTER TABLE `hopdong`
  ADD PRIMARY KEY (`Id_HopDong`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`Id_khachhang`);

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
-- Chỉ mục cho bảng `nhacnhokhch`
--
ALTER TABLE `nhacnhokhch`
  ADD PRIMARY KEY (`Id_nhacnhokhch`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`Id_NhanVien`);

--
-- Chỉ mục cho bảng `nhomdonvi`
--
ALTER TABLE `nhomdonvi`
  ADD PRIMARY KEY (`Id_NhomDonVi`);

--
-- Chỉ mục cho bảng `nhomsanpham`
--
ALTER TABLE `nhomsanpham`
  ADD PRIMARY KEY (`Id_NhomSanPham`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`Id_SanPham`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `congviec`
--
ALTER TABLE `congviec`
  MODIFY `Id_CongViec` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `ct_ghichu`
--
ALTER TABLE `ct_ghichu`
  MODIFY `Id_GhiChu` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `ct_hoadon`
--
ALTER TABLE `ct_hoadon`
  MODIFY `Id_CTHoaDon` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT cho bảng `ct_lienhe`
--
ALTER TABLE `ct_lienhe`
  MODIFY `Id_LienHe` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `ct_lienquanden`
--
ALTER TABLE `ct_lienquanden`
  MODIFY `Id_LienQuanDen` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `ct_loaihopdong`
--
ALTER TABLE `ct_loaihopdong`
  MODIFY `Id_LoaiHopDong` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `Id_HoaDon` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `hopdong`
--
ALTER TABLE `hopdong`
  MODIFY `Id_HopDong` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `Id_khachhang` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `khachhangch`
--
ALTER TABLE `khachhangch`
  MODIFY `Id_KHCH` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT cho bảng `lichcskh`
--
ALTER TABLE `lichcskh`
  MODIFY `ID_LichCSKH` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `nhacnhokhch`
--
ALTER TABLE `nhacnhokhch`
  MODIFY `Id_nhacnhokhch` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `Id_NhanVien` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `nhomdonvi`
--
ALTER TABLE `nhomdonvi`
  MODIFY `Id_NhomDonVi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `nhomsanpham`
--
ALTER TABLE `nhomsanpham`
  MODIFY `Id_NhomSanPham` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `Id_SanPham` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
