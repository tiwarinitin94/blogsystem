-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 07, 2018 at 12:39 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `media_src`
--

DROP TABLE IF EXISTS `media_src`;
CREATE TABLE IF NOT EXISTS `media_src` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `src` text,
  `user_added` text,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `media_src`
--

INSERT INTO `media_src` (`id`, `src`, `user_added`, `add_date`) VALUES
(1, 't3hvx9EAlUGkWfM/1544085777.jpg', 'tiwarinitin94', '2018-12-06 03:12:57'),
(2, 'AiPaFyXs8rtV6Sm/1544097589.jpg', 'tiwarinitin94', '2018-12-06 06:29:48');

-- --------------------------------------------------------

--
-- Table structure for table `post_data`
--

DROP TABLE IF EXISTS `post_data`;
CREATE TABLE IF NOT EXISTS `post_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` text NOT NULL,
  `title` text NOT NULL,
  `html_val` text NOT NULL,
  `user_posted` text NOT NULL,
  `tags` text,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `published` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_data`
--

INSERT INTO `post_data` (`id`, `p_id`, `title`, `html_val`, `user_posted`, `tags`, `date`, `published`) VALUES
(1, '0Hello-ttielle', 'Hello ttielle', 'sfnvsfsfjsfsf&lt;div&gt;slfkslf&lt;/div&gt;&lt;div&gt;sl;kfsf&lt;/div&gt;&lt;div&gt;hfdjgdakadkadfkadfakdaajdadajfadfjda&lt;/div&gt;&lt;div&gt;hkbjmm,mm,m,&lt;/div&gt;&lt;div&gt;fdfdt3t&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;img src=\"http://localhost/blog/public/userdata/media_blog/	\n\nt3hvx9EAlUGkWfM/1544085777.jpg\" style=\"width: 200px;\"&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;img src=\"http://localhost/blog/public/userdata/media_blog/	\n\nAiPaFyXs8rtV6Sm/1544097589.jpg\" style=\"width: 500px;\"&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;img onclick=\"selectImage(this)\" src=\"http://localhost/blog/public/userdata/media_blog/t3hvx9EAlUGkWfM/1544085777.jpg\" width=\"100\" class=\"selectedImage\" style=\"width: 200px;\"&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;&lt;img onclick=\"selectImage(this)\" src=\"http://localhost/blog/public/userdata/media_blog/AiPaFyXs8rtV6Sm/1544097589.jpg\" width=\"100\" class=\"selectedImage\" style=\"width: 200px;\"&gt;&lt;/div&gt;', 'tiwarinitin94', 'Hello, Check,How ', '2018-12-01 18:30:00', 0),
(3, '2Now-I-guess-hhehehhe', 'Now I guess', 'It wil Work&lt;div&gt;Nwoowowow&lt;/div&gt;&lt;div&gt;What happens&lt;/div&gt;', 'tiwarinitin94', NULL, '2018-12-06 02:06:43', 1),
(4, 'Now-I-guess-hhehehhe', 'Now I guess', 'It wil Work&lt;div&gt;Nwoowowow&lt;/div&gt;&lt;div&gt;What happens&lt;/div&gt;&lt;div&gt;kjnnm&lt;/div&gt;&lt;div&gt;sdfdds&lt;/div&gt;', 'tiwarinitin94', NULL, '2018-12-06 02:09:49', 0),
(9, 'My-Page', 'My Page', 'Now I am Going to create&lt;div&gt;&lt;b&gt;Heyyy There&lt;/b&gt;&lt;/div&gt;&lt;div&gt;&lt;b&gt;&lt;br&gt;&lt;/b&gt;&lt;/div&gt;&lt;div&gt;&lt;i style=\"\"&gt;&lt;b&gt;Now&nbsp;&lt;/b&gt;&nbsp;This is gonna check some thing&nbsp;&lt;/i&gt;&lt;/div&gt;&lt;div&gt;&lt;i style=\"\"&gt;&lt;br&gt;&lt;/i&gt;&lt;/div&gt;', 'tiwarinitin94', NULL, '2018-12-07 03:02:52', 1),
(8, '8Helelooosoofsfjsfjslfkslf', 'Helelooosoofsfjsfjslfkslf', 'Heleleeoolfadfjadjfadklad&lt;div&gt;adfadfj&lt;/div&gt;&lt;div&gt;adfjad;dal&lt;/div&gt;&lt;div&gt;aldfadfk&lt;/div&gt;&lt;div&gt;adfafadf&lt;/div&gt;', 'tiwarinitin94', NULL, '2018-12-06 02:54:15', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
