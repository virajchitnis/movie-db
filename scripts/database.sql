--
-- Create table `Files`
--

DROP TABLE IF EXISTS `Files`;
CREATE TABLE `Files` (
  `id` varchar(9) NOT NULL,
  `file_name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Create table `Movies`
--

DROP TABLE IF EXISTS `Movies`;
CREATE TABLE `Movies` (
  `id` varchar(9) NOT NULL,
  `poster` varchar(500) NOT NULL,
  `name` varchar(200) NOT NULL,
  `year` varchar(45) NOT NULL,
  `time` varchar(45) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `rating` varchar(45) NOT NULL,
  `quality` varchar(45) NOT NULL,
  `link` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Create table `Quality`
--

DROP TABLE IF EXISTS `Quality`;
CREATE TABLE `Quality` (
  `quality` varchar(20) NOT NULL,
  PRIMARY KEY (`quality`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Insert data into table `Quality`
--

LOCK TABLES `Quality` WRITE;
INSERT INTO `Quality` VALUES ('1080p HD'),('720p HD'),('HD MKV'),('SD'),('SD AVI');
UNLOCK TABLES;
