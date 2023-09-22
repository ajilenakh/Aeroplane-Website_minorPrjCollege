--user table-- 
CREATE TABLE `users` (
 `id` bigint(20) NOT NULL AUTO_INCREMENT,
 `UserId` bigint(20) NOT NULL,
 `username` varchar(100) NOT NULL,
 `email` varchar(100) NOT NULL,
 `passwordhash` varchar(255) NOT NULL,
 `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci

--contactUs table--
CREATE TABLE `users` (
 `id` bigint(20) NOT NULL AUTO_INCREMENT,
 `UserId` bigint(20) NOT NULL,
 `username` varchar(100) NOT NULL,
 `email` varchar(100) NOT NULL,
 `passwordhash` varchar(255) NOT NULL,
 `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci

--Flights table with flights data--
CREATE TABLE `flights` (
  `flight_id` int(11) NOT NULL AUTO_INCREMENT,
  `flight_number` varchar(10) DEFAULT NULL,
  `origin` varchar(50) DEFAULT NULL,
  `destination` varchar(50) DEFAULT NULL,
  `depart_day` date DEFAULT NULL,
  `depart` time DEFAULT NULL,
  `arrival_day` date DEFAULT NULL,
  `arrival` time DEFAULT NULL,
  `length` varchar(50) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `seats_available` int(11) DEFAULT NULL,
  PRIMARY KEY (`flight_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `flights` VALUES 
(1,'FL001','Mumbai (BOM)','Delhi (DEL)','2023-09-30','12:00:00','2023-09-30','13:25:00','2h25m',2000,120),
(2,'FL002','Delhi (DEL)','Bangalore (BLR)','2023-10-01','19:30:00','2023-10-01','20:55:00','2h25m',1800,100),
(3,'FL003','Chennai (MAA)','Mumbai (BOM)','2023-10-02','08:45:00','2023-10-02','12:45:00','15h00m',2500,150),
(4,'FL004','Kolkata (CCU)','Hyderabad (HYD)','2023-10-03','10:30:00','2023-10-03','14:30:00','15h00m',1900,80),
(5,'FL005','Bengaluru (BLR)','Chennai (MAA)','2023-10-04','10:00:00','2023-10-04','11:15:00','4h15m',2000,120),
(6,'FL006','Hyderabad (HYD)','Kolkata (CCU)','2023-10-05','19:45:00','2023-10-05','21:00:00','4h15m',2100,70),
(7,'FL007','Chennai (MAA)','Bengaluru (BLR)','2023-10-06','08:30:00','2023-10-06','11:35:00','2h05m',1850,100),
(8,'FL008','Mumbai (BOM)','Delhi (DEL)','2023-10-07','15:30:00','2023-10-07','18:35:00','2h05m',2500,90),
(9,'FL009','Delhi (DEL)','Mumbai (BOM)','2023-10-08','14:00:00','2023-10-08','18:10:00','14h10m',2250,120),
(10,'FL010','Chennai (MAA)','Mumbai (BOM)','2023-10-09','16:30:00','2023-10-09','19:50:00','13h20m',2150,45),
(11,'FL011','Kolkata (CCU)','Chennai (MAA)','2023-10-10','06:00:00','2023-10-10','06:35:00','2h35m',2050,120),
(12,'FL012','Delhi (DEL)','Bengaluru (BLR)','2023-10-11','14:30:00','2023-10-11','15:05:00','2h35m',2300,60),
(13,'FL013','Mumbai (BOM)','Delhi (DEL)','2023-10-12','14:00:00','2023-10-12','14:40:00','13h40m',2350,90),
(14,'FL014','Chennai (MAA)','Kolkata (CCU)','2023-10-13','09:00:00','2023-10-13','07:55:00','12h55m',1950,150),
(15,'FL015','Bengaluru (BLR)','Mumbai (BOM)','2023-10-14','16:00:00','2023-10-14','15:20:00','12h20m',2450,200),
(16,'FL016','Mumbai (BOM)','Delhi (DEL)','2023-10-15','18:00:00','2023-10-15','15:50:00','11h50m',1800,110),
(17,'FL017','Delhi (DEL)','Bangalore (BLR)','2023-10-16','07:30:00','2023-10-16','14:05:00','3h35m',2100,55),
(18,'FL018','Chennai (MAA)','Mumbai (BOM)','2023-10-17','16:00:00','2023-10-17','22:35:00','3h35m',1850,180),
(19,'FL019','Kolkata (CCU)','Hyderabad (HYD)','2023-10-18','11:30:00','2023-10-18','14:50:00','2h20m',2150,70),
(20,'FL020','Bengaluru (BLR)','Chennai (MAA)','2023-10-19','20:00:00','2023-10-19','23:20:00','2h20m',2400,130);
