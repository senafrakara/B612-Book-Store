-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 31 Mar 2021, 09:24:54
-- Sunucu sürümü: 5.7.31
-- PHP Sürümü: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `b612bookshop`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `author` varchar(200) NOT NULL,
  `publisher` varchar(200) NOT NULL,
  `price` varchar(200) NOT NULL,
  `quantity` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `book_image` varchar(200) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 = published | 0 = unpublished',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `books`
--

INSERT INTO `books` (`id`, `book_name`, `description`, `author`, `publisher`, `price`, `quantity`, `categoryId`, `book_image`, `create_date`, `status`) VALUES
(3, 'Hayvan Çiftliği', 'The novel Animal Farm, published in 1945 by British author George Orwell, who is famous for his dystopian novels, contains a deep system criticism under its fairytale atmosphere. The work, written as a fable, is among the works of the author that reached the widest masses with the novel 1984. The novel is about a farm and the animals living in it; It deals with states, forms of government and societies in a simple as well as symbolic way.\r\n\r\nOrwell&amp;#039;s Animal Farm novel, considered among contemporary classics, is among the most remarkable satirical novels of world literature. The author, who includes the negative aspects of more than one administration in the subtext of his novel, builds his main theme on the criticism of socialism. In addition to being ideologically prone to socialism, Orwell also challenges totalitarian rule in his novel.\r\n\r\nGet Ready to Roam the World&amp;#039;s Most Real and Extraordinary Farm!\r\n\r\nThe plot of the book is set in the Beylik Farm owned by a man named Mr. Jones. Animals that have been mistreated by Mr. Jones are extremely uncomfortable with this situation. One day the wise pig of the farm, Koca Reis, organizes the animals and explains the idea of ​​revolution to them. Before long, Koca Reis is killed, but his words bequeathed to the animals.\r\n\r\nOne day, animals rebel on the grounds that their feed is not given, in a way that they themselves did not expect. Mr. Jones and other people are leaving the farm upon this riot of the animals. In this way, the animals that made the revolution settled in their ideals, first started by changing the name of the farm. The pigs undertake the management of this place, which is now called Animal Farm.\r\n\r\nLed by two pigs named Napoleon and Snowball, everything goes well in t', 'George Orwell', 'Can Yayınları', '100', 20, 1, 'http://localhost/B612-Book-Shop/uploads/image/hayvan_ciftligi1.jpg', '2021-03-12 22:41:03', '1'),
(5, 'Empedoklesin Dostları', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vitae accumsan ligula, sed blandit massa. Praesent eget arcu ut ligula tempor cursus non ac velit. Integer et lorem sed nibh sagittis dignissim eu vitae massa. Fusce molestie malesuada facilisis. Quisque purus leo, accumsan vel nisi vitae, placerat fringilla orci. Vestibulum sollicitudin efficitur ligula. In hac habitasse platea dictumst. Proin magna quam, dignissim in orci id, faucibus pulvinar libero. Fusce molestie molestie dictum. Proin eget sapien vel enim ullamcorper venenatis id vitae enim. Vestibulum iaculis, arcu ut consequat semper, ligula justo vulputate lorem, vitae consequat tellus nulla sed odio. Sed pellentesque cursus hendrerit.', 'Amin Maalouf', 'Yapı Kredi Yayınları', '18', 20, 5, 'http://localhost/B612-Book-Store/uploads/image/00019.jpg', '2021-03-21 18:57:36', '1'),
(6, 'Körlük', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vitae accumsan ligula, sed blandit massa. Praesent eget arcu ut ligula tempor cursus non ac velit. Integer et lorem sed nibh sagittis dignissim eu vitae massa. Fusce molestie malesuada facilisis. Quisque purus leo, accumsan vel nisi vitae, placerat fringilla orci. Vestibulum sollicitudin efficitur ligula. In hac habitasse platea dictumst. Proin magna quam, dignissim in orci id, faucibus pulvinar libero. Fusce molestie molestie dictum. Proin eget sapien vel enim ullamcorper venenatis id vitae enim. Vestibulum iaculis, arcu ut consequat semper, ligula justo vulputate lorem, vitae consequat tellus nulla sed odio. Sed pellentesque cursus hendrerit.', 'Jose Saramago', 'Kırmızı Kedi', '23.50', 20, 5, 'http://localhost/B612-Book-Store/uploads/image/00korluk.jpg', '2021-03-21 19:04:42', '1'),
(7, 'Sokrates\'in Savunması - Hasan Ali Yücel Klasikleri', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vitae accumsan ligula, sed blandit massa. Praesent eget arcu ut ligula tempor cursus non ac velit. Integer et lorem sed nibh sagittis dignissim eu vitae massa. Fusce molestie malesuada facilisis. Quisque purus leo, accumsan vel nisi vitae, placerat fringilla orci. Vestibulum sollicitudin efficitur ligula. In hac habitasse platea dictumst. Proin magna quam, dignissim in orci id, faucibus pulvinar libero. Fusce molestie molestie dictum. Proin eget sapien vel enim ullamcorper venenatis id vitae enim. Vestibulum iaculis, arcu ut consequat semper, ligula justo vulputate lorem, vitae consequat tellus nulla sed odio. Sed pellentesque cursus hendrerit.', 'Platon', 'İş Bankası Kültür Yayınları', '18', 20, 7, 'http://localhost/B612-Book-Store/uploads/image/platon.jpg', '2021-03-21 19:15:38', '1'),
(8, '50 Soruda Yapay Zeka', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vitae accumsan ligula, sed blandit massa. Praesent eget arcu ut ligula tempor cursus non ac velit. Integer et lorem sed nibh sagittis dignissim eu vitae massa. Fusce molestie malesuada facilisis. Quisque purus leo, accumsan vel nisi vitae, placerat fringilla orci. Vestibulum sollicitudin efficitur ligula. In hac habitasse platea dictumst. Proin magna quam, dignissim in orci id, faucibus pulvinar libero. Fusce molestie molestie dictum. Proin eget sapien vel enim ullamcorper venenatis id vitae enim. Vestibulum iaculis, arcu ut consequat semper, ligula justo vulputate lorem, vitae consequat tellus nulla sed odio. Sed pellentesque cursus hendrerit.', 'Cem Say', 'Bilim ve Gelecek', '25.45', 30, 3, 'http://localhost/B612-Book-Store/uploads/image/yapayzeka50soruda.jpg', '2021-03-21 19:24:00', '1'),
(9, 'Kozmos', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vitae accumsan ligula, sed blandit massa. Praesent eget arcu ut ligula tempor cursus non ac velit. Integer et lorem sed nibh sagittis dignissim eu vitae massa. Fusce molestie malesuada facilisis. Quisque purus leo, accumsan vel nisi vitae, placerat fringilla orci. Vestibulum sollicitudin efficitur ligula. In hac habitasse platea dictumst. Proin magna quam, dignissim in orci id, faucibus pulvinar libero. Fusce molestie molestie dictum. Proin eget sapien vel enim ullamcorper venenatis id vitae enim. Vestibulum iaculis, arcu ut consequat semper, ligula justo vulputate lorem, vitae consequat tellus nulla sed odio. Sed pellentesque cursus hendrerit.', 'Carl Sagannn', 'Altın Kitaplar', '29.45', 40, 3, 'http://localhost/B612-Book-Store/uploads/image/cosmos.jpg', '2021-03-21 19:24:46', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cart_item`
--

DROP TABLE IF EXISTS `cart_item`;
CREATE TABLE IF NOT EXISTS `cart_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `book_id` (`book_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(100) NOT NULL,
  `description` text,
  `tag` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `category`
--

INSERT INTO `category` (`id`, `category`, `description`, `tag`) VALUES
(1, 'Literature', 'In ullamcorper ipsum non vulputate pellentesque. Phasellus rutrum lobortis nisl quis ultricies. Donec scelerisque nec ante ac sagittis. Vestibulum lectus ante, malesuada eget posuere at, maximus eu dolor. Nullam vitae urna condimentum, vehicula tortor eget, gravida justo. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin lectus velit, rhoncus eu varius vitae, convallis vitae elit. Donec vestibulum urna justo, ac sollicitudin nunc hendrerit ut. Curabitur dolor ante, sagittis et lorem accumsan, suscipit maximus justo.', 'LIT'),
(3, 'Science', NULL, 'SCI'),
(4, 'Children and Youth', '', 'CHY'),
(5, 'Novel', '', 'NVL'),
(6, 'Computer and Internet', '', 'CAI'),
(7, 'Philosophy', '', 'PHI');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `bookId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `bookId` (`bookId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `comments`
--

INSERT INTO `comments` (`id`, `comment`, `bookId`, `userId`, `dateTime`) VALUES
(2, 'This is amazing!!!', 3, 3, '2021-03-19 22:52:49'),
(3, 'Hrika bir kitap!', 9, 1, '2021-03-30 13:19:26'),
(4, 'This book is perfect!', 7, 3, '2021-03-30 14:46:55'),
(5, 'müthiş bir kitaop &lt;sşldkcfdsşlg', 9, 3, '2021-03-31 09:14:23');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ebooks`
--

DROP TABLE IF EXISTS `ebooks`;
CREATE TABLE IF NOT EXISTS `ebooks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ebook_name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `author` varchar(200) NOT NULL,
  `book_file` varchar(500) NOT NULL,
  `book_image` varchar(500) DEFAULT NULL,
  `categoryId` int(11) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `ebooks`
--

INSERT INTO `ebooks` (`id`, `ebook_name`, `description`, `author`, `book_file`, `book_image`, `categoryId`, `dateTime`) VALUES
(2, 'JavaScript and JQuery: Interactive Front-End Web Developmen', 'Learn JavaScript and jQuery a nicer way This full-color book adopts a visual approach to teaching JavaScript &amp;amp; jQuery, showing you how to make web pages more interactive and interfaces more intuitive through the use of inspiring code examples, infographics, and photography. The content assumes no previous programming experience, other than knowing how to create a basic web page in HTML &amp;amp; CSS. You&amp;#039;ll learn how to achieve techniques seen on many popular websites (such as adding animation, tabbed panels, content sliders, form validation, interactive galleries, and sorting data).. * Introduces core programming concepts in JavaScript and jQuery * Uses clear descriptions, inspiring examples, and easy-to-follow diagrams * Teaches you how to create scripts from scratch, and understand the thousands of JavaScripts, JavaScript APIs, and jQuery plugins that are available on the w', 'Jon Duckett', 'http://localhost/B612-Book-Shop/uploads/files_ebook/2020_12_Kodluyoruz__PHP_Bootcamp_Mufredat1.pdf', 'http://localhost/B612-Book-Shop/uploads/image/indir1.png', 6, '2021-03-17 19:31:33'),
(3, 'JavaScript and JQuery: Interactive Front-End Web Development', 'Learn JavaScript and jQuery a nicer way This full-color book adopts a visual approach to teaching JavaScript &amp;amp; jQuery, showing you how to make web pages more interactive and interfaces more intuitive through the use of inspiring code examples, infographics, and photography. The content assumes no previous programming experience, other than knowing how to create a basic web page in', 'Jon Duckettttt', 'http://localhost/B612-Book-Shop/uploads/files_ebook/2020_12_Kodluyoruz__PHP_Bootcamp_Mufredat2.pdf', 'http://localhost/B612-Book-Shop/uploads/image/1984_georgeorwell4.jpg', 4, '2021-03-17 21:16:02');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `favorites`
--

DROP TABLE IF EXISTS `favorites`;
CREATE TABLE IF NOT EXISTS `favorites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `book_id` (`book_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `favorites`
--

INSERT INTO `favorites` (`id`, `book_id`, `user_id`) VALUES
(14, 9, 3),
(11, 7, 3);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `orderId` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) DEFAULT NULL,
  `ship_name` varchar(200) NOT NULL,
  `ship_surname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(200) NOT NULL,
  `zipcode` varchar(200) NOT NULL,
  `total_price` varchar(200) NOT NULL,
  `paymentcheck` int(11) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 = accept | 0 = pending',
  `del_status` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 = Delivered | 0 = Not delivered',
  PRIMARY KEY (`orderId`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `orders`
--

INSERT INTO `orders` (`orderId`, `userId`, `ship_name`, `ship_surname`, `email`, `contact`, `address`, `city`, `zipcode`, `total_price`, `paymentcheck`, `dateTime`, `status`, `del_status`) VALUES
(1, 3, 'Şura', 'Kara', 'nursena@gmail.com', '05454564545', 'fdgrthyujkl', 'ELE?K?RT', '38350', '18', 1, '2021-03-15 18:08:47', '0', '0'),
(6, 3, 'Şura', 'Karakulah', 'senafrakara@gmail.com', '05454564545', 'Erciyes Teknopark 5.bina No:57', 'MELİKGAZİ', '132456', '25.45', 1, '2021-03-30 00:26:58', '0', '0'),
(13, NULL, 'New', 'Customer', 'newcustomer@gmail.com', '54984661596', 'Cumhuriyet Mah. Türker Sk. No:8', 'MELİKGAZİ', '38350', '54.9', 1, '2021-03-30 00:51:47', '1', '1'),
(15, NULL, 'Cafer', 'Karakulah', 'cafer@gmail.com', '5451654641', 'dşsflkgnmfdşlgmklgvsfdkmfklerftyhujkyjthrewdrty', 'adksjvnksjvnfslk', '5464', '43.45', 1, '2021-03-30 00:55:35', '1', '1'),
(16, 3, 'Şura', 'Karakulah', 'senafrakara@gmail.com', '05454564545', 'Erciyes Teknopark 5.bina No:57', 'MELİKGAZİ', '132456', '203.85', 1, '2021-03-30 14:21:10', '0', '0'),
(17, NULL, 'hülo', 'hacı', 'hula@gmail.com', '46565163156', 'şdşslöfmklgnkvmdsşlfdslkvdslk', 'döşlsksfd', '6464', '18', 1, '2021-03-30 23:13:34', '0', '0'),
(18, 3, 'Şura', 'Karakulah', 'senafrakara@gmail.com', '05454564545', 'Erciyes Teknopark 5.bina No:57', 'MELİKGAZİ', '132456', '295.95', 1, '2021-03-30 23:14:51', '1', '0'),
(19, 3, 'Şura', 'Karakulah', 'senafrakara@gmail.com', '05454564545', 'Erciyes Teknopark 5.bina No:57', 'MELİKGAZİ', '132456', '109.8', 1, '2021-03-31 09:15:20', '0', '0');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderId` int(11) NOT NULL,
  `bookId` int(11) NOT NULL,
  `total_price` varchar(200) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `orderId` (`orderId`),
  KEY `bookId` (`bookId`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `order_items`
--

INSERT INTO `order_items` (`id`, `orderId`, `bookId`, `total_price`, `quantity`) VALUES
(1, 1, 7, '36', 2),
(3, 6, 8, '25.45', 1),
(4, 13, 9, '29.45', 1),
(6, 15, 5, '18', 1),
(7, 15, 8, '25.45', 1),
(8, 16, 8, '50.9', 2),
(9, 16, 9, '29.45', 1),
(10, 16, 6, '23.5', 1),
(11, 16, 3, '100', 1),
(12, 17, 7, '18', 1),
(13, 18, 3, '200', 2),
(14, 18, 6, '70.5', 3),
(15, 18, 8, '25.45', 1),
(16, 19, 8, '50.9', 2),
(17, 19, 9, '58.9', 2);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'U',
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reset_password_token` varchar(255) DEFAULT NULL,
  `token_created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `contact`, `email`, `password`, `type`, `createdate`, `reset_password_token`, `token_created_at`) VALUES
(1, 'Nursena ', 'Karakulah', '05414363683', 'sena@gmail.com', '$2y$12$Whd9794AZEVWBTIpTSyHnueBCbgDwREK/cL.V8kEvTkgLJPwW.kby', 'A', '2021-03-10 18:22:29', NULL, NULL),
(2, 'Berke', 'Güleç', '0435782424', 'berke@gmail.com', '$2y$12$JTWgvvT0eJBvpACvopqdE.y.rAni3qS/XEOQaxVp.BuYYIb7rjyDW', 'U', '2021-03-11 22:04:45', NULL, NULL),
(3, 'Şuranur', 'Karakulah', '34230125456', 'senafrakara@gmail.com', '$2y$12$kHUg3lPk0rAAhAGn63595emPn6f2mRs2pygM6EiAQXvgZIbAvglmS', 'U', '2021-03-15 21:21:31', 'd41d8cd98f00b204e9800998ecf8427e', '2021-03-31 09:19:00');

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`bookId`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Tablo kısıtlamaları `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `orders` (`orderId`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`bookId`) REFERENCES `books` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
