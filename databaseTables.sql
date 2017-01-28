CREATE TABLE IF NOT EXISTS `userdetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(25) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` bigint(10) NOT NULL,
  PRIMARY KEY (`id`)
);