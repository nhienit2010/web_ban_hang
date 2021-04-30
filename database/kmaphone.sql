DROP DATABASE IF EXISTS kmaphone;

create database kmaphone;
use kmaphone;

CREATE TABLE `kmaphone`.`users` (
    `user_id` BIGINT NOT NULL AUTO_INCREMENT,
    `username` NVARCHAR(250) NOT NULL,
    `password` NVARCHAR(250) NOT NULL,
    `full_name` NVARCHAR(250) NOT NULL,
    `address` NVARCHAR(250) NOT NULL,
    `phone` NVARCHAR(250) NOT NULL,
    PRIMARY KEY (`user_id`)
);

CREATE TABLE `kmaphone`.`products` (
    `product_id` BIGINT NOT NULL AUTO_INCREMENT,
    `product_name` NVARCHAR(250) NOT NULL,
    `product_price` BIGINT NOT NULL,
    `product_type` NVARCHAR(250) NOT NULL,
    `product_origin` NVARCHAR(250) NOT NULL,
    `product_description` NVARCHAR(250) NOT NULL,
    `product_image` NVARCHAR(250) NOT NULL,
    `product_view` BIGINT NOT NULL DEFAULT 0,
    PRIMARY KEY (`product_id`)
);

CREATE TABLE `kmaphone`.`carts` (
    `id` BIGINT NOT NULL AUTO_INCREMENT,
    `product_id` BIGINT NOT NULL,
    `product_color` NVARCHAR(250) NOT NULL,
    `cookie_user` NVARCHAR(250) NOT NULL,
    `product_amount` INT NOT NULL,
    PRIMARY KEY (`id`)
);


INSERT INTO users VALUES (1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'nhienit', 'Dong Thap', '0344437774');


INSERT INTO products VALUES (1, 'Nokia 5.4', 3890000, 'dtdd', 'Trung Quốc', 'RAM 4GB - Camera 16MP - Bộ nhớ trong 128GB', 'images/dtdd/1.png', 0);
INSERT INTO products VALUES (2, 'Nokia 3.4', 2990000, 'dtdd', 'Trung Quốc', 'RAM 4GB - Camera 13MP - Bộ nhớ trong 64GB', 'images/dtdd/2.png', 0);
INSERT INTO products VALUES (3, 'Nokia 2.4', 2390000, 'dtdd', 'Trung Quốc', 'RAM 2GB - Camera 13MP - Bộ nhớ trong 32GB', 'images/dtdd/3.png', 0);
INSERT INTO products VALUES (4, 'Nokia 6300 4G', 1290000, 'dtdd', 'Trung Quốc', 'RAM 512MB - Camera VGA (480 x 640 pixels) - Bộ nhớ trong 4GB', 'images/dtdd/4.png', 0);
INSERT INTO products VALUES (5, 'Nokia C2', 2390000, 'dtdd', 'Trung Quốc', 'RAM 2GB - Camera 13MP - Bộ nhớ trong 32GB', 'images/dtdd/5.png', 0);
INSERT INTO products VALUES (6, 'Huawei Nova 7i', 6290000, 'dtdd', 'Trung Quốc', 'RAM 8GB - Camera 48MP - Bộ nhớ trong 128GB', 'images/dtdd/6.jpg', 0);
INSERT INTO products VALUES (7, 'Huawei Y6p', 3090000, 'dtdd', 'Trung Quốc', 'RAM 4GB - Camera 13MP - Bộ nhớ trong 64GB', 'images/dtdd/7.jpg', 0);
INSERT INTO products VALUES (8, 'Huawei P40 4G', 8090000, 'dtdd', 'Trung Quốc', 'RAM 8GB - Camera 50MP - Bộ nhớ trong 128GB', 'images/dtdd/8.jpg', 0);
INSERT INTO products VALUES (9, 'Huawei Nova 7 SE 5G LOHAS Edition', 12090000, 'dtdd', 'Trung Quốc', 'RAM 8GB - Camera 16MP - Bộ nhớ trong 128GB', 'images/dtdd/9.jpg', 0);
INSERT INTO products VALUES (10, 'Huawei P20 Lite', 10000000, 'dtdd', 'Trung Quốc', 'RAM 16GB - Camera 16MP - Bộ nhớ trong 64GB', 'images/dtdd/10.jpg', 0);

INSERT INTO products VALUES (11, 'Laptop Dell XPS 13 9300 i7 1065G7 16GB/512GB/Office365/Win10 (0N90H1)', 57990000, 'laptop', 'Trung Quốc', 'RAM 16GB - Tốc độ CPU 1.30 GHz - Ổ cứng SSD 512GB M.2 screenIe - Kích thước màn hình 13.4 inch', 'images/laptop/1.jpg', 0);
INSERT INTO products VALUES (12, 'Laptop Dell Vostro 3500 i3 1115G4/8GB/256GB/Win10 (V5I3001W)', 12690000, 'laptop', 'Trung Quốc', 'RAM 8GB - Tốc độ CPU 3 GHz - Ổ cứng SSD 256GB NVMe screenIe - Kích thước màn hình 15.6 inch', 'images/laptop/2.jpg', 0);
INSERT INTO products VALUES (13, 'Laptop Dell Vostro 3400 i3 1115G4/8GB/256GB/Win10 (70235020)', 12490000, 'laptop', 'Trung Quốc', 'RAM 8GB - Tốc độ CPU 3 GHz - Ổ cứng SSD 256GB NVMe screenIe - Kích thước màn hình 14 inch', 'images/laptop/3.jpg', 0);
INSERT INTO products VALUES (14, 'Laptop Dell Vostro 5402 i5 1135G7/8GB/256GB/Win10 (V4I5003W)', 18890000, 'laptop', 'Trung Quốc', 'RAM 8GB - Tốc độ CPU 2.40 GHz - Ổ cứng SSD 256GB NVMe screenIe - Kích thước màn hình 14 inch', 'images/laptop/4.jpg', 0);
INSERT INTO products VALUES (15, 'Laptop Dell Vostro 3400 i5 1135G7/8GB/256GB/2GB MX330/Win10 (YX51W2)', 16990000, 'laptop', 'Trung Quốc', 'RAM 8GB - Tốc độ CPU 2.40 GHz - Ổ cứng SSD 256GB NVMe screenIe - Kích thước màn hình 14 inch', 'images/laptop/5.jpg', 0);
INSERT INTO products VALUES (16, 'Laptop Dell Vostro 3500 i5 1135G7/8GB/256GB/2GB MX330/Win10 (P90F006V3500B)', 17690000, 'laptop', 'Trung Quốc', 'RAM 8GB - Tốc độ CPU 2.40 GHz - Ổ cứng SSD 256GB NVMe screenIe - Kích thước màn hình 15.6 inch', 'images/laptop/6.jpg', 0);
INSERT INTO products VALUES (17, 'Laptop Dell Inspiron 3501 i5 1135G7/8GB/512GB/2GB MX330/Win10 (70234074)', 18890000, 'laptop', 'Trung Quốc', 'RAM 8GB - Tốc độ CPU 2.40 GHz - Ổ cứng SSD 512GB M.2 screenIe - Kích thước màn hình 15.6 inch', 'images/laptop/7.jpg', 0);
INSERT INTO products VALUES (18, 'Laptop Dell Vostro 3400 i5 1135G7/8GB/256GB/Win10 (70234073)', 16290000, 'laptop', 'Trung Quốc', 'RAM 8GB - Tốc độ CPU 2.40 GHz - Ổ cứng SSD 256GB NVMe screenIe - Kích thước màn hình 14 inch', 'images/laptop/8.jpg', 0);
INSERT INTO products VALUES (19, 'Laptop Dell Inspiron 5502 i5 1135G7/8GB/512GB/Win10 (1XGR11)', 20290000, 'laptop', 'Trung Quốc', 'RAM 8GB - Tốc độ CPU 2.40 GHz - Ổ cứng SSD 512 GB M.2 screenIe - Kích thước màn hình 15.6 inch', 'images/laptop/9.jpg', 0);
INSERT INTO products VALUES (20, 'Laptop Dell Inspiron 3505 R3 3250U/8GB/256GB/Win10 (Y1N1T1)', 11990000, 'laptop', 'Trung Quốc', 'RAM 8GB - Tốc độ CPU 2.60 GHz - Ổ cứng SSD 256GB NVMe screenIe - Kích thước màn hình 15.6 inch', 'images/laptop/10.jpg', 0);


INSERT INTO products VALUES (21, 'Máy tính bảng Samsung Galaxy Tab A7 (2020)', 7390000, 'tablet', 'Hàn Quốc', 'RAM 3GB - Bộ nhớ trong: 64GB - Camera sau: 8MP - Camera trước: 5MP', 'images/tablet/1.jpg', 0);
INSERT INTO products VALUES (22, 'Máy tính bảng Huawei MatePad T10s (Nền tảng Huawei Mobile Service)', 5190000, 'tablet', 'Trung Quốc', 'RAM 3GB - Bộ nhớ trong: 64GB - Camera sau: 5MP - Camera trước: 2MP', 'images/tablet/2.jpg', 0);
INSERT INTO products VALUES (23, 'Máy tính bảng Samsung Galaxy Tab S6 Lite', 9090000, 'tablet', 'Hàn Quốc', 'RAM 4GB - Bộ nhớ trong: 64GB - Camera sau: 8MP - Camera trước: 5MP', 'images/tablet/3.jpg', 0);
INSERT INTO products VALUES (24, 'Máy tính bảng Lenovo Tab M10 - FHD Plus', 5190000, 'tablet', 'Hàn Quốc', 'RAM 4GB - Bộ nhớ trong: 64GB - Camera sau: 8MP - Camera trước: 5MP', 'images/tablet/4.jpg', 0);
INSERT INTO products VALUES (25, 'Máy tính bảng iPad Air 4 Wifi 64GB (2020)', 7390000, 'tablet', 'Hàn Quốc', 'RAM 3GB - Bộ nhớ trong: 64GB - Camera sau: 8MP - Camera trước: 5MP', 'images/tablet/5.jpg', 0);
INSERT INTO products VALUES (26, 'Máy tính bảng Huawei MatePad (Nền tảng Huawei Mobile Service)', 6690000, 'tablet', 'Hàn Quốc', 'RAM 4GB - Bộ nhớ trong: 64GB - Camera sau: 8MP - Camera trước: 5MP', 'images/tablet/6.jpg', 0);
INSERT INTO products VALUES (27, 'Máy tính bảng Lenovo Tab M10 - Gen 2', 4290000, 'tablet', 'Hàn Quốc', 'RAM 3GB - Bộ nhớ trong: 32GB - Camera sau: 8MP - Camera trước: 5MP', 'images/tablet/7.jpg', 0);
INSERT INTO products VALUES (28, 'Máy tính bảng Samsung Galaxy Tab A8 8" T295 (2019)', 3690000, 'tablet', 'Hàn Quốc', 'RAM 2GB - Bộ nhớ trong: 32GB - Camera sau: 8MP - Camera trước: 5MP', 'images/tablet/8.jpg', 0);
INSERT INTO products VALUES (29, 'Máy tính bảng iPad Pro 12.9 inch Wifi Cellular 128GB (2020)', 30990000, 'tablet', 'Hàn Quốc', 'RAM 6GB - Bộ nhớ trong: 128GB - Camera sau: 12MP - Camera trước: 7MP', 'images/tablet/9.jpg', 0);
INSERT INTO products VALUES (30, 'Máy tính bảng iPad Pro 11 inch Wifi Cellular 128GB (2020)', 25490000, 'tablet', 'Hàn Quốc', 'RAM 6GB - Bộ nhớ trong: 128GB - Camera sau: 12MP - Camera trước: 7MP', 'images/tablet/10.jpg', 0);

INSERT INTO products VALUES (31, 'Màn hình máy tính Samsung LCD Gaming 24 inch Full HD (LC24RG50FQEXXV)', 4070000, 'screen', 'Hàn Quốc', 'Độ phân giải:	Full HD (1920 x 1080) - Công nghệ màn hình:	144 Hz, Freesync, Curved Screen 1800R, Flicker free Technology', 'images/screen/1.jpg', 0);
INSERT INTO products VALUES (32, 'Màn hình máy tính Viewsonic LCD Gaming VX2458-P-MHD 24 inch Full HD 144Hz 1ms', 4590000, 'screen', 'Hàn Quốc', 'Độ phân giải:	Full HD (1920 x 1080) - Công nghệ màn hình:	144 Hz, LED, AMD FreeSync Premium', 'images/screen/2.jpg', 0);
INSERT INTO products VALUES (33, 'Màn hình máy tính LCD ASUS TUF Gaming VG249Q1R 23.8 inch Full HD)', 4790000, 'screen', 'Hàn Quốc', 'Độ phân giải:	Full HD (1920 x 1080) - Công nghệ màn hình:	165 Hz, FreeSync Premium', 'images/screen/3.jpg', 0);
INSERT INTO products VALUES (34, 'Màn hình máy tính Viewsonic LCD Gaming XG2405 24 inch Full HD 144Hz 1ms', 5490000, 'screen', 'Hàn Quốc', 'Độ phân giải:	Full HD (1920 x 1080) - Công nghệ màn hình:	144 Hz, SuperClear® IPS, AMD FreeSync™ Premium', 'images/screen/3.jpg', 0);
INSERT INTO products VALUES (35, 'Màn hình máy tính ASUS LCD TUF Gaming 23.8 inch Full HD (VG249Q)', 5990000, 'screen', 'Hàn Quốc', 'Độ phân giải:	Full HD (1920 x 1080) - Công nghệ màn hình:	144 Hz, AMD Free Sync, Tấm nền IPS', 'images/screen/5.jpg', 0);
INSERT INTO products VALUES (36, 'Màn hình máy tính Samsung LCD Gaming 27 inch Full HD (LC27RG50FQEXXV)', 6590000, 'screen', 'Hàn Quốc', 'Độ phân giải:	Full HD (1920 x 1080) - Công nghệ màn hình:	240 Hz, LCD VA, Curved Screen 1500R, NVIDIA G-SYNC', 'images/screen/6.jpg', 0);
INSERT INTO products VALUES (37, 'Màn hình máy tính Lenovo LCD Legion Gaming G27c-10 27 inch Full HD 165Hz 1ms (66A3GACBVN)', 6990000, 'screen', 'Hàn Quốc', 'Độ phân giải:	Full HD (1920 x 1080) - Công nghệ màn hình:	165 Hz, Anti-Glare', 'images/screen/7.jpg', 0);
INSERT INTO products VALUES (38, 'Màn hình máy tính ASUS LCD TUF Gaming 27 inch Full HD (VG27VQ)', 7990000, 'screen', 'Hàn Quốc', 'Độ phân giải: Full HD (1920 x 1080) - Công nghệ màn hình:	165 Hz, AMD Free Sync, VA with LED backlight', 'images/screen/8.jpg', 0);
INSERT INTO products VALUES (39, 'Màn hình máy tính Asus ZenScreen GO 15.6 inch Full HD (MB16AHP)', 7990000, 'screen', 'Hàn Quốc', 'Độ phân giải: Full HD (1920 x 1080) - Công nghệ màn hình:	60 Hz, Tấm nền IPS', 'images/screen/9.jpg', 0);
INSERT INTO products VALUES (40, 'Màn hình máy tính Samsung LCD Gaming 27 inch WQHD (LC27G55TQWEXXV)', 8190000, 'screen', 'Hàn Quốc', 'Độ phân giải: 2K (2560 x 1440) - Công nghệ màn hình:	144 Hz, HDR10, Curved Screen 1000R, LCD VA, AMD Free Sync', 'images/screen/10.jpg', 0);

INSERT INTO products VALUES (41, 'Sim Viettel', 75000, 'sim', 'Viet Nam', 'Sim 4G', 'images/sim/1.jfif', 0);
INSERT INTO products VALUES (42, 'Sim Mobiphone', 85000, 'sim', 'Viet Nam', 'Sim 4G', 'images/sim/2.jfif', 0);
INSERT INTO products VALUES (43, 'Sim Vinaphone', 80000, 'sim', 'Viet Nam', 'Sim 4G', 'images/sim/3.jfif', 0);
INSERT INTO products VALUES (44, 'Sim Vietnammobile', 72000, 'sim', 'Viet Nam', 'Sim 4G', 'images/sim/4.jfif', 0);

INSERT INTO products VALUES (45, 'Tai nghe Bluetooth True Wireless Xiaomi Earbuds Basic 2 BHR4272GL', 790000, 'headphone', 'Trung Quốc', 'Tương thích: Android, Windows, iOS (iPhone) - Cổng sạc:	Micro USB - Hỗ trợ kết nối:	10m (Bluetooth 5.0)', 'images/headphone/1.jpg', 0);
INSERT INTO products VALUES (46, 'Tai nghe Bluetooth AirPods Pro Wireless Charge Apple MWP22', 6490000, 'headphone', 'Mỹ', 'Tương thích: Android, iOS (iPhone) - Cổng sạc:	Lightning, Sạc không dây - Hỗ trợ kết nối: 10m (Bluetooth 5.0)', 'images/headphone/2.jpg', 0);
INSERT INTO products VALUES (47, 'Tai nghe Bluetooth AirPods 2 Wireless charge Apple MRXJ2', 4990000, 'headphone', 'Mỹ', 'Tương thích: Android, iOS (iPhone) - Cổng sạc: Lightning, Sạc không dây - Hỗ trợ kết nối:	10m (Bluetooth 5.0)', 'images/headphone/3.jpg', 0);
INSERT INTO products VALUES (48, 'Tai nghe Bluetooth AirPods 2 Apple MV7N2', 3790000, 'headphone', 'Mỹ', 'Tương thích: Android, iOS (iPhone) - Cổng sạc: Lightning - Hỗ trợ kết nối: 10m (Bluetooth 5.0)', 'images/headphone/4.jpg', 0);
INSERT INTO products VALUES (49, 'Tai nghe Bluetooth Mozard K8', 360000, 'headphone', 'Trung Quốc', 'Tương thích: Android, Windows, iOS (iPhone) - Cổng sạc: Micro USB - Hỗ trợ kết nối: 10m (Bluetooth 4.2)', 'images/headphone/5.jpg', 0);
INSERT INTO products VALUES (50, 'Tai nghe chụp tai Gaming Rapoo VH520C Đen', 599000, 'headphone', 'Trung Quốc', 'Tương thích: Windows - Cổng sạc:	USB - Kết nối cùng lúc:	1 thiết bị', 'images/headphone/6.jpg', 0);
INSERT INTO products VALUES (51, 'Tai nghe EP Rapoo EP28 Đen', 179000, 'headphone', 'Trung Quốc', 'Tương thích: Android, iOS (iPhone) - Cổng sạc:	Micro USB - Kết nối cùng lúc: 1 thiết bị', 'images/headphone/7.jpg', 0);
INSERT INTO products VALUES (52, 'Tai nghe Bluetooth Mozard LE003 Đen', 360000, 'headphone', 'Trung Quốc', 'Tương thích: Android, Windows, iOS (iPhone) - Cổng sạc:	Micro USB - Hỗ trợ kết nối:	Bluetooth 4.1', 'images/headphone/8.jpg', 0);
INSERT INTO products VALUES (53, 'Tai nghe Bluetooth True Wireless JBL T115', 1490000, 'headphone', 'Trung Quốc', 'Tương thích: Android, Windows, iOS (iPhone) - Cổng sạc: Type-C - Hỗ trợ kết nối:	10m (Bluetooth 5.0)', 'images/headphone/9.jpg', 0);
INSERT INTO products VALUES (54, 'Tai nghe Bluetooth True Wireless Audio Technica ATH-CK3TW Đen', 2490000, 'headphone', 'Trung Quốc', 'Tương thích: Android, Windows, iOS (iPhone) - Cổng sạc:	Type-C - Hỗ trợ kết nối: 10m (Bluetooth 5.0)', 'images/headphone/10.jpg', 0);

INSERT INTO products VALUES (55, 'Máy In Laser Trắng Đen HP LaserJet Pro M12a (T0L45A)', 1790000, 'printer', 'Trung Quốc', 'Loại máy:	In laser trắng đen -  Tốc độ in: 18 trang/phút - Chất lượng in:	HP FastRes 1200 dpi, 600 x 600 dpi', 'images/printer/1.jpg', 0);
INSERT INTO products VALUES (56, 'Máy in phun màu HP Ink Tank 115 (2LB19A)', 1990000, 'printer', 'Trung Quốc', 'Loại máy: 	In phun màu -  Tốc độ in: 8 trang/phút (Đen trắng), 5 trang/phút (Màu - Chất lượng in:	HP FastRes 1200 dpi', 'images/printer/2.jpg', 0);
INSERT INTO products VALUES (57, 'Máy In Phun Màu Canon PIXMA G1010', 2390000, 'printer', 'Trung Quốc', 'Loại máy: 	In phun màu -  Tốc độ in: 8.8 ảnh/phút (Đen trắng), 5 ảnh/phút (Màu) - Chất lượng in: 1200 x 4800 dpi', 'images/printer/3.jpg', 0);
INSERT INTO products VALUES (58, 'Máy In Phun Màu HP Ink Tank 315 (Z4B04A)', 2590000, 'printer', 'Trung Quốc', 'Loại máy: In phun màu -  Tốc độ in: 8 trang/phút (Đen trắng), 5 trang/phút (Màu) - Chất lượng in: 1200 x 4800 dpi', 'images/printer/4.jpg', 0);
INSERT INTO products VALUES (59, 'Máy In laser Trắng Đen Brother HL L2321D', 2690000, 'printer', 'Trung Quốc', 'Loại máy: In laser trắng đen -  Tốc độ in: 30 trang/phút - Chất lượng in: 2400 x 600 dpi', 'images/printer/5.jpg', 0);