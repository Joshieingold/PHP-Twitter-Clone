-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Generation Time: Nov 19, 2026 at 02:47 PM
-- Server version: 11.8.9-MariaDB-ubu2404-log
-- PHP Version: 8.3.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Y_JoshuaLynch`
--

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE `follows` (
  `follow_id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 CHECKSUM=1 COLLATE=latin1_swedish_ci DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `follows`
--

INSERT INTO `follows` (`follow_id`, `from_id`, `to_id`) VALUES
(5, 22, 23),
(6, 22, 26);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `like_id` int(11) NOT NULL,
  `tweet_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tweets`
--

CREATE TABLE `tweets` (
  `tweet_id` int(11) NOT NULL,
  `tweet_text` varchar(280) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `original_tweet_id` int(11) NOT NULL DEFAULT 0,
  `reply_to_tweet_id` int(11) NOT NULL DEFAULT 0,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tweets`
--

INSERT INTO `tweets` (`tweet_id`, `tweet_text`, `user_id`, `original_tweet_id`, `reply_to_tweet_id`, `date_created`) VALUES
(14, 'Y is by far the best way to reach the most influential people on Earth', 23, 0, 0, '2024-06-15 03:00:00'),
(15, 'Bad Boys: Ride or Die is a great movie', 24, 0, 0, '2024-06-16 03:00:00'),
(16, 'Joe Biden keeps giving his friends jobs. He\'s like the Adam Sandler of Presidents.', 22, 0, 0, '2024-06-18 03:00:00'),
(17, 'I love that Joe Biden has like 3 loser friends and he keeps giving them jobs. He\'s like the Adam Sandler of Presidents.', 23, 16, 0, '2024-06-19 03:00:00'),
(18, 'I opened a new box of cereal before finishing the old one.\r\nMy wife doesn\'t know.\r\nI\'m living on borrowed time.', 22, 0, 0, '2024-06-19 14:44:31'),
(19, 'Wow, this website is way better than those other ones.', 26, 0, 0, '2024-06-19 03:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `screen_name` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `address` varchar(200) NOT NULL,
  `province` varchar(50) NOT NULL,
  `postal_code` varchar(7) NOT NULL,
  `contact_number` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `url` varchar(50) NOT NULL,
  `description` varchar(160) NOT NULL,
  `location` varchar(50) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_pic` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `screen_name`, `password`, `address`, `province`, `postal_code`, `contact_number`, `email`, `url`, `description`, `location`, `date_created`, `profile_pic`) VALUES
(22, 'Nick', 'Taggart', 'nick', '$2y$10$QVgwnt476W.wv72MAkI/eOOp8Tj92/TgdAY0IGISHPX3r4IPeM76O', '26 Duffie Drive', 'New Brunswick', 'E3A 0R6', '5065551212', 'nick.taggart@nbcc.ca', '', '', 'Fredericton', '2024-06-19 14:12:31', NULL),
(23, 'Elon', 'Musk', 'TheBoss', 'asdf', '123 Main St', 'California', '90210', '506-444-4444', 'elon@y.com', 'www.y.com', '', 'Fredericton', '2024-06-20 03:00:00', NULL),
(24, 'Will', 'Smith', 'willy', 'password', '123 South Miami Blvd', 'Florida', '12345', '555-555-1212', 'will@gettinjiggywitit.com', '', '', NULL, '2024-06-20 03:00:00', NULL),
(25, 'Chris', 'Hadfield', 'cmdr_hadfield', 'password', 'ISS Space Station', 'Ontario', 'A1A1A1', '555-555-1525', 'chris@nasa.gov', '', '', NULL, '2024-06-19 14:27:05', NULL),
(26, 'Charli', 'D\'Amelio', 'charli', 'password', 'asdf', 'asdf', 'asdf', 'asdf', 'asdf', 'asdf', '', NULL, '2024-06-20 03:00:00', NULL),
(27, 'Josh', 'Lynch', 'joshieingold', '$2y$12$sbP2t/N5XPq2hCKdwbIN8.hNmH9ZE4XcqotbqCcVth13pHxl/85OK', '234 britain st', 'NB', 'E2L 1X8', '15062716894', 'joshlynch2001@gmail.com', '', '', 'SJ', '2026-11-18 07:25:00', NULL),
(28, 'Edilyn', 'Aglobo', 'ItzPumpkz', '$2y$12$y8yDCBtD9vIRg7NGKlb1ie5fjxZ4B.qBR7MZSC.kM4uSAjr0jXtsG', '11 Park Ave', 'NB', 'E2J 1R2', '15062716894', 'edilynaglobo@gmail.com', '', '', 'SJ', '2026-11-18 07:27:22', NULL),
(29, 'Sarah', 'Mattson', 'peaches', '$2y$12$CWtF4UIKufeuKu7bgarS7OCez4.k8xRARpXEUZVEMRZvUDXdegdCG', '21 Skyline Road', 'NB', 'E2J3X6', '15067217712', 'peaches@bunnies.com', '', '', 'Saint John', '2026-11-18 13:04:07', NULL),
(30, 'Rory', 'Hughes', 'TheHacker', '$2y$12$Ch6zRPHeeieJQETg5eIIqOg1kIBB8Wj8wvEgfYwyixE3Izubl3nn6', '69 douglas ave', 'NB', 'E2L1X8', '15062716894', 'rory@gmail.com', '', '', 'SJ', '2026-11-19 13:06:18', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`follow_id`),
  ADD KEY `FK_follows` (`from_id`),
  ADD KEY `FK_follows2` (`to_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`like_id`),
  ADD KEY `FK_tweet_id_idx` (`tweet_id`),
  ADD KEY `FK_user_id_idx` (`user_id`);

--
-- Indexes for table `tweets`
--
ALTER TABLE `tweets`
  ADD PRIMARY KEY (`tweet_id`),
  ADD KEY `FK_tweets` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `follows`
--
ALTER TABLE `follows`
  MODIFY `follow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tweets`
--
ALTER TABLE `tweets`
  MODIFY `tweet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `follows`
--
ALTER TABLE `follows`
  ADD CONSTRAINT `FK_follows` FOREIGN KEY (`from_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `FK_follows2` FOREIGN KEY (`to_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `FK_tweet_id` FOREIGN KEY (`tweet_id`) REFERENCES `tweets` (`tweet_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tweets`
--
ALTER TABLE `tweets`
  ADD CONSTRAINT `FK_tweets` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
