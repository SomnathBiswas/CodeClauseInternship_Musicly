-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2023 at 06:06 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `musicly`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` int(5) NOT NULL,
  `title` varchar(30) NOT NULL,
  `year` int(4) NOT NULL,
  `cover` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `title`, `year`, `cover`) VALUES
(1, 'Karthik Calling Karthik', 2010, './uploads/albumCover/1686979902_648d453e246c0.jpeg'),
(2, 'Khatta Meetha', 2010, './uploads/albumCover/1686979976_648d458896212.jpeg'),
(3, 'Kites', 2010, './uploads/albumCover/1686985981_648d5cfd19793.jpeg'),
(5, 'Lafangey Parindey', 2010, './uploads/albumCover/1687266679_6491a577a6896.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `album_track`
--

CREATE TABLE `album_track` (
  `id` int(5) NOT NULL,
  `album_id` int(5) NOT NULL,
  `track_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `album_track`
--

INSERT INTO `album_track` (`id`, `album_id`, `track_id`) VALUES
(2, 1, 4),
(3, 2, 5),
(4, 2, 6),
(5, 3, 7),
(6, 3, 8),
(7, 3, 9),
(8, 5, 10),
(10, 5, 12);

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `id` int(5) NOT NULL,
  `name` varchar(30) NOT NULL,
  `cover` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`id`, `name`, `cover`) VALUES
(1, 'Shankar Mahadevan', './uploads/artistCover/1686981282_648d4aa2c21d5.jpeg'),
(2, 'Kunal Ganajawala', './uploads/artistCover/1686985753_648d5c1914a6a.jpeg'),
(3, 'K K', './uploads/artistCover/1686985883_648d5c9be6dc1.jpeg'),
(4, 'Rajesh Roshan', './uploads/artistCover/1686986113_648d5d812be7e.jpeg'),
(8, 'Mohit Chauhan', './uploads/artistCover/1687267316_6491a7f452220.jpeg'),
(9, 'Shilpa Rao', './uploads/artistCover/1687280541_6491db9d4d750.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `artist_track`
--

CREATE TABLE `artist_track` (
  `id` int(5) NOT NULL,
  `artist_id` int(5) NOT NULL,
  `track_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artist_track`
--

INSERT INTO `artist_track` (`id`, `artist_id`, `track_id`) VALUES
(2, 1, 4),
(3, 2, 5),
(4, 3, 6),
(5, 3, 7),
(6, 4, 8),
(7, 3, 9),
(8, 8, 10),
(10, 9, 12);

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `id` int(5) NOT NULL,
  `title` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id`, `title`) VALUES
(1, 'Bollywood'),
(3, 'House'),
(4, 'Hip Hop'),
(5, 'Dance'),
(6, 'Club'),
(7, 'LoFi'),
(8, 'Remix'),
(9, 'Trance');

-- --------------------------------------------------------

--
-- Table structure for table `genre_track`
--

CREATE TABLE `genre_track` (
  `id` int(5) NOT NULL,
  `genre_id` int(5) NOT NULL,
  `track_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genre_track`
--

INSERT INTO `genre_track` (`id`, `genre_id`, `track_id`) VALUES
(1, 1, 4),
(2, 1, 5),
(3, 1, 6),
(4, 1, 7),
(5, 1, 8),
(6, 1, 9),
(7, 1, 10),
(9, 1, 12);

-- --------------------------------------------------------

--
-- Table structure for table `playlists`
--

CREATE TABLE `playlists` (
  `id` int(5) NOT NULL,
  `title` varchar(30) NOT NULL,
  `cover` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `playlists`
--

INSERT INTO `playlists` (`id`, `title`, `cover`) VALUES
(10, 'My Favorite Playlist', './uploads/trackCover/1686985336_648d5a78309c3.jpeg'),
(23, 'just checking', './uploads/trackCover/1686985918_648d5cbe8ffe9.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `playlist_track`
--

CREATE TABLE `playlist_track` (
  `id` int(5) NOT NULL,
  `playlist_id` int(5) NOT NULL,
  `track_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `playlist_track`
--

INSERT INTO `playlist_track` (`id`, `playlist_id`, `track_id`) VALUES
(21, 10, 6),
(58, 10, 10),
(63, 10, 9),
(64, 10, 4),
(65, 23, 10),
(66, 23, 9),
(68, 23, 6);

-- --------------------------------------------------------

--
-- Table structure for table `playlist_user`
--

CREATE TABLE `playlist_user` (
  `id` int(5) NOT NULL,
  `playlist_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `playlist_user`
--

INSERT INTO `playlist_user` (`id`, `playlist_id`, `user_id`) VALUES
(10, 10, 6),
(20, 23, 6);

-- --------------------------------------------------------

--
-- Table structure for table `tracks`
--

CREATE TABLE `tracks` (
  `id` int(5) NOT NULL,
  `title` varchar(30) NOT NULL,
  `year` int(4) NOT NULL,
  `genre` varchar(20) NOT NULL,
  `url` varchar(255) NOT NULL,
  `cover` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tracks`
--

INSERT INTO `tracks` (`id`, `title`, `year`, `genre`, `url`, `cover`) VALUES
(4, 'Uff Teri Adaa', 2010, '1', './uploads/tracks/1686985336_648d5a7830b04.mp3', './uploads/trackCover/1686985336_648d5a78309c3.jpeg'),
(5, 'Nana Chi Taang', 2010, '1', './uploads/tracks/1686985789_648d5c3de08aa.mp3', './uploads/trackCover/1686985789_648d5c3de0765.jpeg'),
(6, 'Sajde', 2010, '1', './uploads/tracks/1686985918_648d5cbe9013f.mp3', './uploads/trackCover/1686985918_648d5cbe8ffe9.jpeg'),
(7, 'Dil Kyun Yeh Mera', 2010, '1', './uploads/tracks/1686986031_648d5d2fc1d7d.mp3', './uploads/trackCover/1686986031_648d5d2fc1bdd.jpeg'),
(8, 'Fire', 2010, '1', './uploads/tracks/1686986142_648d5d9e9fc74.mp3', './uploads/trackCover/1686986142_648d5d9e9f916.jpeg'),
(9, 'Zindagi Do Pal Ki', 2010, '1', './uploads/tracks/1686986179_648d5dc3b2a73.mp3', './uploads/trackCover/1686986179_648d5dc3b2925.jpeg'),
(10, 'Man Lafanga', 2010, '1', './uploads/tracks/1687280429_6491db2dd8432.mp3', './uploads/trackCover/1687268609_6491ad0162c36.jpeg'),
(12, 'Nain Parindey', 2010, '1', './uploads/tracks/1687280817_6491dcb132d0e.mp3', './uploads/trackCover/1687280817_6491dcb132b4b.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(4) NOT NULL,
  `fname` varchar(15) NOT NULL,
  `lname` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`, `is_admin`, `created_at`) VALUES
(5, 'Super', 'Admin', 'superadmin@musicly.com', '$2y$10$Ql7YqNjfmtyP6OvAxl7Sx.OTnUkXV.k9K80bOhmkCXVIM.7mZN6OO', 1, '2023-06-20 17:26:52'),
(6, 'Anand', 'Kumar', 'anand@example.com', '$2y$10$XLEETvEkYDylbpQFbx5i0eVrrhYYp8/xdQlGKPytReobfgPWWk0KW', 0, '2023-06-20 17:45:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `album_track`
--
ALTER TABLE `album_track`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_album_1` (`album_id`),
  ADD KEY `fk_track_3` (`track_id`);

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `artist_track`
--
ALTER TABLE `artist_track`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_artist_1` (`artist_id`),
  ADD KEY `fk_track_2` (`track_id`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genre_track`
--
ALTER TABLE `genre_track`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_genre_1` (`genre_id`),
  ADD KEY `fk_track_4` (`track_id`) USING BTREE;

--
-- Indexes for table `playlists`
--
ALTER TABLE `playlists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `playlist_track`
--
ALTER TABLE `playlist_track`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_playlist_1` (`playlist_id`),
  ADD KEY `fk_track_1` (`track_id`);

--
-- Indexes for table `playlist_user`
--
ALTER TABLE `playlist_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_playlist_2` (`playlist_id`),
  ADD KEY `fk_user_id_2` (`user_id`);

--
-- Indexes for table `tracks`
--
ALTER TABLE `tracks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `album_track`
--
ALTER TABLE `album_track`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `artist_track`
--
ALTER TABLE `artist_track`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `genre_track`
--
ALTER TABLE `genre_track`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `playlists`
--
ALTER TABLE `playlists`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `playlist_track`
--
ALTER TABLE `playlist_track`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `playlist_user`
--
ALTER TABLE `playlist_user`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tracks`
--
ALTER TABLE `tracks`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `album_track`
--
ALTER TABLE `album_track`
  ADD CONSTRAINT `fk_album_1` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_track_3` FOREIGN KEY (`track_id`) REFERENCES `tracks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `artist_track`
--
ALTER TABLE `artist_track`
  ADD CONSTRAINT `fk_artist_1` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_track_2` FOREIGN KEY (`track_id`) REFERENCES `tracks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `genre_track`
--
ALTER TABLE `genre_track`
  ADD CONSTRAINT `fk_genre_1` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `genre_track_ibfk_1` FOREIGN KEY (`track_id`) REFERENCES `tracks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `playlist_track`
--
ALTER TABLE `playlist_track`
  ADD CONSTRAINT `fk_playlist_1` FOREIGN KEY (`playlist_id`) REFERENCES `playlists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_track_1` FOREIGN KEY (`track_id`) REFERENCES `tracks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `playlist_user`
--
ALTER TABLE `playlist_user`
  ADD CONSTRAINT `fk_playlist_2` FOREIGN KEY (`playlist_id`) REFERENCES `playlists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_id_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
