-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2024 at 10:40 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `a_id` int(7) NOT NULL,
  `a_name` varchar(250) NOT NULL,
  `a_username` varchar(250) NOT NULL,
  `a_password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`a_id`, `a_name`, `a_username`, `a_password`) VALUES
(1, 'ชลธิชา เอี่ยมละออ', 'admin1', '81dc9bdb52d04dc20036dbd8313ed055'),
(2, 'เกียรติศักดิ์ มูลบัวภา', 'admin2', '81dc9bdb52d04dc20036dbd8313ed055'),
(3, 'วริษา พูลพุทธ', 'admin3', '81dc9bdb52d04dc20036dbd8313ed055'),
(4, 'นิรันดร ศรีสวัสดิ์', 'admin4', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `c_id` int(7) NOT NULL,
  `c_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`c_id`, `c_name`) VALUES
(1, 'Box Set'),
(2, 'Single Box'),
(3, '1000persen'),
(4, '400persen');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `c_id` int(7) NOT NULL,
  `p_id` int(7) NOT NULL,
  `p_name` varchar(250) NOT NULL,
  `p_detail` text NOT NULL,
  `p_price` float(9,2) NOT NULL,
  `p_ext` varchar(250) NOT NULL,
  `pt_id` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`c_id`, `p_id`, `p_name`, `p_detail`, `p_price`, `p_ext`, `pt_id`) VALUES
(1, 1, 'CRYBABY × Powerpuff Girls Series Figures', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 6-9  เซนติเมตร\r\nส่วนประกอบ: PVC/ABS\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสลุ้นรับรางวัลที่ซ่อนอยู่', 4560.00, 'jpg', 1),
(1, 2, 'SKULLPANDA The Sound Series Figures', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 7-11 เซนติเมตร\r\nส่วนประกอบ:ABS/PVC/Magnet\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 4560.00, 'jpg', 2),
(1, 3, 'CRYBABY Sad Club Series Scene Sets', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 7.2 เซนติเมตร\r\nส่วนประกอบ: ABS/PVC\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 8 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 3840.00, 'jpg', 1),
(1, 4, 'Dimoo Zodiac Series', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 7-9.5 เซนติเมตร\r\nส่วนประกอบ: PVC/ABS\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 3840.00, 'jpg', 3),
(1, 5, 'Dimoo No One\'s Gonna Sleep Tonight Series Figures', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 6-9 เซนติเมตร\r\nส่วนประกอบ: PVC/ABS\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 4560.00, 'jpg', 3),
(1, 6, 'Hirono Mime Series Figures', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 5.3 - 10.1 เซนติเมตร\r\nส่วนประกอบ:PVC/ABS\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ\r\n', 4560.00, 'jpg', 4),
(1, 7, 'Hirono Reshape Series Figures', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 8.6-10.3 เซนติเมตร\r\nส่วนประกอบ: PVC/ABS\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 9 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสลุ้นรับรางวัลที่ซ่อนอยู่', 3420.00, 'jpg', 4),
(1, 8, 'Hirono Shelter Series Figures', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 6-10 เซนติเมตร\r\nส่วนประกอบ:PVC/ABS/Magnet\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ\r\n', 4560.00, 'jpg', 4),
(1, 9, 'SKULLPANDA Image Of Reality Series Figures', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 5-8  เซนติเมตร\r\nส่วนประกอบ: PVC/ABS/POM/Magnet\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสลุ้นรับรางวัลที่ซ่อนอยู่', 4560.00, 'jpg', 2),
(1, 10, 'MOLLY × The Powerpuff Girls Series Action Figure', 'ยี่ห้อ : POP MART\r\nขนาด : Body height 13cm\r\nส่วนประกอบ: PVC/ABS/PP/Nylon/Magnet/Cotton/Terylene/Spandex/Polystone\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 3 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 4650.00, 'jpg', 5),
(1, 11, 'MEGA SPACE MOLLY 100%', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 7-8 เซนติเมตร\r\nส่วนประกอบ: PVC/ABS/PC\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 9 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 3870.00, 'jpg', 5),
(1, 12, 'Harry Potter Heading to Hogwarts Series', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 8.9-10 เซนติเมตร\r\nส่วนประกอบ:  PVC/ABS/Hardware\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 3840.00, 'jpg', 6),
(1, 13, 'POP BEAN Harry Potter Flight Series', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 2.5 เซนติเมตร\r\nส่วนประกอบ:PVC', 3840.00, 'jpg', 6),
(1, 14, 'PUCKY Sleeping Forest Series', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 5 - 9.8 เซนติเมตร\r\nส่วนประกอบ:PVC/ABS\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 9 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 3420.00, 'jpg', 7),
(1, 15, 'PUCKY Rabbit Cafe Series', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 6-8.4 เซนติเมตร\r\nส่วนประกอบ: PVC/ABS\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 4560.00, 'jpg', 7),
(1, 16, 'AZURA A Dream About Stars Series Figures', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 6.9-10.9 เซนติเมตร\r\nส่วนประกอบ:PVC/ABS\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 4560.00, 'jpg', 8),
(1, 17, 'AZURA Natural Elements Series', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 8.1-10.3 เซนติเมตร\r\nส่วนประกอบ:ABS/PVC/Magnet\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 4560.00, 'jpg', 8),
(1, 18, 'BLINDBOX Disney Princess Art Gallery Series', 'รายละเอียด\r\nกล่องสุ่มฟิกเกอร์ Disney Princess Art Gallery Blind Box Series  สุดพิเศษ ลิขสิทธิ์แท้ดิสนีย์ มาด้วยกัน 6 แบบให้เพื่อนๆได้มาสุ่มเป็นเจ้าของ บอกเลยว่างานนี้พิเศษสุดๆ งานเนี้ยบ ดีไซน์น่ารัก\r\n\r\n- Disney ลิขสิทธิ์แท้\r\n- Disney Princess Art Gallery Blind Box Series\r\n- มี 6 แบบ (1 คาแรคเตอร์หายาก)', 2390.00, 'jpg', 9),
(1, 19, 'BLINDBOX SLEEP Dreamland Elf BOX with 8 pieces', 'รายละเอียด \r\n1 กล่อง = 8 ชิ้น\r\nขนาดสินค้า : ประมาณ 2.8 นิ้ว (7 ซม.)\r\nวัสดุ : PVC/ABS', 4998.00, 'jpg', 10),
(1, 20, 'BLINDBOX SLEEP Fairy Land Elf Series Pvc&Abs Trading Figure', 'รายละเอียด\r\n1 กล่อง = 10 ชิ้น\r\nขนาดสินค้า : ประมาณ 2.8 นิ้ว (7 ซม.)\r\nวัสดุ : PVC/ABS', 5162.00, 'jpg', 10),
(1, 21, 'THE MONSTERS - Tasty Macarons Vinyl Face Blind Box', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 17 เซนติเมตร\r\nส่วนประกอบ:45% Polyester, 55% PVC\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 6 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 3330.00, 'jpg', 11),
(1, 22, 'THE MONSTERS Playing Games Series Scene Sets', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 4 เซนติเมตร\r\nส่วนประกอบ:  PVC/ABS/Hardware\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 6 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 2280.00, 'jpg', 11),
(1, 23, 'HACIPUPU The Constellation Series Figures ', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 7-11 เซนติเมตร\r\nส่วนประกอบ:PVC/ABS\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 4560.00, 'jpg', 12),
(1, 24, 'HACIPUPU My Little Hero Series Figures', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 7-9 เซนติเมตร\r\nส่วนประกอบ: PVC/ABS\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 4560.00, 'jpg', 12),
(3, 25, 'MEGA JUST DIMOO 1000% A Thunder Shower', 'ยี่ห้อ : POP MART\r\nขนาด : 660mm\r\nส่วนประกอบ: PVC/Electronic Component', 26390.00, 'jpg', 3),
(1, 26, 'MOLLY Anniversary Statues Classical Retro 2 Series', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 12 เซนติเมตร\r\nส่วนประกอบ:PVC/ABS\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 10 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 4300.00, 'jpg', 5),
(1, 27, 'MOLLY Anniversary Statues Classical Retro Series Figures', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 9.5 เซนติเมตร\r\nส่วนประกอบ:PVC/ABS\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 10 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 4300.00, 'jpg', 5),
(1, 28, 'Baby Molly When I was Three！Series Figures', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 6.9-13 เซนติเมตร\r\nส่วนประกอบ: PVC/ABS/Magnet\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 4560.00, 'jpg', 5),
(1, 29, 'DIMOO Animal Kingdom Series Figures', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ  6-8 เซนติเมตร\r\nส่วนประกอบ:PVC/ABS\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 4560.00, 'jpg', 3),
(1, 30, 'DIMOO By Your Side Series Figures', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 8 เซนติเมตร\r\nส่วนประกอบ:PVC/ABS/Nylon\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 4560.00, 'jpg', 3),
(1, 31, 'DIMOO No One\'s Gonna Sleep Tonight Series- Pendant Blind Box', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 18 เซนติเมตร\r\nส่วนประกอบ: Zinc Alloy\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสลุ้นรับรางวัลที่ซ่อนอยู่', 3240.00, 'jpg', 3),
(1, 32, 'Dimoo Dating Series-Lanyard Blind Box', 'ยี่ห้อ : POP MART\r\nขนาด : ABOUT 6*5cm\r\nส่วนประกอบ: PVC/Terylene/Silicone/Zinc Alloy\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 9 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 2880.00, 'jpg', 3),
(1, 33, 'DIMOO Dating Series', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 7-8 เซนติเมตร\r\nส่วนประกอบ: PVC/ABS\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 4560.00, 'jpg', 3),
(1, 34, 'HIRONO The Other One Series', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 6.6 - 9.2 เซนติเมตร\r\nส่วนประกอบ: PVC/ABS/Hardware/Magnet\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ\r\n', 4560.00, 'jpg', 4),
(1, 35, 'Hirono Little Mischief Series', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 8 เซนติเมตร\r\nส่วนประกอบ: PVC/Paper\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสลุ้นรับรางวัลที่ซ่อนอยู่', 4560.00, 'jpg', 4),
(1, 36, 'SKULLPANDA The Warmth Series', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 6-9 เซนติเมตร\r\nส่วนประกอบ:PVC/ABS\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 4560.00, 'jpg', 2),
(1, 37, 'SKULLPANDA Everyday Wonderland Series', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 6.0-9.0 เซนติเมตร\r\nส่วนประกอบ: PVC/ABS\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 4560.00, 'jpg', 2),
(1, 38, 'Skullpanda City of Night Serie', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 6.4-7.3 เซนติเมตร\r\nส่วนประกอบ: ABS/Hardware/PMMA/PVC\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสลุ้นรับรางวัลที่ซ่อนอยู่', 4560.00, 'jpg', 2),
(1, 39, 'CRYBABY CHEER UP, BABY! SERIES-Bracelet Blind', 'ละเอียด ยี่ห้อ : POP MART\r\nขนาด : Alloy about 2cm*2.5cm，knot is retractable\r\nส่วนประกอบ: Zinc alloy/wax cord/nylon/terylene/acrylic', 1920.00, 'jpg', 1),
(1, 40, 'SKULLPANDA The Ink Plum Blossom Series Figures', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 8 เซนติเมตร\r\nส่วนประกอบ: PVC/ABS\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสลุ้นรับรางวัลที่ซ่อนอยู่', 4560.00, 'jpg', 2),
(1, 41, 'CRYBABY Sad Club Series-Plush Flower Blind Box', 'ยี่ห้อ : POP MART\r\nขนาด : 16cm*6cm*29cm\r\nส่วนประกอบ: 100% polyester\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 6 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 2280.00, 'jpg', 1),
(1, 42, 'CRYBABY Monster Tears Series ', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 6.9-9.6 เซนติเมตร\r\nส่วนประกอบ:PVC/ABS\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 4560.00, 'jpg', 1),
(1, 43, 'CRYBABY Sunset Concert Series-Plush Pendant Blind Box', 'ยี่ห้อ : POP MART\r\nขนาด : About 11cm*6.5cm*14cm(excluding hanging loop)、11cm*6.5cm*20cm(including hanging loop)\r\nส่วนประกอบ: \r\nShell: 100% Polyester;\r\nStuffing: 95% Polyester, 5% Iron Wire\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 6 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)', 2580.00, 'jpg', 1),
(1, 44, 'PUCKY The Feast Series Figures', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 6.9-9.3 เซนติเมตร\r\nส่วนประกอบ: PVC/ABS\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 4560.00, 'jpg', 7),
(1, 45, 'PUCKY Home Time Series Figures', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 6.0-9.3 เซนติเมตร\r\nส่วนประกอบ: PVC/ABS/HARDWARE/BATTERY\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 9 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 3420.00, 'jpg', 7),
(3, 46, 'MEGA SPACE MOLLY 1000% Palmer House ', 'ยี่ห้อ : POP MART\r\nขนาด : 700mm\r\nส่วนประกอบ: PVC/ABS/PC\r\n*สินค้า MEGA COLLECTION ไม่รวมอยู่ในโปรโมชั่นและกิจกรรม', 31900.00, 'jpg', 5),
(3, 47, 'MEGA ROYAL MOLLY 1000% HAN MEILIN', 'ยี่ห้อ : POP MART\r\nขนาด : Height about 900mm\r\nส่วนประกอบ:ABS\r\n*สินค้า MEGA COLLECTION ไม่รวมอยู่ในโปรโมชั่นและกิจกรรม', 31900.00, 'jpg', 5),
(3, 48, ' MEGA COLLECTION 1000% JUST DIMOO × SmileyWorld', 'BRAND：POP MART\r\nSIZE：626mm\r\nMATERIAL：PVC', 31900.00, 'jpg', 3),
(3, 49, 'MEGA SKULLPANDA 1000% Egon Schiele', 'ยี่ห้อ : POP MART\r\nขนาด : 760mm\r\nส่วนประกอบ: ABS', 31900.00, 'jpg', 2),
(3, 50, 'MEGA a SKULLPANDA 1000% JEAN-MICHEL BASQUIAT', 'BRAND POP MART\r\nSIZE 760mm\r\nMATERIAL ABS', 31900.00, 'jpg', 2),
(4, 51, 'MEGA SPACE MOLLY 400% CHINA WOMEN\'S NATIONAL BASKETBALL TEAM ', 'ยี่ห้อ : POP MART\r\nขนาด : Height about 300mm\r\nส่วนประกอบ:PVC/ABS/PC', 6790.00, 'jpg', 5),
(4, 52, 'MEGA SPACE MOLLY 400% PANDA', 'ยี่ห้อ : POP MART\r\nขนาด : 300mm\r\nส่วนประกอบ: PVC+ABS+Polyester Fiber', 6790.00, 'jpg', 5),
(4, 53, 'MEGA COLLECTION 400%+100% SPACE MOLLY × Care Bears-Care-a-lot Bear', 'Product Name: MEGA COLLECTION 400%+100% SPACE MOLLY × Care Bears-Care-a-lot Bear\r\nBrand: POP MART\r\nSize: 11.9 inch\r\nMaterial: ABS/PC/PVC', 7890.00, 'jpg', 5),
(4, 54, 'MEGA SPACE MOLLY 400% TEAM COCA-COLA', 'ยี่ห้อ : POP MART\r\nขนาด : 300mm\r\nส่วนประกอบ: PVC/ABS/PC', 6790.00, 'jpg', 5),
(4, 55, 'MEGA SPACE MOLLY 400% Rainbow', 'ยี่ห้อ : POP MART\r\nขนาด : Height about 295mm\r\nส่วนประกอบ: ABS/PVC/PC', 6790.00, 'jpg', 5),
(4, 56, 'MEGA SPACE MOLLY 400% Heartfelt Words', 'ยี่ห้อ : POP MART\r\nขนาด : 295มม\r\nส่วนประกอบ:  ABS/PC ', 6790.00, 'jpg', 5),
(4, 57, 'MEGA SPACE MOLLY 400% Garfield', 'ยี่ห้อ : POP MART\r\nขนาด : 250mm\r\nส่วนประกอบ: PVC', 6790.00, 'jpg', 5),
(4, 58, 'MEGA ROYAL MOLLY 400% HAN MEILIN', 'POP MART\r\nขนาด : Height about 380mm\r\nส่วนประกอบ:  ABS', 7890.00, 'jpg', 5),
(4, 59, 'MEGA ROYAL MOLLY 400% MIKA NINAGAWA', 'ยี่ห้อ : POP MART\r\nขนาด : 380มม\r\nส่วนประกอบ: ABS/PC', 7890.00, 'jpg', 5),
(4, 60, 'MEGA SPACE MOLLY 400% Gary Baseman', 'ยี่ห้อ : POP MART\r\nขนาด : Height about 380mm\r\nส่วนประกอบ:  ABS', 7890.00, 'jpg', 5),
(2, 61, 'CRYBABY × Powerpuff Girls Series Figures(กล่องเดียว)', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 6-9  เซนติเมตร\r\nส่วนประกอบ: PVC/ABS\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสลุ้นรับรางวัลที่ซ่อนอยู่', 380.00, 'jpg', 1),
(2, 62, 'SKULLPANDA The Sound Series Figures(กล่องเดียว)', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 7-11 เซนติเมตร\r\nส่วนประกอบ:ABS/PVC/Magnet\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 380.00, 'jpg', 2),
(2, 63, 'CRYBABY Sad Club Series Scene Sets(กล่องเดียว)', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 7.2 เซนติเมตร\r\nส่วนประกอบ: ABS/PVC\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 8 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 380.00, 'jpg', 1),
(2, 64, 'Dimoo Zodiac Series(กล่องเดียว)', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 7-9.5 เซนติเมตร\r\nส่วนประกอบ: PVC/ABS\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 320.00, 'jpg', 3),
(2, 65, 'DIMOO No One\'s Gonna Sleep Tonight Series Figures (กล่องเดียว)', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 6-9 เซนติเมตร\r\nส่วนประกอบ: PVC/ABS\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 380.00, 'jpg', 3),
(2, 66, 'Hirono Mime Series Figures (กล่องเดียว)', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 5.3 - 10.1 เซนติเมตร\r\nส่วนประกอบ:PVC/ABS\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 380.00, 'jpg', 4),
(2, 67, 'HIRONO Reshape Series Figures(กล่องเดียว)', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 8.6-10.3 เซนติเมตร\r\nส่วนประกอบ: PVC/ABS\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 9 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสลุ้นรับรางวัลที่ซ่อนอยู่', 380.00, 'jpg', 4),
(2, 68, 'Hirono Shelter Series Figures(กล่องเดียว)', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 6-10 เซนติเมตร\r\nส่วนประกอบ:PVC/ABS/Magnet\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 380.00, 'jpg', 4),
(2, 69, 'SKULLPANDA Image Of Reality Series Figures (กล่องเดียว) ', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 5-8  เซนติเมตร\r\nส่วนประกอบ: PVC/ABS/POM/Magnet\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสลุ้นรับรางวัลที่ซ่อนอยู่', 380.00, 'jpg', 2),
(2, 70, 'MOLLY × The Powerpuff Girls Series Action Figure (กล่องเดียว)', 'ยี่ห้อ : POP MART\r\nขนาด : Body height 13cm\r\nส่วนประกอบ: PVC/ABS/PP/Nylon/Magnet/Cotton/Terylene/Spandex/Polystone\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 3 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 1550.00, 'jpg', 5),
(2, 71, 'MEGA SPACE MOLLY 100% Series 3', 'รายละเอียด ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 7-8 เซนติเมตร\r\nส่วนประกอบ: PVC/ABS/PC\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 9 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 430.00, 'jpg', 5),
(2, 72, 'Harry Potter Heading to Hogwarts Series(กล่องเดียว)', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 8.9-10 เซนติเมตร\r\nส่วนประกอบ:  PVC/ABS/Hardware\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 320.00, 'jpg', 6),
(2, 73, 'POP BEAN Harry Potter Flight Series(กล่องเดียว) ', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 2.5 เซนติเมตร\r\nส่วนประกอบ:PVC', 320.00, 'jpg', 6),
(2, 74, 'PUCKY Sleeping Forest Series (กล่องเดียว)', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 5 - 9.8 เซนติเมตร\r\nส่วนประกอบ:PVC/ABS\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 9 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 380.00, 'jpg', 7),
(2, 75, 'PUCKY Rabbit Cafe Series (กล่องเดียว)', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 6-8.4 เซนติเมตร\r\nส่วนประกอบ: PVC/ABS\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 380.00, 'jpg', 7),
(2, 76, 'AZURA A Dream About Stars Series Figures', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 6-8.4 เซนติเมตร\r\nส่วนประกอบ: PVC/ABS\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 380.00, 'jpg', 8),
(2, 77, 'Azura Natural Elements Series (กล่องเดียว) ', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 8.1-10.3 เซนติเมตร\r\nส่วนประกอบ:ABS/PVC/Magnet\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 380.00, 'jpg', 8),
(2, 78, 'Blind Box Disney Princess Art Gallery Series (กล่องเดียว)', 'กล่องสุ่มฟิกเกอร์ Disney Princess Art Gallery Blind Box Series  สุดพิเศษ ลิขสิทธิ์แท้ดิสนีย์ มาด้วยกัน 6 แบบให้เพื่อนๆได้มาสุ่มเป็นเจ้าของ บอกเลยว่างานนี้พิเศษสุดๆ งานเนี้ยบ ดีไซน์น่ารัก', 399.00, 'jpg', 9),
(2, 79, 'BLINDBOX SLEEP Dreamland Elf BOX with 8 pieces (กล่องเดียว)', 'รายละเอียด 52TOYS\r\n1 กล่อง \r\nขนาดสินค้า : ประมาณ 2.8 นิ้ว (7 ซม.)\r\nวัสดุ : PVC/ABS', 400.00, 'jpg', 10),
(2, 80, 'Blindbox Sleep Fairy Land Elf Series Pvc&Abs Trading Figure(กล่องเดียว)', 'รายละเอียด 52TOYS\r\n1 กล่อง \r\nขนาดสินค้า : ประมาณ 2.8 นิ้ว (7 ซม.)\r\nวัสดุ : PVC/ABS', 400.00, 'jpg', 10),
(2, 81, 'THE MONSTERS - Tasty Macarons Vinyl Face Blind Box', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 17 เซนติเมตร\r\nส่วนประกอบ:45% Polyester, 55% PVC\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 6 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 550.00, 'jpg', 11),
(2, 82, 'THE MONSTERS Playing Games Series Scene Sets\r\n (กล่องเดียว)', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 4 เซนติเมตร\r\nส่วนประกอบ:  PVC/ABS/Hardware\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 6 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 380.00, 'jpg', 11),
(2, 83, 'HACIPUPU The Constellation Series Figures (กล่องเดียว)', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 7-11 เซนติเมตร\r\nส่วนประกอบ:PVC/ABS\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 380.00, 'jpg', 12),
(2, 84, 'HACIPUPU My Little Hero Series Figures(กล่องเดียว) ', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 7-9 เซนติเมตร\r\nส่วนประกอบ: PVC/ABS\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 380.00, 'jpg', 12),
(2, 85, 'MOLLY Anniversary Statues Classical Retro 2 Series Figures\r\n(กล่องเดียว)', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 12 เซนติเมตร\r\nส่วนประกอบ:PVC/ABS\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 10 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 430.00, 'jpg', 5),
(2, 86, 'MOLLY Anniversary Statues Classical Retro Series Figures(กล่องเดียว)', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 9.5 เซนติเมตร\r\nส่วนประกอบ:PVC/ABS\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 10 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 430.00, 'jpg', 5),
(2, 87, ' Baby Molly When I was Three！Series Figures\r\n (กล่องเดียว)', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 6.9-13 เซนติเมตร\r\nส่วนประกอบ: PVC/ABS/Magnet\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 380.00, 'jpg', 5),
(2, 88, 'DIMOO Animal Kingdom Series Figures(กล่องเดียว)', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ  6-8 เซนติเมตร\r\nส่วนประกอบ:PVC/ABS\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 380.00, 'jpg', 3),
(2, 89, 'DIMOO By Your Side Series Figures(กล่องเดียว)', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 8 เซนติเมตร\r\nส่วนประกอบ:PVC/ABS/Nylon\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 380.00, 'jpg', 3),
(2, 90, 'DIMOO No One\'s Gonna Sleep Tonight Series- Pendant Blind Box (กล่องเดียว)', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 18 เซนติเมตร\r\nส่วนประกอบ: Zinc Alloy\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสลุ้นรับรางวัลที่ซ่อนอยู่', 270.00, 'jpg', 3),
(2, 91, 'Dimoo Dating Series-Lanyard Blind Box (กล่องเดียว)', 'ยี่ห้อ : POP MART\r\nขนาด : ABOUT 6*5cm\r\nส่วนประกอบ: PVC/Terylene/Silicone/Zinc Alloy\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 9 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 320.00, 'jpg', 3),
(2, 92, 'DIMOO Dating Series(กล่องเดียว)', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 7-8 เซนติเมตร\r\nส่วนประกอบ: PVC/ABS\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 380.00, 'jpg', 3),
(2, 93, 'HIRONO The Other One Series(กล่องเดียว)', ' ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 6.6 - 9.2 เซนติเมตร\r\nส่วนประกอบ: PVC/ABS/Hardware/Magnet\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 380.00, 'jpg', 4),
(2, 94, 'Hirono Little Mischief Series(กล่องเดียว) ', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 8 เซนติเมตร\r\nส่วนประกอบ: PVC/Paper\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสลุ้นรับรางวัลที่ซ่อนอยู่', 380.00, 'jpg', 4),
(2, 95, 'SKULLPANDA The Warmth Series(กล่องเดียว)', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 6-9 เซนติเมตร\r\nส่วนประกอบ:PVC/ABS\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 380.00, 'jpg', 2),
(2, 96, 'SKULLPANDA Everyday Wonderland Series(กล่องเดียว)', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 6.0-9.0 เซนติเมตร\r\nส่วนประกอบ: PVC/ABS\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 380.00, 'jpg', 2),
(2, 97, 'Skullpanda City of Night Series(กล่องเดียว) ', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 6.4-7.3 เซนติเมตร\r\nส่วนประกอบ: ABS/Hardware/PMMA/PVC\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสลุ้นรับรางวัลที่ซ่อนอยู่', 380.00, 'jpg', 2),
(2, 98, 'CRYBABY CHEER UP, BABY! SERIES-Bracelet Blind Box\r\n(กล่องเดียว)', 'ยี่ห้อ : POP MART\r\nขนาด : Alloy about 2cm*2.5cm，knot is retractable\r\nส่วนประกอบ: Zinc alloy/wax cord/nylon/terylene/acrylic', 380.00, 'jpg', 1),
(2, 99, 'SKULLPANDA The Ink Plum Blossom Series Figures(กล่องเดียว) ', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 8 เซนติเมตร\r\nส่วนประกอบ: PVC/ABS\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสลุ้นรับรางวัลที่ซ่อนอยู่', 380.00, 'jpg', 2),
(2, 100, 'CRYBABY Sad Club Series-Plush Flower Blind Box\r\n(กล่องเดียว)', 'ยี่ห้อ : POP MART\r\nขนาด : 16cm*6cm*29cm\r\nส่วนประกอบ: 100% polyester\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 6 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 380.00, 'jpg', 1),
(2, 101, 'CRYBABY Monster Tears Series (กล่องเดียว) ', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 6.9-9.6 เซนติเมตร\r\nส่วนประกอบ:PVC/ABS\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 380.00, 'jpg', 1),
(2, 102, 'CRYBABY Sunset Concert Series-Plush Pendant Blind Box(กล่องเดียว)', 'ยี่ห้อ : POP MART\r\nขนาด : About 11cm*6.5cm*14cm(excluding hanging loop)、11cm*6.5cm*20cm(including hanging loop)\r\nส่วนประกอบ: \r\nShell: 100% Polyester;\r\nStuffing: 95% Polyester, 5% Iron Wire\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 6 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)', 430.00, 'jpg', 1),
(2, 103, ' PUCKY The Feast Series Figures(กล่องเดียว) ', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 6.9-9.3 เซนติเมตร\r\nส่วนประกอบ: PVC/ABS\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 12 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 380.00, 'jpg', 7),
(2, 104, 'PUCKY Home Time Series Figures\r\n(กล่องเดียว)', 'ยี่ห้อ : POP MART\r\nขนาด : สูงโดยประมาณ 6.0-9.3 เซนติเมตร\r\nส่วนประกอบ: PVC/ABS/HARDWARE/BATTERY\r\nทั้งเซ็ตจะประกอบไปด้วยกล่องสุ่ม 9 ชิ้น\r\n(หากซื้อทั้งเซ็ตจะไม่มีฟิกเกอร์โมเดลที่ซ้ำกัน)\r\n*มีโอกาสจะได้ฟิกเกอร์ลับ', 380.00, 'jpg', 7),
(1, 105, 'กล่องสุ่ม พวงกุญแจ 52TOYS LDCX DETECTIVE CONAN Yummy Box whole set box ', '[ยกbox] กล่องสุ่ม พวงกุญแจ 52TOYS LDCX DETECTIVE CONAN Yummy Box whole set box กล่องข้าวโคนัน \r\n\r\nBrand : 52Toys / LDCX\r\n\r\nType : 6+1\r\n\r\nSize : 12 CM', 2500.00, 'jpg', 13),
(2, 106, ' กล่องสุ่ม พวงกุญแจ 52TOYS LDCX DETECTIVE CONAN Yummy (กล่องเดียว)', 'กล่องสุ่ม พวงกุญแจ 52TOYS LDCX DETECTIVE CONAN Yummy Box whole set box กล่องข้าวโคนัน \r\n\r\nBrand : 52Toys / LDCX\r\n\r\nType : 6+1\r\n\r\nSize : 12 CM', 430.00, 'jpg', 13),
(1, 107, 'Detective Conan Classic Character Series', 'roduct Name： Detective Conan Classic Character Series\r\n\r\nBrand： POP MART\r\n\r\nMaterial： PVC/ABS\r\n\r\nSize：Height about 6.9 - 8.9 cm', 4500.00, 'jpg', 13),
(2, 108, 'Detective Conan Classic Character Series (กล่องเดียว)', 'roduct Name： Detective Conan Classic Character Series\r\n\r\nBrand： POP MART\r\n\r\nMaterial： PVC/ABS\r\n\r\nSize：Height about 6.9 - 8.9 cm', 380.00, 'jpg', 13);

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `t_id` int(7) NOT NULL,
  `t_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`t_id`, `t_name`) VALUES
(1, 'Crybaby'),
(2, 'Skullpanda'),
(3, 'Dimoo'),
(4, 'Hirono'),
(5, 'Molly'),
(6, 'Harry Potter'),
(7, 'Pucky'),
(8, 'Azura'),
(9, 'Disney'),
(10, 'Sleep'),
(11, 'The Monsters'),
(12, 'Hacipupu'),
(13, 'Conan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`t_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `a_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `c_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `p_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `t_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
