-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 19, 2025 lúc 05:56 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `outfit`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `outfit_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `outfit_id`) VALUES
(37, 1, 29),
(41, 4, 37),
(43, 5, 21),
(46, 7, 21),
(50, 1, 43);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `outfits`
--

CREATE TABLE `outfits` (
  `id` int(11) NOT NULL,
  `country` varchar(50) NOT NULL,
  `continent` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `outfits`
--

INSERT INTO `outfits` (`id`, `country`, `continent`, `name`, `image`, `description`, `price`) VALUES
(17, 'Vietnam', 'Asia', 'Áo Len Cổ Đứng Khoá Kéo (Half-Zip High-Neck Sweater', 'images/viet1.jpg', 'Phong cách Casual Thu Đông. Áo len dệt kim dày dặn, cổ cao với khóa kéo nửa thân (half-zip), màu trắng kem/trắng ngà với sọc ngang đen ở ngực và tay áo. Áo được kết hợp với quần ống rộng (wide-leg trousers) màu be nhạt, tạo cảm giác thoải mái và phom dáng hài hòa (loose fit). Màu sắc trung tính, dễ mặc, mang lại vẻ ngoài ấm áp và thời thượng', 0.00),
(18, 'Vietnam', 'Asia', 'Jacket Bomber Đen Cơ Bản (Basic Black Bomber Jacket)', 'images/viet2.jpg', 'Phong cách Streetwear Tối Giản. Áo khoác Bomber màu đen, chất liệu len nỉ hoặc vải dày, dáng ngắn (cropped fit) tạo sự cân đối. Áo được mặc ngoài áo sơ mi trắng có họa tiết hoặc chữ in (patterned shirt). Kết hợp với quần tây ống rộng (wide-leg trousers) màu xám đậm và giày da bóng, tạo nên sự kết hợp hài hòa giữa sự lịch sự và cá tính', 0.00),
(19, 'Vietnam', 'Asia', ' Áo Sơ Mi Polo Dài Tay In Chữ (Printed Long-Sleeve Polo Shirt)', 'images/viet3.jpg', 'Phong cách Minimalist Casual/Clean Look. Áo sơ mi polo dài tay (hoặc sơ mi cổ cài khuy giấu cúc) màu trắng kem, có chi tiết chữ in hoặc logo nhỏ ở ngực, tạo điểm nhấn nhẹ nhàng. Áo được sơ vin gọn gàng với quần tây ống siêu rộng (extremely wide-leg trousers), cạp cao màu than chì. Outfit này tập trung vào phom dáng (silhouette) với tỷ lệ trên ôm dưới rộng ấn tượng', 0.00),
(20, 'KOREA', 'Asia', 'Cardigan Cổ Điển Layering (Classic Layered Cardigan)', 'images/han1.jpg', 'Phong cách Preppy/Academic (Học đường) hiện đại. Áo Cardigan cổ chữ V, màu đỏ đô (burgundy), được mặc ngoài áo sơ mi trắng có cài cúc và cà vạt đen mỏng. Đây là kiểu phối đồ nhiều lớp (layering) rất đặc trưng. Áo được kết hợp với quần jeans ống rộng (wide-leg jeans) hoặc quần tây màu đen/xanh đen đậm, tạo sự tương phản giữa sự gọn gàng của phần thân trên và sự thoải mái của phần thân dưới', 0.00),
(21, 'KOREA', 'Asia', 'Cardigan Dáng Lửng Cổ Sơ Mi (Cropped Button-up Cardigan)', 'images/han2.jpg', 'Mô tả Outfit: Phong cách Casual Thu Đông Thanh Lịch. Áo Cardigan màu đen, có độ dài ngắn hơn bình thường (cropped fit), tạo tỷ lệ cơ thể đẹp hơn. Áo được cài nút và mặc ngoài áo sơ mi cổ bẻ màu trắng (hoặc áo thun/polo cổ bẻ). Outfit được cân bằng bởi quần jeans ống rộng (baggy/wide-leg jeans) màu xanh trung tính, tạo vẻ ngoài trẻ trung, hiện đại và rất thoải mái', 0.00),
(22, 'KOREA', 'Asia', 'Jacket Duffle Ngắn (Short Wool Duffle Jacket)', 'images/han3.jpg', ' Phong cách Winter Chic/Cổ Điển. Áo khoác ngoài chất liệu len/dạ dày dặn, màu xám, có phom dáng ngắn (cropped/waist-length) và đặc trưng bởi khuy cài dạng dây thừng và nút gỗ/sừng (toggle closures) của áo Duffle. Áo được kết hợp với quần tây ống rộng (wide-leg trousers) màu trắng kem, tạo sự tương phản màu sắc ấn tượng cho mùa đông. Khăn choàng kẻ sọc (plaid scarf) là phụ kiện hoàn hảo tăng thêm vẻ ấm áp và thời trang', 0.00),
(23, 'China', 'Asia', 'Jacket Hoodie Kéo Khóa Viền Sọc (Zip-up Hoodie with Piped Detail)', 'images/trung1.jpg', 'Phong cách Streetwear năng động. Áo khoác hoodie khóa kéo (zip-up), màu đen, dáng rộng rãi nhưng có độ dài ngắn hơn (cropped fit) so với hoodie thông thường. Điểm nhấn là các đường viền sọc trắng (piping) chạy dọc tay áo và vai, tạo cảm giác thể thao. Áo được kết hợp với quần jeans ống siêu rộng (wide-leg jeans) màu đen hoặc nâu đậm có độ wash loang, cùng với giày bốt đế thô (chunky boots)', 0.00),
(24, 'China', 'Asia', 'Jacket Dù/Kaki Kéo Khóa Màu Nâu (Khaki/Brown Zip-up Jacket)', 'images/trung2.jpg', 'Phong cách Minimalist Streetwear/Tone Đất. Áo khoác Jacket có mũ (hooded jacket) khóa kéo, chất liệu dù hoặc kaki mỏng, màu nâu đất (khaki/tan). Áo được mặc ngoài áo thun cơ bản màu nâu đậm (matcha/cocoa), tạo hiệu ứng đơn sắc (monochrome) tinh tế. Kết hợp với quần ống rộng màu rêu/nâu xám (muddy olive wide-leg pants), tạo ra một outfit ấm áp, hài hòa với các tông màu tự nhiên', 0.00),
(25, 'China', 'Asia', 'Áo Phông Graphic Form Siêu Rộng (Oversized Graphic Tee)', 'images/trung3.jpg', 'Phong cách Heavy Streetwear/Utilitarian. Áo phông cổ tròn màu đen, có in chữ hoặc họa tiết lớn (graphic print) ngược, dáng siêu rộng (oversized). Áo được kết hợp với quần ống rộng chất liệu dày dặn (có thể là quần cargo) màu nâu xám (taupe/muddy grey) có chi tiết may nổi. Outfit hoàn thiện bằng mũ lưỡi trai và túi đeo vai lớn, tạo cảm giác thoải mái và cá tính', 0.00),
(26, 'UK', 'Europe', 'Hoodie Khóa Kéo Oversize (Oversized Zip-up Hoodie)', 'images/Anh1.jpg', 'Phong cách Streetwear/Casual. Áo hoodie khóa kéo (zip-up) dáng rộng (oversize) màu kem/trắng ngà với logo hoặc chữ in đậm trước ngực. Mẫu áo này thường được kết hợp với quần jeans rách hoặc wash sáng màu, tạo cảm giác thoải mái, năng động và trẻ trung', 0.00),
(27, 'UK', 'Europe', 'Jacket Da Lộn Cổ Lông Cừu (Shearling Suede Jacket)', 'images/Anh2.jpg', ' Phong cách Smart Casual Thu-Đông. Áo khoác ngoài là điểm nhấn chính, kết hợp giữa chất liệu da lộn màu nâu sô-cô-la và cổ lông cừu dày dặn màu trắng kem. Kết hợp với áo phông trắng cơ bản và quần ống đứng/quần nhung màu nâu sẫm, tạo nên vẻ ngoài lịch lãm, nam tính và giữ ấm tốt', 0.00),
(28, 'UK', 'Europe', 'Áo Sơ Mi Tay Ngắn Khóa Kéo (Short-Sleeve Zip-up Shirt)', 'images/Anh3.jpg', 'Phong cách Sporty Casual/Summer Casual. Áo sơ mi tay ngắn có khóa kéo thay vì cúc, thường có chất liệu đứng phom như cotton hoặc linen/pha polyester. Đây là lựa chọn lý tưởng cho mùa hè, kết hợp dễ dàng với quần shorts denim hoặc chinos, mang lại vẻ ngoài gọn gàng nhưng vẫn rất mát mẻ, thường được mặc thả ngoài (layering)', 0.00),
(29, 'France ', 'Europe', 'Jacket Kéo Khóa Thể Thao Màu Đơn Sắc (Monochromatic Zip-up Sport Jacket)', 'images/phap1.jpg', 'Phong cách Minimalist Sportswear/All-Black. Áo khoác ngoài màu đen, chất liệu dày dặn như fleece (nỉ lông cừu) hoặc dạ mỏng, có khóa kéo (zip-up) và cổ đứng. Áo được mặc kèm với các item khác cũng màu đen, tạo nên phong cách đơn sắc (monochromatic) mạnh mẽ. Điểm nhấn là quần ống loe hoặc ống rộng (flare/wide-leg trousers) chất liệu kỹ thuật (techwear) có chi tiết dây rút ở gấu quần', 0.00),
(30, 'France ', 'Europe', 'Áo Sơ Mi Tay Ngắn Layer Áo Cổ Lọ (Short-Sleeve Shirt over Turtleneck)', 'images/phap2.jpg', 'Phong cách Casual Thu Đông Nổi Bật. Áo sơ mi tay ngắn, dáng rộng (boxy fit) màu xanh dương nhạt (baby blue) nổi bật, được mặc ngoài cùng. Áo được layer (mặc lớp ngoài) áo cổ lọ (turtleneck) hoặc áo thun tay dài cổ cao màu đen. Đây là kiểu phối đồ phổ biến trong mùa thu/đông. Phối với quần tây ống rộng màu đen và giày thể thao cùng tông màu xanh', 0.00),
(31, 'France ', 'Europe', 'Bomber Jacket Dáng Rộng Cổ Điển (Oversized Black Bomber Jacket)', 'images/phap3.jpg', 'Phong cách High-Street/Darkwear cá tính. Áo khoác Bomber màu đen, phom dáng rộng và có độ phồng (oversized/boxy fit) tạo cảm giác thoải mái. Áo được mặc ngoài áo thun trắng cơ bản, tạo sự tương phản đơn giản (black & white). Quần joggers hoặc quần tây đen có chi tiết khóa kéo. Điểm nhấn mạnh là phụ kiện: Mũ len trắng và Giày bốt cao cổ đế thô (chunky high-top boots) màu trắng kem, tạo sự nổi bật cho phần dưới', 0.00),
(32, 'Italy', 'Europe', 'Set Sơ Mi Cổ Tàu Chất Liệu Tự Nhiên (Natural Fabric Collarless Shirt Set)', 'images/Ita1.webp', 'Phong cách Resort/Bohemian Chic. Áo sơ mi tay dài chất liệu linen/vải nhẹ màu xanh olive, thiết kế cổ tàu (mandarin collar) hoặc cổ Henley, được mặc thả lỏng. Kết hợp với quần ống rộng sọc dọc (trousers) có chi tiết thắt/quấn eo, tạo cảm giác thư giãn, phóng khoáng\r\n', 0.00),
(33, 'Italy', 'Europe', 'Áo Len Dệt Kim Sợi Thừng/Cable Knit (Cream Cable Knit Sweater)', 'images/Ita2.jpg', 'Phong cách Smart Casual Thu-Đông Nổi Bật. Áo len dệt kim với họa tiết sợi thừng (cable knit) màu trắng kem, là item cổ điển, ấm áp và rất linh hoạt. Điểm nhấn của outfit là sự kết hợp với quần tây/quần linen màu vàng mù tạt (mustard yellow) nổi bật, tạo sự tương phản mạnh mẽ và tươi sáng\r\n', 0.00),
(34, 'Italy', 'Europe', 'Áo Liền Thân Dài Dạng Vest/Tunic (Long Sleeveless Zip-up Tunic/Dress)', 'images/ita3.jpg', 'Phong cách Avant-Garde/High Fashion. Đây là một mẫu trang phục độc đáo, có thể là áo gi lê (vest) hoặc áo khoác không tay kéo dài xuống mắt cá chân, tạo hình dáng tương tự như một chiếc đầm. Chất liệu có thể là da, da lộn hoặc vải dày. Chi tiết khóa kéo (zip-up) chạy dọc thân áo là điểm nhấn. Outfit thể hiện sự phá cách, không giới hạn trong các khuôn mẫu trang phục truyền thống', 0.00),
(35, 'Argentina', 'America', 'Tracksuit Kín Gió Phối Sọc (Striped Windbreaker Tracksuit)', 'images/Argen1.webp', 'Phong cách Sporty/Athleisure cá tính. Bộ đồ thể thao (tracksuit) màu đen, được làm từ chất liệu kín gió/dù (windbreaker), với chi tiết 3 sọc trắng chạy dọc áo và quần. Mẫu quần có dây rút ở gấu quần tạo độ phồng (scrunch effect). Kết hợp với mũ lưỡi trai và túi xách họa tiết nổi bật, tạo vẻ ngoài năng động khi di chuyển\r\n', 0.00),
(36, 'Argentina', 'America', 'Áo Khoác Sơ Mi Mỏng/Shacket Mùa Hè (Lightweight Shacket)', 'images/Argen2.jpg', 'Phong cách Casual/Resort Casual lịch sự và thoải mái. Shacket (áo khoác sơ mi) màu xanh navy/đen, mỏng nhẹ, được mặc ngoài áo thun màu kem cơ bản. Kết hợp với quần short thể thao họa tiết chấm bi hoặc hình học. Đây là outfit lý tưởng cho thời tiết ấm áp, vừa giữ được sự thoải mái vừa tăng thêm độ chỉn chu so với chỉ mặc áo thun', 0.00),
(37, 'Argentina', 'America', 'Jacket Da Dáng Rộng (Oversized Leather Jacket)', 'images/Argen3.jpg', 'Phong cách Edgy/Streetwear. Điểm nhấn là chiếc áo khoác da Oversize màu đen, có chi tiết đai ở eo, tạo vẻ ngoài mạnh mẽ và cá tính. Áo được kết hợp với quần jeans ống rộng (wide-leg jeans) màu xám đậm hoặc đen bạc màu, tạo hiệu ứng phom dáng nổi bật. Outfit này thường đi kèm với giày bốt da chunky', 0.00),
(38, 'Brazil', 'America', ' Hoodie Khóa Kéo Basic/Streetwear (Basic Zip-up Hoodie)', 'images/Brazil1.jpg', 'Phong cách Streetwear/Skater. Áo hoodie khóa kéo (zip-up) màu đen trơn, rộng rãi (boxy fit), là item cơ bản dễ phối. Áo được kết hợp với quần jeans ống rộng (wide-leg jeans) màu xanh nhạt (light wash), tạo độ tương phản màu sắc rõ rệt. Outfit hoàn thiện với mũ lưỡi trai, kính râm và giày sneakers cổ thấp màu đen trắng', 0.00),
(39, 'Brazil', 'America', 'Jacket Da Lộn/Da Cổ Lông Đen (Black Shearling Collar Jacket)', 'images/Brazil2.jpg', ' Phong cách Lịch lãm/Smart Casual Thu-Đông. Áo khoác ngoài màu đen, chất liệu da hoặc da lộn, nổi bật với cổ lông cừu (shearling) màu xám đậm. Áo được mặc bên ngoài một chiếc cardigan hoặc áo sơ mi dệt kim màu xám. Kết hợp với quần tây ống suông màu đen và giày da bóng, tạo vẻ ngoài ấm áp và sang trọng\r\n', 0.00),
(40, 'Brazil', 'America', 'Bomber Da Phối Lông (Leather Bomber Jacket with Shearling Trim)', 'images/brazil3.jpg', 'Phong cách High Fashion/Chic. Chiếc áo Bomber da màu nâu sẫm, cổ áo có lót lông cừu hoặc da lộn màu trắng kem (có thể tháo rời). Áo khoác được nâng tầm khi kết hợp với áo sơ mi trắng, cà vạt mỏng, và quần tây màu xám than (trousers), cùng giày da bóng. Đây là sự kết hợp táo bạo giữa đồ thể thao (bomber) và đồ công sở (suit items)', 0.00),
(41, 'USA', 'America', 'Áo Phông Form Rộng Màu Đơn Sắc (Oversized/Boxy Solid T-Shirt)', 'images/my1.jpg', ' Phong cách Minimalist Casual/Summer Basic. Áo phông (T-Shirt) cổ tròn, form rộng rãi (boxy fit) màu đen trơn, là item không thể thiếu trong tủ đồ tối giản. Áo được kết hợp với quần short kaki hoặc vải cotton màu be (beige) có chi tiết dây rút (drawstring), tạo cảm giác thoải mái, mát mẻ. Outfit hoàn thiện bằng giày sneaker trắng trơn, mang lại vẻ ngoài sạch sẽ, hiện đại\r\n', 0.00),
(42, 'USA', 'America', 'Áo Sơ Mi Tay Ngắn Slim-Fit Mùa Hè (Slim-Fit Short-Sleeve Shirt)', 'images/my2.jpg', 'Phong cách Smart Casual. Áo sơ mi tay ngắn màu đen, được thiết kế ôm vừa vặn (slim-fit), giúp khoe hình thể một cách tinh tế. Áo được cài hết cúc (hoặc mở một cúc đầu) và kết hợp với quần chino hoặc quần tây ôm dáng (slim-fit trousers) màu be/nâu nhạt, có độ dài đến mắt cá chân. Phối cùng sneaker trắng để giữ sự trẻ trung, năng động\r\n', 0.00),
(43, 'USA', 'America', 'Áo Sơ Mi Cổ Tàu/Cổ Trụ Chất Lụa/Linen (Mandarin/Band Collar Shirt)', 'images/my3.jpg', 'Phong cách Resort Smart Casual/Italian Chic. Áo sơ mi màu trắng kem/trắng ngà, chất liệu mềm mại (cotton pha linen hoặc lụa), có thiết kế Cổ Tàu (Band/Mandarin Collar), tạo vẻ ngoài khác biệt, lịch sự nhưng không cứng nhắc. Áo được xắn tay, kết hợp với quần tây ống đứng (tapered trousers) màu xám nhạt, có độ dài vừa vặn. Outfit được nâng tầm nhờ phụ kiện (đồng hồ, vòng tay, kính)', 0.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'y', '$2y$10$4BcUWiAgs4AkW9xrO5VkPOiN6idDpZwjC4R4HjnqN3BM4RqdL0CHW', 'admin'),
(2, 't', '$2y$10$GZhBt7ETL/e8Cw8msVgDJeEsf66hqZyIMZWLUN/s2shWoc9TcVZBW', 'user'),
(3, 'u', '$2y$10$zTa0LsKLqJYhXsXlWw0Ifex3xzbY0JR5P3GDO4yl6vt9XBRz9G4oW', 'user'),
(4, 'e', '$2y$10$jX7ikB7eq3bPubfd0fX6dekpjbMdCRqEGAF.KVU6AhrnHSrE6bN.S', 'user'),
(5, 'a', '$2y$10$GnXhG8AasUL/WSHSz17PQeeP3Cn9.njyMwTtFmFYlrRA9OnaUYqTC', 'user'),
(6, 'b', '$2y$10$qZ7IDsczFdUkavVj4MVG0.E7H.G19.GHE7hvJJNVr30tKgmk59c4a', 'user'),
(7, 'c', '$2y$10$mvsH6yfNg5Fo7KTUmw5wCOVAxQDisTeNMSvB5oMIEU2GhWUvMWJN2', 'user');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `outfit_id` (`outfit_id`);

--
-- Chỉ mục cho bảng `outfits`
--
ALTER TABLE `outfits`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT cho bảng `outfits`
--
ALTER TABLE `outfits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`outfit_id`) REFERENCES `outfits` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
