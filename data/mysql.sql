--
-- Table structure for table `message_receiver`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) unsigned NOT NULL,
  `subject` varchar(64) NOT NULL,
  `message_text` blob NOT NULL,
  `created_date_time` datetime NOT NULL,
  `starred_or_not` enum('1','0') NOT NULL DEFAULT '0',
  `important_or_not` enum('1','0') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `sender_id` (`sender_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `user` (`user_id`);


--
-- Table structure for table `message_receiver`
--

CREATE TABLE IF NOT EXISTS `message_receiver` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `message_id` int(10) unsigned NOT NULL,
  `receiver_id` int(11) unsigned NOT NULL,
  `sent_date_time` datetime NOT NULL,
  `received_or_not` enum('1','0') NOT NULL DEFAULT '0',
  `starred_or_not` enum('1','0') NOT NULL DEFAULT '0',
  `important_or_not` enum('1','0') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `message_receivers_fk1_idx` (`message_id`),
  KEY `receiver_id` (`receiver_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for table `message_receiver`
--
ALTER TABLE `message_receiver`
  ADD CONSTRAINT `message_receiver_ibfk_1` FOREIGN KEY (`receiver_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `message_receivers_fk1` FOREIGN KEY (`message_id`) REFERENCES `message` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;