-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2017 at 02:53 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fyp`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookmark`
--

CREATE TABLE IF NOT EXISTS `bookmark` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `video_id` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookmark`
--

INSERT INTO `bookmark` (`id`, `username`, `video_id`) VALUES
(1, 'asd', 'iA4SIF0KsDc'),
(2, 'asd', 'AnVgcud_q-o'),
(3, 'pp', 'MhkGQAoc7bc'),
(4, 'mm', 'Q0HFBy2BtfA'),
(5, 'mm', 'pWbMrx5rVBE'),
(6, 'mm', 'H5JubkIy_p8'),
(7, 'mm', '9Jry5-82I68'),
(8, 'mm', 'MEOEjipxzI8'),
(9, 'asd', 'MhkGQAoc7bc'),
(10, 'asd', 'JHE7ZsVRc_U'),
(11, 'mm', '5-CyAA1NuB8'),
(12, 'mm', '1Epqhp6dceU'),
(13, 'asd', 'Ik7Kr8fRIHE'),
(14, 'mm', 'ir2TmoRDNHY'),
(15, 'mm', '-u-j7uqU7sI'),
(16, 'pp', 'mjjLq43miYY'),
(17, 'mm', 'JPT3bFIwJYA'),
(18, 'asd', 'cbaWHXSsSCY'),
(19, 'gayanga908@gmail.com', 'M6lYob8STMI'),
(20, 'gayanga908@gmail.com', 'A71aqufiNtQ'),
(21, 'asd', 'M6lYob8STMI');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`, `firstName`, `lastName`) VALUES
(1, 'tharindu', 'asd', '', ''),
(2, 'asd', '7815696ecbf1c96e6894b779456d330e', '', ''),
(3, 'qwe', '76d80224611fc919a5d54f0ff9fba446', 'qwe', 'qwe'),
(4, 'eee', 'd2f2297d6e829cd3493aa7de4416a18f', 'eee', 'eee'),
(5, 'lll', 'bf083d4ab960620b645557217dd59a49', 'lll', 'lll'),
(6, 'i', '865c0c0b4ab0e063e5caa3387c1a8741', 'i', 'i'),
(7, 'oo', 'e47ca7a09cf6781e29634502345930a7', 'oo', 'oo'),
(8, 'kk', 'dc468c70fb574ebd07287b38d0d0676d', 'kk', 'kk'),
(9, 'nn', 'eab71244afb687f16d8c4f5ee9d6ef0e', 'nn', 'nn'),
(10, 'mm', 'b3cd915d758008bd19d0f2428fbb354a', 'mm', 'mm'),
(11, 'pp', 'c483f6ce851c9ecd9fb835ff7551737c', 'pp', 'pp'),
(12, 'jj', 'bf2bc2545a4a5f5683d9ef3ed0d977e0', 'jj', 'jj'),
(13, 'gayanga', '202cb962ac59075b964b07152d234b70', 'tharindu', 'gayanga'),
(14, 'gayanga908@gmail.com', 'a8f5f167f44f4964e6c998dee827110c', 'ws', 'sd'),
(15, 'asd@asd.com', '202cb962ac59075b964b07152d234b70', 'assd', 'as');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE IF NOT EXISTS `videos` (
  `id` int(11) NOT NULL,
  `video_id` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `video_description` varchar(255) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `score_und` double NOT NULL,
  `count_und` int(10) NOT NULL,
  `score_vid` double NOT NULL,
  `count_vid` int(11) NOT NULL,
  `score_aud` double NOT NULL,
  `count_aud` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `video_id`, `video`, `video_description`, `thumb`, `score_und`, `count_und`, `score_vid`, `count_vid`, `score_aud`, `count_aud`) VALUES
(1, 'iA4SIF0KsDc', 'How to combine photos in Photoshop with Layer Masks, seamless blending technique', 'In this Photoshop tutorial, Colin Smith shows you how to blend photos together seamlessly with masks. This is the foundation of compositing and collaging in ...', 'https://i.ytimg.com/vi/iA4SIF0KsDc/default.jpg', 5, 5, 0, 0, 0, 0),
(2, 'AnVgcud_q-o', 'How To Use Layer Masks To Blend 2 Photos: Photoshop Tutorial', 'Learn Seascape photography from the ground up at: http://www.seascapephotomastery.com Knowing how to use Layer Masks in Photoshop is one of the most ...', 'https://i.ytimg.com/vi/AnVgcud_q-o/default.jpg', 4.98, 3, 0, 0, 0, 0),
(3, 'MhkGQAoc7bc', 'REACT JS TUTORIAL #1 - Reactjs Javascript Introduction & Workspace Setup', 'This React JS Course will help you get quickly up to pace with React.js development. React is an AMAZING Javascript framework that allows you to build ...', 'https://i.ytimg.com/vi/MhkGQAoc7bc/default.jpg', 4.995, 7, 0, 0, 0, 0),
(4, 'Q0HFBy2BtfA', 'How to install Node.JS and setup npm (Node Package Manager)', 'Quick installation and setup node.js npm (node ??package manager) to install our packages needed for our project. Node.JS: npmjs.org NPM: nodejs.org ...', 'https://i.ytimg.com/vi/Q0HFBy2BtfA/default.jpg', 4.82, 3, 0, 0, 0, 0),
(5, 'pWbMrx5rVBE', 'MongoDB In 30 Minutes', 'In this video we will dive into the MongoDB NoSQL database and look at the fundamentals and the syntax to create, read, update and delete documents/data 10 ...', 'https://i.ytimg.com/vi/pWbMrx5rVBE/default.jpg', 4.82, 1, 0, 0, 0, 0),
(6, 'H5JubkIy_p8', 'Data structures: Binary Tree', 'See complete series on data structures here: http://www.youtube.com/playlist?list=PL2_aWCzGMAwI3W_JlcBbtYTwiQSsOTa6P In this lesson, we have ...', 'https://i.ytimg.com/vi/H5JubkIy_p8/default.jpg', 4.985, 5, 0, 0, 0, 0),
(7, '9Jry5-82I68', '5. Binary Search Trees, BST Sort', 'MIT 6.006 Introduction to Algorithms, Fall 2011 View the complete course: http://ocw.mit.edu/6-006F11 Instructor: Srini Devadas License: Creative Commons ...', 'https://i.ytimg.com/vi/9Jry5-82I68/default.jpg', 4.5, 2, 0, 0, 0, 0),
(8, 'MEOEjipxzI8', 'Chapter 15 Binary Tree in Data Structure Hindi', 'Like, Comments, Share and SUBSCRIBE.', 'https://i.ytimg.com/vi/MEOEjipxzI8/default.jpg', 4.1675, 2, 0, 0, 0, 0),
(9, 'JHE7ZsVRc_U', 'Install Laravel 5 in Windows Environment', 'This video will explain how to install Laravel 5 in Windows Environment. Finally we will have a folder called "laravel" on our Desktop, if you want you can rename ...', 'https://i.ytimg.com/vi/JHE7ZsVRc_U/default.jpg', 1.25, 1, 0, 0, 0, 0),
(10, '5-CyAA1NuB8', '5 Essential Video Effects every editor should know! (Adobe Premiere Pro CC Tutorial)', 'Check out my favorite gear: https://kit.com/JustinOdisho In this Adobe Premiere Pro CC 2017 Tutorial, I will demonstrate 5 essential video editing effects and ...', 'https://i.ytimg.com/vi/5-CyAA1NuB8/default.jpg', 3.75, 2, 0, 0, 0, 0),
(11, '1Epqhp6dceU', 'Fast Forward Effect | Adobe Premiere Pro Tutorial', 'Fast Forward Effect | Adobe Premiere Pro Tutorial A lot of you asked me how I do the fast forward effect in my other videos so I made a short tutorial how you get ...', 'https://i.ytimg.com/vi/1Epqhp6dceU/default.jpg', 3.9275, 2, 0, 0, 0, 0),
(12, 'Ik7Kr8fRIHE', '5 Blend Modes In Photoshop That Will Beautifully Enhance Your Photos', 'Blend Modes in Photoshop make our lives infinitely easier, and our images that much more beautiful. With the click of a button, they can change the entire feel ...', 'https://i.ytimg.com/vi/Ik7Kr8fRIHE/default.jpg', 4.8525, 2, 0, 0, 0, 0),
(13, 'ir2TmoRDNHY', 'Advanced Cinematic Color Grading Tutorial - DSLR Filmmaking', 'Store: http://www.creatrix-visuals.com/ Support us on Patreon (+Rewards): https://www.patreon.com/CreatrixVisuals?ty=h Twitter: ...', 'https://i.ytimg.com/vi/ir2TmoRDNHY/default.jpg', 5, 7, 0, 0, 0, 0),
(14, '-u-j7uqU7sI', 'Node.js Tutorial for Beginners - 1 - Installing on Windows', 'Facebook - https://www.facebook.com/TheNewBoston-464114846956315/ GitHub - https://github.com/buckyroberts Google+ ...', 'https://i.ytimg.com/vi/-u-j7uqU7sI/default.jpg', 4.785, 3, 0, 0, 0, 0),
(15, 'mjjLq43miYY', 'Build an Ionic App in 45 minutes (or less)', 'From FITC Web Unleashed 2015. zen.digital CEO Daniel Zen shows how to creates a simple ToDo app from scratch using the Ionic Framework Slides available ...', 'https://i.ytimg.com/vi/mjjLq43miYY/default.jpg', 4.5, 1, 0, 0, 0, 0),
(16, 'JPT3bFIwJYA', 'ReactJS Basics - #1 What is React?', 'This ReactJS Tutorial dives into the Question what ReactJS actually is and why you might want to use it. It is Part of the ReactJS Basics Series. Full Source Code ...', 'https://i.ytimg.com/vi/JPT3bFIwJYA/default.jpg', 4.6925, 2, 0, 0, 0, 0),
(17, 'cbaWHXSsSCY', 'Binary Tree Traversal in (Hindi, English) with Example', 'Complete Lecture on Binary Tree Traversal - Inorder, PreOrder and PostOrder Traversal with examples for students of IP University Delhi and Other Universities, ...', 'https://i.ytimg.com/vi/cbaWHXSsSCY/default.jpg', 4.7225, 2, 0, 0, 0, 0),
(18, 'M6lYob8STMI', 'Java Binary Search Tree', 'Get the Code Here: http://goo.gl/Zuatn Welcome to my tutorial on the Binary Tree in Java. On average a tree is more efficient then other data structures if you ...', 'https://i.ytimg.com/vi/M6lYob8STMI/default.jpg', 5, 10, 4.3333333333333, 1, 0, 0),
(19, 'A71aqufiNtQ', 'React JS Crash Course', 'In this video we will cover the fundamentals for React.js including the following... Create-react-app CLI ReactJS Components State & Properties Event Handling ...', 'https://i.ytimg.com/vi/A71aqufiNtQ/default.jpg', 5, 5, 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookmark`
--
ALTER TABLE `bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookmark`
--
ALTER TABLE `bookmark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
