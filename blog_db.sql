-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2018 at 08:24 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_comment`
--

CREATE TABLE `blog_comment` (
  `c_id` int(3) NOT NULL,
  `c_email` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `c_blog_id` int(11) NOT NULL,
  `comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_comment`
--

INSERT INTO `blog_comment` (`c_id`, `c_email`, `name`, `c_blog_id`, `comments`) VALUES
(1, 'one@two.com', 'One Two', 5, 'Well, nice said!'),
(14, 'ratna@gmail.com', 'Ratna Gmail', 3, 'i AM NOT EXCITED NOW!'),
(15, 'asdf@asdg.com', 'asdfasd asdgadsg', 3, 'asdgas asga dg asdg sadcg asd gasd ga rg'),
(20, 'apple@ball.com', 'Apple Ball', 9, 'This is my comment'),
(21, 'asd@asdf.com', 'asdfasdg asdf', 9, 'asdfasgads'),
(22, 'asd@asdf.com', 'asdfasdg asdf', 9, 'asdfasgads');

-- --------------------------------------------------------

--
-- Table structure for table `blog_country`
--

CREATE TABLE `blog_country` (
  `id` int(1) NOT NULL,
  `country` enum('Nepal','Pakistan','India','China','Other') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_country`
--

INSERT INTO `blog_country` (`id`, `country`) VALUES
(1, 'Other'),
(2, 'India'),
(3, 'Pakistan');

-- --------------------------------------------------------

--
-- Table structure for table `blog_images`
--

CREATE TABLE `blog_images` (
  `id` int(6) NOT NULL,
  `path` varchar(50) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_images`
--

INSERT INTO `blog_images` (`id`, `path`, `post_id`) VALUES
(1, 'blog_images/2012-08-02 17.41.0', 22),
(2, 'blog_images/BAD MAN 060.jpeg', 21),
(4, 'blog_images/BAD MAN 047.jpeg', 23),
(5, 'blog_images/2012-08-02 17.41.02.jpg', 22),
(7, 'blog_images/2012-08-02 17.41.57.jpg', 22),
(8, 'blog_images/2012-08-02 17.28.15.jpg', 22),
(9, 'blog_images/guitar.jpg', 24);

-- --------------------------------------------------------

--
-- Table structure for table `blog_post`
--

CREATE TABLE `blog_post` (
  `blogid` int(11) NOT NULL,
  `fkuserid` int(11) NOT NULL,
  `link` varchar(100) NOT NULL,
  `heading` varchar(50) NOT NULL,
  `dateposted` date NOT NULL,
  `article` text NOT NULL,
  `tags` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_post`
--

INSERT INTO `blog_post` (`blogid`, `fkuserid`, `link`, `heading`, `dateposted`, `article`, `tags`) VALUES
(3, 1, '', 'Third Blog', '2013-07-03', 'The MMA freight train departed the CPR yard in Côte Saint-Luc[15][21] earlier in the day and changed crews at the MMA yard in Farnham.[22] The train departed Farnham and stopped at Nantes at 23:25 on July 5, 11 kilometres (6.8 mi) west of Lac-Mégantic, for another crew change. The engineer parked the train on the main line by setting the brakes and followed standard procedure by shutting down four of the five locomotives.[23] The engineer, who was the lone crew member under the MMA\'s work rules with permission from Transport Canada,[24] could not park the train on the adjacent siding because it was occupied by another freight train.[25] The Nantes siding has a derail that could have stopped the train from accidentally departing.[26] According to Transport Canada, it is unusual to leave an unattended train parked on a mainline.[27]\r\nThe engineer left the lead engine, #5017, running to keep air pressure supplied to the air brakes and also applied a number of manual hand brakes.[28] Yves Bourdon, a member of the MMA\'s Board of Directors, stated that the air brakes of all locomotives and freight cars had been activated, as well as manual hand brakes on 5 locomotives and 10 of the 73 freight cars.[29]\r\nThe engineer then departed by taxi for a local hotel, l\'Eau Berge in downtown Lac-Mégantic,[30] for the night.[31] While en route to the hotel, the engineer told the taxi driver that he felt unsafe leaving a train running while it was spitting oil and thick, black smoke. He said he wanted to call the U.S. office of the MMA (in Hermon, Maine) as they would be able to give him other directives.[32]', 'third'),
(4, 1, '', 'Blog number Four!!!', '2013-07-11', 'The MMA freight train departed the CPR yard in Côte Saint-Luc[15][21] earlier in the day and changed crews at the MMA yard in Farnham.[22] The train departed Farnham and stopped at Nantes at 23:25 on July 5, 11 kilometres (6.8 mi) west of Lac-Mégantic, for another crew change. The engineer parked the train on the main line by setting the brakes and followed standard procedure by shutting down four of the five locomotives.[23] The engineer, who was the lone crew member under the MMA\'s work rules with permission from Transport Canada,[24] could not park the train on the adjacent siding because it was occupied by another freight train.[25] The Nantes siding has a derail that could have stopped the train from accidentally departing.[26] According to Transport Canada, it is unusual to leave an unattended train parked on a mainline.[27]\r\nThe engineer left the lead engine, #5017, running to keep air pressure supplied to the air brakes and also applied a number of manual hand brakes.[28] Yves Bourdon, a member of the MMA\'s Board of Directors, stated that the air brakes of all locomotives and freight cars had been activated, as well as manual hand brakes on 5 locomotives and 10 of the 73 freight cars.[29]\r\nThe engineer then departed by taxi for a local hotel, l\'Eau Berge in downtown Lac-Mégantic,[30] for the night.[31] While en route to the hotel, the engineer told the taxi driver that he felt unsafe leaving a train running while it was spitting oil and thick, black smoke. He said he wanted to call the U.S. office of the MMA (in Hermon, Maine) as they would be able to give him other directives.[32]', ''),
(5, 1, '', 'Blog number five!', '2013-07-02', 'The MMA freight train departed the CPR yard in Côte Saint-Luc[15][21] earlier in the day and changed crews at the MMA yard in Farnham.[22] The train departed Farnham and stopped at Nantes at 23:25 on July 5, 11 kilometres (6.8 mi) west of Lac-Mégantic, for another crew change. The engineer parked the train on the main line by setting the brakes and followed standard procedure by shutting down four of the five locomotives.[23] The engineer, who was the lone crew member under the MMA\'s work rules with permission from Transport Canada,[24] could not park the train on the adjacent siding because it was occupied by another freight train.[25] The Nantes siding has a derail that could have stopped the train from accidentally departing.[26] According to Transport Canada, it is unusual to leave an unattended train parked on a mainline.[27]\r\nThe engineer left the lead engine, #5017, running to keep air pressure supplied to the air brakes and also applied a number of manual hand brakes.[28] Yves Bourdon, a member of the MMA\'s Board of Directors, stated that the air brakes of all locomotives and freight cars had been activated, as well as manual hand brakes on 5 locomotives and 10 of the 73 freight cars.[29]\r\nThe engineer then departed by taxi for a local hotel, l\'Eau Berge in downtown Lac-Mégantic,[30] for the night.[31] While en route to the hotel, the engineer told the taxi driver that he felt unsafe leaving a train running while it was spitting oil and thick, black smoke. He said he wanted to call the U.S. office of the MMA (in Hermon, Maine) as they would be able to give him other directives.[32]', 'five'),
(6, 1, '', 'Blog number six!', '2013-07-19', 'The MMA freight train departed the CPR yard in Côte Saint-Luc[15][21] earlier in the day and changed crews at the MMA yard in Farnham.[22] The train departed Farnham and stopped at Nantes at 23:25 on July 5, 11 kilometres (6.8 mi) west of Lac-Mégantic, for another crew change. The engineer parked the train on the main line by setting the brakes and followed standard procedure by shutting down four of the five locomotives.[23] The engineer, who was the lone crew member under the MMA\'s work rules with permission from Transport Canada,[24] could not park the train on the adjacent siding because it was occupied by another freight train.[25] The Nantes siding has a derail that could have stopped the train from accidentally departing.[26] According to Transport Canada, it is unusual to leave an unattended train parked on a mainline.[27]\r\nThe engineer left the lead engine, #5017, running to keep air pressure supplied to the air brakes and also applied a number of manual hand brakes.[28] Yves Bourdon, a member of the MMA\'s Board of Directors, stated that the air brakes of all locomotives and freight cars had been activated, as well as manual hand brakes on 5 locomotives and 10 of the 73 freight cars.[29]\r\nThe engineer then departed by taxi for a local hotel, l\'Eau Berge in downtown Lac-Mégantic,[30] for the night.[31] While en route to the hotel, the engineer told the taxi driver that he felt unsafe leaving a train running while it was spitting oil and thick, black smoke. He said he wanted to call the U.S. office of the MMA (in Hermon, Maine) as they would be able to give him other directives.[32]', 'six'),
(8, 2, '', 'I am no 2', '2013-07-17', '', ''),
(9, 3, '', 'User No 3', '2013-07-02', 'well, this is my first blog...not the first blog of this group, but my personal first blog. i don\'t know how i\'m gonna tell you...i can\'t play with you no more...i don\'t know how i\'m gonna do what mama told me...my friend the girl next dooor...well, this is my first blog...not the first blog of this group, but my personal first blog. i don\'t know how i\'m gonna tell you...i can\'t play with you no more...i don\'t know how i\'m gonna do what mama told me...my friend the girl next dooor...well, this is my first blog...not the first blog of this group, but my personal first blog. i don\'t know how i\'m gonna tell you...i can\'t play with you no more...i don\'t know how i\'m gonna do what mama told me...my friend the girl next dooor...well, this is my first blog...not the first blog of this group, but my personal first blog. i don\'t know how i\'m gonna tell you...i can\'t play with you no more...i don\'t know how i\'m gonna do what mama told me...my friend the girl next dooor...well, this is my first blog...not the first blog of this group, but my personal first blog. i don\'t know how i\'m gonna tell you...i can\'t play with you no more...i don\'t know how i\'m gonna do what mama told me...my friend the girl next dooor...well, this is my first blog...not the first blog of this group, but my personal first blog. i don\'t know how i\'m gonna tell you...i can\'t play with you no more...i don\'t know how i\'m gonna do what mama told me...my friend the girl next dooor...well, this is my first blog...not the first blog of this group, but my personal first blog. i don\'t know how i\'m gonna tell you...i can\'t play with you no more...i don\'t know how i\'m gonna do what mama told me...my friend the girl next dooor...', ''),
(13, 2, '', 'With all securities', '0000-00-00', '     safdads', ''),
(16, 2, '', 'Secure blog post', '0000-00-00', 'This is a secure post.\r\n<script>alert(\"Insecure! Insecure!\");</script>', ''),
(19, 5, '', 'Blog about Bad Man', '0000-00-00', 'This blog is about Bad Man, who is a real bad man and does real bad things.', ''),
(20, 2, '', '<script>alert(\"XSS); </script>', '0000-00-00', 'Is this fine now??', ''),
(21, 1, '', 'Raj Kumar', '0000-00-00', ' My name is Raj Kumar. I study in class 6. I live in Kathmandu. I like to eat banana. My mommy and papa love me a lot. And here I have added one image as well!', ''),
(22, 1, '', 'Blog with Image', '0000-00-00', '    Now I\'m creating this blog with images.    ', ''),
(23, 1, '', 'Another post with an image', '0000-00-00', ' Well, I\'m tired of creating posts here because I\'m the only reader of my blog for now... ', ''),
(24, 3, '', 'Hee haa haa!!', '0000-00-00', ' Something somethingSomething somethingSomething somethingSomething somethingSomething something\r\nSomething something\r\nSomething something\r\nSomething somethingSomething something\r\nSomething something\r\nSomething somethingSomething something\r\nSomething something\r\nSomething somethingSomething something\r\nSomething something\r\nSomething somethingSomething something\r\n\r\nSomething something\r\nSomething somethingSomething something\r\nSomething something\r\nSomething something\r\nSomething something\r\nSomething somethingSomething something\r\nSomething somethingSomething somethingSomething something\r\nSomething somethingSomething something\r\nSomething something ', '');

-- --------------------------------------------------------

--
-- Table structure for table `blog_user`
--

CREATE TABLE `blog_user` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(22) NOT NULL,
  `lastname` varchar(22) NOT NULL,
  `username` varchar(22) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(512) NOT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_user`
--

INSERT INTO `blog_user` (`user_id`, `firstname`, `lastname`, `username`, `email`, `password`, `datecreated`) VALUES
(1, 'Raj', 'Kumar', 'rajkumar', 'raj@kumar.com', 'rajkumar', '2013-07-15 18:15:00'),
(2, 'One', 'Two', 'onetwo', 'one@two.com', 'three', '2013-07-18 13:12:05'),
(3, 'three', 'four', 'threefour', 'three@four.com', 'threefour', '2013-07-18 13:12:05'),
(4, 'Joe', 'Satriani', 'joesatriani', 'joe@satriani.com', 'satrianijoe', '2013-07-19 10:11:19'),
(5, 'Bad', 'Man', 'badman', 'bad@man.com', 'manbad', '2013-07-24 18:27:43');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `profileid` int(11) NOT NULL,
  `fkuserid` int(11) NOT NULL,
  `profilepic` varchar(100) NOT NULL,
  `dateofbirth` date NOT NULL,
  `sex` varchar(6) NOT NULL,
  `address` varchar(22) NOT NULL,
  `country` int(11) NOT NULL,
  `contactno` int(10) NOT NULL,
  `shortbio` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`profileid`, `fkuserid`, `profilepic`, `dateofbirth`, `sex`, `address`, `country`, `contactno`, `shortbio`) VALUES
(1, 1, '', '2003-07-08', 'Male', 'Kathmandu', 1, 345, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_comment`
--
ALTER TABLE `blog_comment`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `c_blog_id` (`c_blog_id`);

--
-- Indexes for table `blog_country`
--
ALTER TABLE `blog_country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_images`
--
ALTER TABLE `blog_images`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `path` (`path`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `path_2` (`path`);

--
-- Indexes for table `blog_post`
--
ALTER TABLE `blog_post`
  ADD PRIMARY KEY (`blogid`),
  ADD UNIQUE KEY `heading` (`heading`),
  ADD KEY `fkuserid` (`fkuserid`);

--
-- Indexes for table `blog_user`
--
ALTER TABLE `blog_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`,`email`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`profileid`),
  ADD UNIQUE KEY `contactno` (`contactno`),
  ADD KEY `fkuserid` (`fkuserid`),
  ADD KEY `fkuserid_2` (`fkuserid`),
  ADD KEY `country` (`country`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog_comment`
--
ALTER TABLE `blog_comment`
  MODIFY `c_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `blog_country`
--
ALTER TABLE `blog_country`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `blog_images`
--
ALTER TABLE `blog_images`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `blog_post`
--
ALTER TABLE `blog_post`
  MODIFY `blogid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `blog_user`
--
ALTER TABLE `blog_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `profileid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog_comment`
--
ALTER TABLE `blog_comment`
  ADD CONSTRAINT `blog_comment_ibfk_1` FOREIGN KEY (`c_blog_id`) REFERENCES `blog_post` (`blogid`);

--
-- Constraints for table `blog_images`
--
ALTER TABLE `blog_images`
  ADD CONSTRAINT `blog_images_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `blog_post` (`blogid`);

--
-- Constraints for table `blog_post`
--
ALTER TABLE `blog_post`
  ADD CONSTRAINT `blog_post_ibfk_1` FOREIGN KEY (`fkuserid`) REFERENCES `blog_user` (`user_id`);

--
-- Constraints for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD CONSTRAINT `user_profile_ibfk_1` FOREIGN KEY (`country`) REFERENCES `blog_country` (`id`),
  ADD CONSTRAINT `user_profile_ibfk_2` FOREIGN KEY (`fkuserid`) REFERENCES `blog_user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
