USE DB_CRM
GO


// Create table NhanVien
CREATE TABLE NhanVien (
    Id_NhanVien INT PRIMARY KEY IDENTITY(1,1),
    HovaTen VARCHAR(255) NOT NULL,
    Email VARCHAR(255),
    PhongBan VARCHAR(100),
    ThuocNhomKD VARCHAR(100),
    MucLuong DECIMAL(18, 2),
    NgaySinhNhat DATE,
    Phone VARCHAR(50),
    Facebook VARCHAR(255)
);
GO

// Insert tale NhanVien
INSERT INTO NhanVien (HovaTen, Email, PhongBan, ThuocNhomKD, MucLuong, NgaySinhNhat, Phone, Facebook)
VALUES 
('Nguyen Van A', 'nguyenvana@example.com', 'Kinh Doanh', 'Nhom A', 15000000, '1990-01-01', '0901123456', 'facebook.com/nguyenvana'),
('Tran Thi B', 'tranthib@example.com', 'Marketing', 'Nhom B', 14000000, '1992-02-02', '0901234567', 'facebook.com/tranthib'),
('Le Van C', 'levanc@example.com', 'Hanh Chinh', 'Nhom C', 13000000, '1988-03-03', '0901345678', 'facebook.com/levanc'),
('Pham Thi D', 'phamthid@example.com', 'Ke Toan', 'Nhom D', 16000000, '1991-04-04', '0901456789', 'facebook.com/phamthid'),
('Hoang Van E', 'hoangvane@example.com', 'Nhan Su', 'Nhom E', 15500000, '1993-05-05', '0901567890', 'facebook.com/hoangvane');


// Create table KhachHangCH
CREATE TABLE KhachHangCH (
    Id_KHCH INT PRIMARY KEY IDENTITY(1,1),
    Ten VARCHAR(255) NOT NULL,
    TenCongTy VARCHAR(255),
    Email VARCHAR(255),
    Phone VARCHAR(50),
    ChucVu VARCHAR(100),
    DiaChi TEXT,
    NguoiPhuTrach INT,
    TinhTrang VARCHAR(100),
    NguonCoHoi VARCHAR(100),
    NgayLienHe DATE,
    Website VARCHAR(255),
    KhuVuc VARCHAR(100),
    GiaDuKien DECIMAL(18, 2),
    NgayChotDuKien DATE,
    MoTa TEXT,
    FOREIGN KEY (NguoiPhuTrach) REFERENCES NhanVien(Id_NhanVien)
);
GO


// Insert table KhachHangCH
INSERT INTO KhachHangCH (Ten, TenCongTy, Email, Phone, ChucVu, DiaChi, NguoiPhuTrach, TinhTrang, NguonCoHoi, NgayLienHe, Website, KhuVuc, GiaDuKien, NgayChotDuKien, MoTa)
VALUES 
('Cong ty ABC', 'ABC Corporation', 'contact@abc.com', '0911234567', 'Giám đốc', '123 Đường ABC, Quận 1, TP.HCM', 1, 'Tiềm năng', 'Triển lãm', '2024-07-15', 'abc.com', 'Miền Nam', 20000000, '2024-08-01', 'Khách hàng có nhu cầu về sản phẩm X'),
('Cong ty DEF', 'DEF Company', 'info@def.com', '0912345678', 'Trưởng phòng', '456 Đường DEF, Quận 3, TP.HCM', 2, 'Đang quan tâm', 'Quảng cáo', '2024-07-16', 'def.com', 'Miền Bắc', 15000000, '2024-08-05', 'Khách hàng đang xem xét sản phẩm Y'),
('Cong ty GHI', 'GHI Enterprises', 'sales@ghi.com', '0913456789', 'Phó giám đốc', '789 Đường GHI, Quận 5, TP.HCM', 3, 'Chưa quan tâm', 'Tiếp thị qua email', '2024-07-17', 'ghi.com', 'Miền Trung', 10000000, '2024-08-10', 'Chưa có nhu cầu rõ ràng'),
('Cong ty JKL', 'JKL Ltd.', 'support@jkl.com', '0914567890', 'Chuyên viên', '101 Đường JKL, Quận 7, TP.HCM', 4, 'Tiềm năng', 'Giới thiệu', '2024-07-18', 'jkl.com', 'Miền Nam', 30000000, '2024-08-15', 'Khách hàng quan tâm đến sản phẩm Z'),
('Cong ty MNO', 'MNO Group', 'contact@mno.com', '0915678901', 'Nhân viên', '123 Đường MNO, Quận 9, TP.HCM', 5, 'Đang quan tâm', 'Quảng cáo', '2024-07-19', 'mno.com', 'Miền Bắc', 25000000, '2024-08-20', 'Đang xem xét hợp đồng');


// Create table LichCSKH
CREATE TABLE LichCSKH (
    ID_LichCSKH INT PRIMARY KEY IDENTITY(1,1),
    TieuDe VARCHAR(255) NOT NULL,
    TinhTrangCoHoi VARCHAR(100),
    NguonCoHoi VARCHAR(100),
    GuiDen INT,
    UngDung VARCHAR(255),
    TaoBoi INT,
    MoTa TEXT,
    FOREIGN KEY (GuiDen) REFERENCES KhachHangCH(Id_KHCH),
    FOREIGN KEY (TaoBoi) REFERENCES NhanVien(Id_NhanVien)
);
GO

// Insert table LichCSKH
INSERT INTO LichCSKH (TieuDe, TinhTrangCoHoi, NguonCoHoi, GuiDen, UngDung, TaoBoi, MoTa)
VALUES 
('Họp mặt với ABC Corporation', 'Tiềm năng', 'Triển lãm', 1, 'Email', 1, 'Thảo luận về sản phẩm mới'),
('Cuộc gọi với DEF Company', 'Đang quan tâm', 'Quảng cáo', 2, 'Điện thoại', 2, 'Giới thiệu sản phẩm Y'),
('Gửi email cho GHI Enterprises', 'Chưa quan tâm', 'Tiếp thị qua email', 3, 'Email', 3, 'Cung cấp thêm thông tin sản phẩm'),
('Cuộc họp với JKL Ltd.', 'Tiềm năng', 'Giới thiệu', 4, 'Trực tiếp', 4, 'Thảo luận chi tiết về sản phẩm Z'),
('Liên hệ với MNO Group', 'Đang quan tâm', 'Quảng cáo', 5, 'Email', 5, 'Xác nhận lại yêu cầu hợp đồng'),
('Họp với PQR Corporation', 'Quan tâm nhẹ', 'Hội thảo', 1, 'Trực tiếp', 1, 'Khách hàng mới tiềm năng'),
('Gọi cho STU Ltd.', 'Rất tiềm năng', 'Đối tác giới thiệu', 2, 'Điện thoại', 2, 'Bàn bạc hợp tác lâu dài');




// select all from
SELECT * FROM NhanVien;
SELECT * FROM KhachHangCH;
SELECT * FROM LichCSKH;


