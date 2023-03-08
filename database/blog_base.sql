-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 08, 2023 at 08:14 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog_base`
--

-- --------------------------------------------------------

--
-- Table structure for table `ad_displays`
--

CREATE TABLE `ad_displays` (
  `adID` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `uploaded_on` date NOT NULL DEFAULT current_timestamp(),
  `price_paid` int(11) NOT NULL DEFAULT 50
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ad_displays`
--

INSERT INTO `ad_displays` (`adID`, `file_name`, `uploaded_on`, `price_paid`) VALUES
(1, 'coffee.jpg', '2022-11-25', 50),
(2, 'fake ad.jpg', '2022-11-25', 50);

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `postID` int(11) NOT NULL,
  `postTitle` varchar(225) NOT NULL,
  `postDesc` tinytext NOT NULL,
  `postCont` longblob NOT NULL,
  `postDate` datetime NOT NULL DEFAULT current_timestamp(),
  `is_approved` tinyint(1) NOT NULL,
  `clickNumber` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`postID`, `postTitle`, `postDesc`, `postCont`, `postDate`, `is_approved`, `clickNumber`) VALUES
(8, 'article 01', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sed risus pretium quam vulputate. Ut tristique et egestas quis ipsum suspendisse ultrices. Suspendisse ultrices gravida dictum f', 0x3c703e4c6f72656d20697073756d20646f6c6f722073697420616d65742c20636f6e73656374657475722061646970697363696e6720656c69742c2073656420646f20656975736d6f642074656d706f7220696e6369646964756e74207574206c61626f726520657420646f6c6f7265206d61676e6120616c697175612e20536564207269737573207072657469756d207175616d2076756c7075746174652e205574207472697374697175652065742065676573746173207175697320697073756d2073757370656e646973736520756c7472696365732e2053757370656e646973736520756c74726963657320677261766964612064696374756d20667573636520757420706c616365726174206f726369206e756c6c612070656c6c656e7465737175652e204e756e6320636f6e73657175617420696e74657264756d207661726975732073697420616d6574206d61747469732076756c7075746174652e204d7573206d617572697320766974616520756c74726963696573206c656f20696e74656765722e2053656d20696e7465676572207669746165206a7573746f2065676574206d61676e61206665726d656e74756d20696163756c69732065752e2056697665727261206d617572697320696e20616c697175616d2073656d2e204e756e632070756c76696e61722073617069656e206574206c6967756c6120756c6c616d636f72706572206d616c6573756164612070726f696e2e20456c656d656e74756d206e6962682074656c6c7573206d6f6c6573746965206e756e63206e6f6e20626c616e646974206d6173736120656e696d2e20536f63696973206e61746f7175652070656e617469627573206574206d61676e6973206469732070617274757269656e742e3c2f703e0d0a, '2022-11-28 15:19:36', 1, 271),
(9, 'article 02', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sed risus pretium quam vulputate. Ut tristique et egestas quis ipsum suspendisse ultrices. Suspendisse ultrices gravida dictum f', 0x3c703e4c6f72656d20697073756d20646f6c6f722073697420616d65742c20636f6e73656374657475722061646970697363696e6720656c69742c2073656420646f20656975736d6f642074656d706f7220696e6369646964756e74207574206c61626f726520657420646f6c6f7265206d61676e6120616c697175612e20536564207269737573207072657469756d207175616d2076756c7075746174652e205574207472697374697175652065742065676573746173207175697320697073756d2073757370656e646973736520756c7472696365732e2053757370656e646973736520756c74726963657320677261766964612064696374756d20667573636520757420706c616365726174206f726369206e756c6c612070656c6c656e7465737175652e204e756e6320636f6e73657175617420696e74657264756d207661726975732073697420616d6574206d61747469732076756c7075746174652e204d7573206d617572697320766974616520756c74726963696573206c656f20696e74656765722e2053656d20696e7465676572207669746165206a7573746f2065676574206d61676e61206665726d656e74756d20696163756c69732065752e2056697665727261206d617572697320696e20616c697175616d2073656d2e204e756e632070756c76696e61722073617069656e206574206c6967756c6120756c6c616d636f72706572206d616c6573756164612070726f696e2e20456c656d656e74756d206e6962682074656c6c7573206d6f6c6573746965206e756e63206e6f6e20626c616e646974206d6173736120656e696d2e20536f63696973206e61746f7175652070656e617469627573206574206d61676e6973206469732070617274757269656e742e3c2f703e0d0a, '2022-11-28 15:19:59', 1, 26),
(10, 'article 03', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sed risus pretium quam vulputate. Ut tristique et egestas quis ipsum suspendisse ultrices. Suspendisse ultrices gravida dictum f', 0x3c703e4c6f72656d20697073756d20646f6c6f722073697420616d65742c20636f6e73656374657475722061646970697363696e6720656c69742c2073656420646f20656975736d6f642074656d706f7220696e6369646964756e74207574206c61626f726520657420646f6c6f7265206d61676e6120616c697175612e20536564207269737573207072657469756d207175616d2076756c7075746174652e205574207472697374697175652065742065676573746173207175697320697073756d2073757370656e646973736520756c7472696365732e2053757370656e646973736520756c74726963657320677261766964612064696374756d20667573636520757420706c616365726174206f726369206e756c6c612070656c6c656e7465737175652e204e756e6320636f6e73657175617420696e74657264756d207661726975732073697420616d6574206d61747469732076756c7075746174652e204d7573206d617572697320766974616520756c74726963696573206c656f20696e74656765722e2053656d20696e7465676572207669746165206a7573746f2065676574206d61676e61206665726d656e74756d20696163756c69732065752e2056697665727261206d617572697320696e20616c697175616d2073656d2e204e756e632070756c76696e61722073617069656e206574206c6967756c6120756c6c616d636f72706572206d616c6573756164612070726f696e2e20456c656d656e74756d206e6962682074656c6c7573206d6f6c6573746965206e756e63206e6f6e20626c616e646974206d6173736120656e696d2e20536f63696973206e61746f7175652070656e617469627573206574206d61676e6973206469732070617274757269656e742e3c2f703e0d0a0d0a3c703e5475727069732065676573746173207072657469756d2061656e65616e207068617265747261206d61676e612e204d616c6573756164612066616d65732061632074757270697320656765737461732e20496e206f726e617265207175616d2076697665727261206f72636920736167697474697320657520766f6c7574706174206f64696f20666163696c697369732e20566f6c7574706174206c61637573206c616f72656574206e6f6e20637572616269747572206772617669646120617263752061632e204d6173736120706c616365726174206475697320756c74726963696573206c6163757320736564207475727069732074696e636964756e742e20556c7472696365732074696e636964756e742061726375206e6f6e20736f64616c65732e204a7573746f2065676574206d61676e61206665726d656e74756d20696163756c6973206575206e6f6e2e20557420636f6e7365717561742073656d7065722076697665727261206e616d206c696265726f206a7573746f2e20506f727461206c6f72656d206d6f6c6c697320616c697175616d20757420706f72747469746f72206c656f2e204e756e6320696420637572737573206d6574757320616c697175616d20656c656966656e64206d6920696e2e2053757370656e646973736520756c74726963657320677261766964612064696374756d20667573636520757420706c616365726174206f7263692e20536564206c696265726f20656e696d207365642066617563696275732074757270697320696e206575206d6920626962656e64756d2e205072657469756d206c6563747573207175616d206964206c656f20696e2e20566573746962756c756d207365642061726375206e6f6e206f64696f20657569736d6f64206c6163696e696120617420717569732e3c2f703e0d0a, '2022-11-28 15:20:16', 1, 1),
(11, 'article 04', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sed risus pretium quam vulputate. Ut tristique et egestas quis ipsum suspendisse ultrices. Suspendisse ultrices gravida dictum f', 0x3c703e4c6f72656d20697073756d20646f6c6f722073697420616d65742c20636f6e73656374657475722061646970697363696e6720656c69742c2073656420646f20656975736d6f642074656d706f7220696e6369646964756e74207574206c61626f726520657420646f6c6f7265206d61676e6120616c697175612e20536564207269737573207072657469756d207175616d2076756c7075746174652e205574207472697374697175652065742065676573746173207175697320697073756d2073757370656e646973736520756c7472696365732e2053757370656e646973736520756c74726963657320677261766964612064696374756d20667573636520757420706c616365726174206f726369206e756c6c612070656c6c656e7465737175652e204e756e6320636f6e73657175617420696e74657264756d207661726975732073697420616d6574206d61747469732076756c7075746174652e204d7573206d617572697320766974616520756c74726963696573206c656f20696e74656765722e2053656d20696e7465676572207669746165206a7573746f2065676574206d61676e61206665726d656e74756d20696163756c69732065752e2056697665727261206d617572697320696e20616c697175616d2073656d2e204e756e632070756c76696e61722073617069656e206574206c6967756c6120756c6c616d636f72706572206d616c6573756164612070726f696e2e20456c656d656e74756d206e6962682074656c6c7573206d6f6c6573746965206e756e63206e6f6e20626c616e646974206d6173736120656e696d2e20536f63696973206e61746f7175652070656e617469627573206574206d61676e6973206469732070617274757269656e742e3c2f703e0d0a0d0a3c703e5475727069732065676573746173207072657469756d2061656e65616e207068617265747261206d61676e612e204d616c6573756164612066616d65732061632074757270697320656765737461732e20496e206f726e617265207175616d2076697665727261206f72636920736167697474697320657520766f6c7574706174206f64696f20666163696c697369732e20566f6c7574706174206c61637573206c616f72656574206e6f6e20637572616269747572206772617669646120617263752061632e204d6173736120706c616365726174206475697320756c74726963696573206c6163757320736564207475727069732074696e636964756e742e20556c7472696365732074696e636964756e742061726375206e6f6e20736f64616c65732e204a7573746f2065676574206d61676e61206665726d656e74756d20696163756c6973206575206e6f6e2e20557420636f6e7365717561742073656d7065722076697665727261206e616d206c696265726f206a7573746f2e20506f727461206c6f72656d206d6f6c6c697320616c697175616d20757420706f72747469746f72206c656f2e204e756e6320696420637572737573206d6574757320616c697175616d20656c656966656e64206d6920696e2e2053757370656e646973736520756c74726963657320677261766964612064696374756d20667573636520757420706c616365726174206f7263692e20536564206c696265726f20656e696d207365642066617563696275732074757270697320696e206575206d6920626962656e64756d2e205072657469756d206c6563747573207175616d206964206c656f20696e2e20566573746962756c756d207365642061726375206e6f6e206f64696f20657569736d6f64206c6163696e696120617420717569732e3c2f703e0d0a, '2022-11-28 15:20:29', 1, 10),
(12, 'article 05', '<p><span style=\"font-family:Arial,Helvetica,sans-serif\"><span class=\"marker\">Lorem ipsum dolor sit </span>amet</span>, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sed risus pretium quam vulputate. Ut tri', 0x3c703e3c7370616e207374796c653d22666f6e742d66616d696c793a417269616c2c48656c7665746963612c73616e732d7365726966223e3c7370616e20636c6173733d226d61726b6572223e4c6f72656d20697073756d20646f6c6f7220736974203c2f7370616e3e616d65743c2f7370616e3e2c20636f6e73656374657475722061646970697363696e6720656c69742c2073656420646f20656975736d6f642074656d706f7220696e6369646964756e74207574206c61626f726520657420646f6c6f7265206d61676e6120616c697175612e20536564207269737573207072657469756d207175616d2076756c7075746174652e205574207472697374697175652065742065676573746173207175697320697073756d2073757370656e646973736520756c7472696365732e2053757370656e646973736520756c74726963657320677261766964612064696374756d20667573636520757420706c616365726174206f726369206e756c6c612070656c6c656e7465737175652e204e756e6320636f6e73657175617420696e74657264756d207661726975732073697420616d6574206d61747469732076756c7075746174652e204d7573206d617572697320766974616520756c74726963696573206c656f20696e74656765722e2053656d20696e7465676572207669746165206a7573746f2065676574206d61676e61206665726d656e74756d20696163756c69732065752e2056697665727261206d617572697320696e20616c697175616d2073656d2e204e756e632070756c76696e61722073617069656e206574206c6967756c6120756c6c616d636f72706572206d616c6573756164612070726f696e2e20456c656d656e74756d206e6962682074656c6c7573206d6f6c6573746965206e756e63206e6f6e20626c616e646974206d6173736120656e696d2e20536f63696973206e61746f7175652070656e617469627573206574206d61676e6973206469732070617274757269656e742e3c2f703e0d0a, '2022-11-28 15:21:11', 1, 90),
(13, 'article 06', '<div style=\"background:#eeeeee; border:1px solid #cccccc; padding:5px 10px\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sed risus pretium quam vulputate. Ut tristique et egest', 0x3c646976207374796c653d226261636b67726f756e643a236565656565653b20626f726465723a31707820736f6c696420236363636363633b2070616464696e673a3570782031307078223e4c6f72656d20697073756d20646f6c6f722073697420616d65742c20636f6e73656374657475722061646970697363696e6720656c69742c2073656420646f20656975736d6f642074656d706f7220696e6369646964756e74207574206c61626f726520657420646f6c6f7265206d61676e6120616c697175612e20536564207269737573207072657469756d207175616d2076756c7075746174652e205574207472697374697175652065742065676573746173207175697320697073756d2073757370656e646973736520756c7472696365732e2053757370656e646973736520756c74726963657320677261766964612064696374756d20667573636520757420706c616365726174206f726369206e756c6c612070656c6c656e7465737175652e204e756e6320636f6e73657175617420696e74657264756d207661726975732073697420616d6574206d61747469732076756c7075746174652e204d7573206d617572697320766974616520756c74726963696573206c656f20696e74656765722e2053656d20696e7465676572207669746165206a7573746f2065676574206d61676e61206665726d656e74756d20696163756c69732065752e2056697665727261206d617572697320696e20616c697175616d2073656d2e204e756e632070756c76696e61722073617069656e206574206c6967756c6120756c6c616d636f72706572206d616c6573756164612070726f696e2e20456c656d656e74756d206e6962682074656c6c7573206d6f6c6573746965206e756e63206e6f6e20626c616e646974206d6173736120656e696d2e20536f63696973206e61746f7175652070656e617469627573206574206d61676e6973206469732070617274757269656e742e3c2f6469763e0d0a0d0a3c646976207374796c653d226261636b67726f756e643a236565656565653b20626f726465723a31707820736f6c696420236363636363633b2070616464696e673a3570782031307078223e3c696d6720616c743d226e6f22207372633d22687474703a2f2f6c6f63616c686f73742f65626c6f672f706c7567696e732f736d696c65792f696d616765732f7468756d62735f646f776e2e706e6722207374796c653d226865696768743a323370783b2077696474683a3233707822207469746c653d226e6f22202f3e3c2f6469763e0d0a0d0a3c703e5475727069732065676573746173207072657469756d2061656e65616e207068617265747261206d61676e612e204d616c6573756164612066616d65732061632074757270697320656765737461732e20496e206f726e617265207175616d2076697665727261206f72636920736167697474697320657520766f6c7574706174206f64696f20666163696c697369732e20566f6c7574706174206c61637573206c616f72656574206e6f6e20637572616269747572206772617669646120617263752061632e204d6173736120706c616365726174206475697320756c74726963696573206c6163757320736564207475727069732074696e636964756e742e20556c7472696365732074696e636964756e742061726375206e6f6e20736f64616c65732e204a7573746f2065676574206d61676e61206665726d656e74756d20696163756c6973206575206e6f6e2e20557420636f6e7365717561742073656d7065722076697665727261206e616d206c696265726f206a7573746f2e20506f727461206c6f72656d206d6f6c6c697320616c697175616d20757420706f72747469746f72206c656f2e204e756e6320696420637572737573206d6574757320616c697175616d20656c656966656e64206d6920696e2e2053757370656e646973736520756c74726963657320677261766964612064696374756d20667573636520757420706c616365726174206f7263692e20536564206c696265726f20656e696d207365642066617563696275732074757270697320696e206575206d6920626962656e64756d2e205072657469756d206c6563747573207175616d206964206c656f20696e2e20566573746962756c756d207365642061726375206e6f6e206f64696f20657569736d6f64206c6163696e696120617420717569732e3c2f703e0d0a, '2022-11-28 15:21:48', 1, 11),
(15, 'sample 01', '<p>jsefbrvjbv/jltvnklvnsklstn kblt</p>\r\n', 0x3c703e6a7365666272766a62762f6a6c74766e6b6c766e736b6c73746e206b626c743c2f703e0d0a, '2022-11-29 15:06:31', 0, 12),
(16, 'test', '<p>pdsifbhvpsdjl;gk&#39;</p>\r\n', 0x3c703e70647369666268767073646a6c3b676b262333393b3c2f703e0d0a, '2022-12-05 01:23:26', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT -1,
  `name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `submit_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `page_id`, `parent_id`, `name`, `content`, `submit_date`) VALUES
(4, 1, -1, 'Lucien ', 'test comment', '2022-12-01 19:18:53'),
(5, 1, 4, 'Grinker', 'Test reply', '2022-12-01 19:19:14'),
(6, 8, -1, 'Lucien Lee', 'test comment', '2022-12-01 19:21:26'),
(7, 8, 6, 'test reply', 'test reply', '2022-12-01 19:21:42'),
(8, 8, -1, 'laxlucien', 'help', '2022-12-01 19:53:17'),
(9, 8, 8, 'grinker', 'test ccomment to help', '2022-12-07 22:24:14'),
(10, 12, -1, 'laxlucien', 'test', '2023-03-02 16:09:48'),
(11, 12, -1, 'laxlucien', 'test', '2023-03-02 16:10:10'),
(12, 8, -1, 'laxlucien', 'Logan: tuesday march 7th, 1:04pm', '2023-03-07 13:05:16'),
(13, 11, -1, 'laxlucien', 'test', '2023-03-07 13:07:12'),
(14, 12, -1, 'laxlucien', 'Logan: tuesday march 7th, 1:35pm', '2023-03-07 13:35:09'),
(15, 12, -1, 'test', 'test', '2023-03-07 13:39:56');

-- --------------------------------------------------------

--
-- Table structure for table `save`
--

CREATE TABLE `save` (
  `saveID` int(11) NOT NULL,
  `postID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `dateSaved` date NOT NULL DEFAULT current_timestamp(),
  `is_saved` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `save`
--

INSERT INTO `save` (`saveID`, `postID`, `userID`, `dateSaved`, `is_saved`) VALUES
(2791, 8, 1, '2022-11-29', 0),
(2792, 8, 2, '2022-11-29', 0),
(2793, 8, 3, '2022-11-29', 0),
(2794, 8, 4, '2022-11-29', 0),
(2795, 8, 5, '2022-11-29', 0),
(2796, 9, 1, '2022-11-29', 1),
(2797, 9, 2, '2022-11-29', 0),
(2798, 9, 3, '2022-11-29', 0),
(2799, 9, 4, '2022-11-29', 0),
(2800, 9, 5, '2022-11-29', 0),
(2801, 10, 1, '2022-11-29', 0),
(2802, 10, 2, '2022-11-29', 0),
(2803, 10, 3, '2022-11-29', 0),
(2804, 10, 4, '2022-11-29', 0),
(2805, 10, 5, '2022-11-29', 0),
(2806, 11, 1, '2022-11-29', 1),
(2807, 11, 2, '2022-11-29', 0),
(2808, 11, 3, '2022-11-29', 0),
(2809, 11, 4, '2022-11-29', 0),
(2810, 11, 5, '2022-11-29', 0),
(2811, 12, 1, '2022-11-29', 1),
(2812, 12, 2, '2022-11-29', 0),
(2813, 12, 3, '2022-11-29', 0),
(2814, 12, 4, '2022-11-29', 0),
(2815, 12, 5, '2022-11-29', 0),
(2816, 13, 1, '2022-11-29', 0),
(2817, 13, 2, '2022-11-29', 0),
(2818, 13, 3, '2022-11-29', 0),
(2819, 13, 4, '2022-11-29', 0),
(2820, 13, 5, '2022-11-29', 0),
(4141, 15, 1, '2022-11-29', 0),
(4142, 15, 2, '2022-11-29', 0),
(4143, 15, 3, '2022-11-29', 0),
(4144, 15, 4, '2022-11-29', 0),
(4145, 15, 5, '2022-11-29', 0),
(12301, 16, 1, '2022-12-05', 0),
(12302, 16, 2, '2022-12-05', 0),
(12303, 16, 3, '2022-12-05', 0),
(12304, 16, 4, '2022-12-05', 0),
(12305, 16, 5, '2022-12-05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `social_follow`
--

CREATE TABLE `social_follow` (
  `follow_id` int(1) NOT NULL DEFAULT 0,
  `follower_id` int(11) NOT NULL,
  `followed_user_id` int(11) NOT NULL,
  `username_log` varchar(50) NOT NULL,
  `username_comp` varchar(50) NOT NULL,
  `unique_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_follow`
--

INSERT INTO `social_follow` (`follow_id`, `follower_id`, `followed_user_id`, `username_log`, `username_comp`, `unique_number`) VALUES
(0, 4, 4, 'George', 'George', 19),
(0, 4, 5, 'George', 'Grinker', 24),
(0, 4, 1, 'George', 'laxlucien', 4),
(0, 4, 2, 'George', 'test', 9),
(0, 4, 3, 'George', 'word', 14),
(0, 5, 4, 'Grinker', 'George', 20),
(0, 5, 5, 'Grinker', 'Grinker', 25),
(1, 5, 1, 'Grinker', 'laxlucien', 5),
(0, 5, 2, 'Grinker', 'test', 10),
(0, 5, 3, 'Grinker', 'word', 15),
(0, 1, 4, 'laxlucien', 'George', 16),
(1, 1, 5, 'laxlucien', 'Grinker', 21),
(0, 1, 1, 'laxlucien', 'laxlucien', 1),
(1, 1, 2, 'laxlucien', 'test', 6),
(0, 1, 3, 'laxlucien', 'word', 11),
(0, 2, 4, 'test', 'George', 17),
(0, 2, 5, 'test', 'Grinker', 22),
(0, 2, 1, 'test', 'laxlucien', 2),
(0, 2, 2, 'test', 'test', 7),
(0, 2, 3, 'test', 'word', 12),
(0, 3, 4, 'word', 'George', 18),
(0, 3, 5, 'word', 'Grinker', 23),
(0, 3, 1, 'word', 'laxlucien', 3),
(0, 3, 2, 'word', 'test', 8),
(0, 3, 3, 'word', 'word', 13);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_approved` int(1) NOT NULL DEFAULT 0,
  `Admin` int(1) NOT NULL DEFAULT 0,
  `graphic_Des` int(1) NOT NULL DEFAULT 0,
  `writer` int(1) NOT NULL DEFAULT 0,
  `reader` int(1) NOT NULL DEFAULT 1,
  `advr` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `fname`, `lname`, `email`, `password`, `is_approved`, `Admin`, `graphic_Des`, `writer`, `reader`, `advr`) VALUES
(1, 'laxlucien', 'Lucien', 'Lee', 'laxlucien@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 1, 1, 1, 1, 1, 1),
(2, 'test', 'test', 'test', 'test@test', '5f4dcc3b5aa765d61d8327deb882cf99', 1, 0, 0, 0, 1, 0),
(3, 'word', 'wo', 'rd', 'word@word', '5f4dcc3b5aa765d61d8327deb882cf99', 1, 1, 0, 1, 1, 0),
(4, 'George', 'George', 'McGee', 'georgeMcGee@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 1, 0, 0, 0, 1, 0),
(5, 'Grinker', 'guy', 'Manfrengendensen', 'grinker@msi', '5f4dcc3b5aa765d61d8327deb882cf99', 1, 1, 1, 1, 1, 1),
(9, 'asdf', 'daf', 'sdf', 'sdaf@asdf', '912ec803b2ce49e4a541068d495ab570', 0, 0, 0, 0, 1, 0),
(11, 'admin_only', 'admin', 'only', 'admin@only', '21232f297a57a5a743894a0e4a801fc3', 1, 1, 0, 0, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ad_displays`
--
ALTER TABLE `ad_displays`
  ADD PRIMARY KEY (`adID`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`postID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `save`
--
ALTER TABLE `save`
  ADD PRIMARY KEY (`postID`,`userID`),
  ADD KEY `saveID` (`saveID`);

--
-- Indexes for table `social_follow`
--
ALTER TABLE `social_follow`
  ADD PRIMARY KEY (`username_log`,`username_comp`),
  ADD KEY `unique_number` (`unique_number`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ad_displays`
--
ALTER TABLE `ad_displays`
  MODIFY `adID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `postID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `save`
--
ALTER TABLE `save`
  MODIFY `saveID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18746;

--
-- AUTO_INCREMENT for table `social_follow`
--
ALTER TABLE `social_follow`
  MODIFY `unique_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=551;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
