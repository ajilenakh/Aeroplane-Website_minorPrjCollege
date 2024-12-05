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
CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `phoneNumber` int(20) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


--Flights table with flights data--
CREATE TABLE flights (
  `flight_id` VARCHAR(50) NOT NULL,
  `origin` VARCHAR(50) NOT NULL,
  `destination` VARCHAR(50) NOT NULL,
  `depart_day` DATE NOT NULL,
  `depart` TIME NOT NULL,
  `arrival_day` DATE NOT NULL,
  `arrival` TIME NOT NULL,
  `duration` VARCHAR(50) NOT NULL,
  `price` DECIMAL(10, 2) NOT NULL,
  `seats_available` INT NOT NULL,
  PRIMARY KEY (`flight_id`)
) ENGINE='InnoDB' DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `flights` 
(`flight_id`, `origin`, `destination`, `depart_day`, `depart`, `arrival_day`, `arrival`, `duration`, `price`, `seats_available`)
VALUES 
('FL001', 'Mumbai', 'Delhi', '2024-12-01', '12:00:00', '2024-12-01', '13:25:00', '2h25m', 2000, 120),
('FL002', 'Delhi', 'Bangalore', '2024-12-02', '19:30:00', '2024-12-02', '20:55:00', '2h25m', 1800, 100),
('FL003', 'Chennai', 'Mumbai', '2024-12-03', '08:45:00', '2024-12-03', '12:45:00', '15h00m', 2500, 150),
('FL004', 'Kolkata', 'Hyderabad', '2024-12-04', '10:30:00', '2024-12-04', '14:30:00', '15h00m', 1900, 80),
('FL005', 'Bengaluru', 'Chennai', '2024-12-05', '10:00:00', '2024-12-05', '11:15:00', '4h15m', 2000, 120),
('FL006', 'Hyderabad', 'Kolkata', '2024-12-06', '19:45:00', '2024-12-06', '21:00:00', '4h15m', 2100, 70),
('FL007', 'Chennai', 'Bengaluru', '2024-12-07', '08:30:00', '2024-12-07', '11:35:00', '2h05m', 1850, 100),
('FL008', 'Mumbai', 'Delhi', '2024-12-08', '15:30:00', '2024-12-08', '18:35:00', '2h05m', 2500, 90),
('FL009', 'Delhi', 'Mumbai', '2024-12-09', '14:00:00', '2024-12-09', '18:10:00', '14h10m', 2250, 120),
('FL010', 'Chennai', 'Mumbai', '2024-12-10', '16:30:00', '2024-12-10', '19:50:00', '13h20m', 2150, 45),
('FL011', 'Kolkata', 'Chennai', '2024-12-11', '06:00:00', '2024-12-11', '06:35:00', '2h35m', 2050, 120),
('FL012', 'Delhi', 'Bengaluru', '2024-12-12', '14:30:00', '2024-12-12', '15:05:00', '2h35m', 2300, 60),
('FL013', 'Mumbai', 'Delhi', '2024-12-13', '14:00:00', '2024-12-13', '14:40:00', '13h40m', 2350, 90),
('FL014', 'Chennai', 'Kolkata', '2024-12-14', '09:00:00', '2024-12-14', '07:55:00', '12h55m', 1950, 150),
('FL015', 'Bengaluru', 'Mumbai', '2024-12-15', '16:00:00', '2024-12-15', '15:20:00', '12h20m', 2450, 200),
('FL016', 'Mumbai', 'Delhi', '2024-12-16', '18:00:00', '2024-12-16', '15:50:00', '11h50m', 1800, 110),
('FL017', 'Delhi', 'Bangalore', '2024-12-17', '07:30:00', '2024-12-17', '14:05:00', '3h35m', 2100, 55),
('FL018', 'Chennai', 'Mumbai', '2024-12-18', '16:00:00', '2024-12-18', '22:35:00', '3h35m', 1850, 180),
('FL019', 'Kolkata', 'Hyderabad', '2024-12-19', '11:30:00', '2024-12-19', '14:50:00', '2h20m', 2150, 70),
('FL020', 'Bengaluru', 'Chennai', '2024-12-20', '20:00:00', '2024-12-20', '23:20:00', '2h20m', 2400, 130);


CREATE TABLE reservations (
  `reservation_id` INT NOT NULL AUTO_INCREMENT,
  `user_id` BIGINT NOT NULL,
  `flight_id` VARCHAR(50) NOT NULL,
  `passenger_count` INT NOT NULL,
  `booking_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`reservation_id`),
  FOREIGN KEY (`user_id`) REFERENCES users(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`flight_id`) REFERENCES flights(`flight_id`) ON DELETE CASCADE 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;