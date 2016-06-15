

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";




CREATE TABLE IF NOT EXISTS `configurations` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(85) NOT NULL,
  `site_url` varchar(85) NOT NULL,
  `admin_email` varchar(85) NOT NULL,
  `site_full_name` varchar(85) NOT NULL,
  `site_descr` varchar(250) NOT NULL,
  `site_address` varchar(250) NOT NULL,
  `site_emails` varchar(250) NOT NULL,
  `site_phone` varchar(250) NOT NULL,
  `records` int(2) NOT NULL,
  `level_access` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;



INSERT INTO `configurations` (`id`, `site_name`, `site_url`, `admin_email`, `site_full_name`, `site_descr`, `site_address`, `site_emails`, `site_phone`, `records`, `level_access`) VALUES
(1, 'AML', 'www.ajebomrket.com', 'noreply@ajebomarket.com', 'Ajebo Market INC', 'This Site gives widows widgets free of charge', '777, you address street, City, Province/State, Country', 'email1@yourdomain.com, email2@yourdomain.com, email3@yourdomain.com, email4@yourdomain.com', '08065432345, 08076435443, 08065433235, 08024535443', 5, 'Yes');



CREATE TABLE IF NOT EXISTS `users` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `username` varchar(35) NOT NULL,
  `password` varchar(285) NOT NULL,
  `title` varchar(25) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `dob` varchar(50) NOT NULL,
  `gender` varchar(15) NOT NULL,
  `address` varchar(250) NOT NULL,
  `city` varchar(80) NOT NULL,
  `state` varchar(80) NOT NULL,
  `country` varchar(80) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `thumb_path` varchar(150) NOT NULL,
  `img_path` varchar(150) NOT NULL,
  `active` int(1) NOT NULL,
  `level_access` int(1) NOT NULL,
  `act_key` varchar(80) NOT NULL,
  `temp_pass` varchar(285) NOT NULL,
  `temp_pass_active` int(1) NOT NULL,
  `reg_date` varchar(45) NOT NULL,
  `last_login` varchar(45) NOT NULL,
  `last_active` varchar(50) NOT NULL,
  `online` varchar(5) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `title`, `full_name`, `email`, `dob`, `gender`, `address`, `city`, `state`, `country`, `phone`, `thumb_path`, `img_path`, `active`, `level_access`, `act_key`, `temp_pass`, `temp_pass_active`, `reg_date`, `last_login`, `last_active`, `online`) VALUES
(1, 'admin', '53d157e011f917f3822fe7e49d543d73', 'Mr', 'Site Admin', 'admin@test.com', '', '', '', '',  '', '', '', '', '', 1, 1, '', '', 0, 'Wednesday, Sep 28, 2011, 8:47 am', '', '', '0'),
(2, 'moderator', '53d157e011f917f3822fe7e49d543d73', 'Mr', 'Site Moderator', 'moderator@test.com', '',  '', '', '', '', '', '', '', '', 1, 2, '', '', 0, 'Wednesday, Sep 28, 2011, 8:47 am', '', '', '0'),
(3, 'user1', '53d157e011f917f3822fe7e49d543d73', 'Mr', 'John Doe', 'user@test.com', '', '', '', '', '',  '', '', '', '', 1, 9, '', '', 0, 'Wednesday, Sep 28, 2011, 8:47 am', '', '', '0'),
(4, 'inactive', '53d157e011f917f3822fe7e49d543d73', 'Mr', 'John Doe', 'notactivate@test.com', '', '', '', '', '',  '', '', '', '', 0, 9, '', '10697a00fb066fb4d037ac65f121ec5d', 0, 'Saturday, Feb 23, 2013, 10:00 am', '', '', '0');



CREATE TABLE IF NOT EXISTS `user_level_access` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `level_access_id` int(1) NOT NULL,
  `level_access` varchar(45) NOT NULL,
  KEY (`id`),
  PRIMARY KEY (`level_access_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;


INSERT INTO `user_level_access` (`id`, `level_access_id`, `level_access`) VALUES
(1, 1, 'Admin'),
(2, 2, ''),
(3, 3, ''),
(4, 4, ''),
(5, 5, ''),
(6, 6, ''),
(7, 7, ''),
(8, 8, ''),
(9, 9, 'Sales Agent');
