CREATE DATABASE IF NOT EXISTS angularcode;

USE angularcode;

--
-- Table structure for table `customers_auth`
--

CREATE TABLE IF NOT EXISTS `customers_auth` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `address` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=187 ;


-- ---
-- Globals
-- ---

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- SET FOREIGN_KEY_CHECKS=0;

-- ---
-- Table 'clients'
--
-- ---

DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `name` VARCHAR(50) NULL DEFAULT NULL,
  `adress` VARCHAR(50) NULL DEFAULT NULL,
  `tell` VARCHAR(20) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'product'
--
-- ---

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `name` VARCHAR(50) NULL DEFAULT NULL,
  `ref_type` INTEGER,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'Stock'
--
-- ---

DROP TABLE IF EXISTS `Stock`;
CREATE TABLE `Stock` (
  `id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `ref_prod` INTEGER,
  `qty` INTEGER NULL DEFAULT NULL,
  `date` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'achats'
--
-- ---

DROP TABLE IF EXISTS `achats`;
CREATE TABLE `achats` (
  `id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `ref_prod` INTEGER,
  `ref_for` INTEGER,
  `ref_vend` INTEGER,
  `qty` INTEGER NULL DEFAULT NULL,
  `prix` DOUBLE NULL DEFAULT NULL,
  `date` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'fourniseur'
--
-- ---

DROP TABLE IF EXISTS `fourniseur`;
CREATE TABLE `fourniseur` (
  `id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `tell` VARCHAR(20) NULL DEFAULT NULL,
  `adress` MEDIUMTEXT NULL DEFAULT NULL,
  `nom` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'product_type'
--
-- ---

DROP TABLE IF EXISTS `product_type`;
CREATE TABLE `product_type` (
  `id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `type_name` VARCHAR(50) NULL DEFAULT NULL,
  `unite` VARCHAR(10) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'client_wallet'
--
-- ---

DROP TABLE IF EXISTS `client_wallet`;
CREATE TABLE `client_wallet` (
  `id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `ref_cli` INTEGER,
  `amout` INTEGER NULL DEFAULT NULL,
  `avout` INTEGER NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'users'
--
-- ---

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `name` VARCHAR(50) NULL DEFAULT NULL,
  `user_name` VARCHAR(10) NULL DEFAULT NULL,
  `password` VARCHAR(32) NULL DEFAULT NULL,
  `level` TINYINT NULL DEFAULT 0,
  `last_login` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'client_operation'
--
-- ---

DROP TABLE IF EXISTS `client_operation`;
CREATE TABLE `client_operation` (
  `id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `ref_cli` INTEGER,
  `ref_vend` INTEGER,
  `holding_amount` INTEGER NULL DEFAULT NULL,
  `advance` INTEGER NULL DEFAULT NULL,
  `date` TIMESTAMP NULL DEFAULT NULL,
  `ref_operation` INTEGER,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'basket'
--
-- ---

DROP TABLE IF EXISTS `basket`;
CREATE TABLE `basket` (
  `id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `ref_cli` INTEGER,
  `ref_vend` INTEGER ,
  `ref_prod` INTEGER ,
  `qty` INTEGER NULL DEFAULT NULL,
  `sell_price` DOUBLE NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
KEY (`ref_cli`)
);

-- ---
-- Foreign Keys
-- ---

ALTER TABLE `product` ADD FOREIGN KEY (ref_type) REFERENCES `product_type` (`id`);
ALTER TABLE `Stock` ADD FOREIGN KEY (ref_prod) REFERENCES `product` (`id`);
ALTER TABLE `achats` ADD FOREIGN KEY (ref_prod) REFERENCES `product` (`id`);
ALTER TABLE `achats` ADD FOREIGN KEY (ref_for) REFERENCES `fourniseur` (`id`);
ALTER TABLE `achats` ADD FOREIGN KEY (ref_vend) REFERENCES `users` (`id`);
ALTER TABLE `client_wallet` ADD FOREIGN KEY (ref_cli) REFERENCES `clients` (`id`);
ALTER TABLE `client_operation` ADD FOREIGN KEY (ref_cli) REFERENCES `clients` (`id`);
ALTER TABLE `client_operation` ADD FOREIGN KEY (ref_vend) REFERENCES `users` (`id`);
ALTER TABLE `client_operation` ADD FOREIGN KEY (ref_operation) REFERENCES `basket` (`id`);
ALTER TABLE `basket` ADD FOREIGN KEY (ref_cli) REFERENCES `clients` (`id`);
ALTER TABLE `basket` ADD FOREIGN KEY (ref_vend) REFERENCES `users` (`id`);
ALTER TABLE `basket` ADD FOREIGN KEY (ref_prod) REFERENCES `product` (`id`);

-- ---
-- Table Properties
-- ---

-- ALTER TABLE `clients` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `product` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Stock` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `achats` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `fourniseur` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `product_type` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `client_wallet` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `users` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `client_operation` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `basket` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ---
-- Test Data
-- ---

-- INSERT INTO `clients` (`id`,`name`,`adress`,`tell`) VALUES
-- ('','','','');
-- INSERT INTO `product` (`id`,`name`,`ref_type`) VALUES
-- ('','','');
-- INSERT INTO `Stock` (`id`,`ref_prod`,`qty`,`date`) VALUES
-- ('','','','');
-- INSERT INTO `achats` (`id`,`ref_prod`,`ref_for`,`ref_vend`,`qty`,`prix`,`date`) VALUES
-- ('','','','','','','');
-- INSERT INTO `fourniseur` (`id`,`tell`,`adress`,`nom`) VALUES
-- ('','','','');
-- INSERT INTO `product_type` (`id`,`type_name`,`unite`) VALUES
-- ('','','');
-- INSERT INTO `client_wallet` (`id`,`ref_cli`,`amout`,`avout`) VALUES
-- ('','','','');
-- INSERT INTO `users` (`id`,`name`,`user_name`,`password`,`level`,`last_login`) VALUES
-- ('','','','','','');
-- INSERT INTO `client_operation` (`id`,`ref_cli`,`ref_vend`,`holding_amount`,`advance`,`date`,`ref_operation`) VALUES
-- ('','','','','','','');
-- INSERT INTO `basket` (`id`,`ref_cli`,`ref_vend`,`ref_prod`,`qty`,`sell_price`) VALUES
-- ('','','','','','');
--
-- Dumping data for table `customers_auth`
--

INSERT INTO `customers_auth` (`uid`, `name`, `email`, `phone`, `password`, `address`, `city`, `created`) VALUES
(169, 'Swadesh Behera', 'swadesh@gmail.com', '1234567890', '$2a$10$251b3c3d020155f7553c1ugKfEH04BD6nbCbo78AIDVOqS3GVYQ46', '4092 Furth Circle', 'Singapore', '2014-08-31 18:21:20'),
(170, 'Ipsita Sahoo', 'ipsita@gmail.com', '1111111111', '$2a$10$d84ffcf46967db4e1718buENHT7GVpcC7FfbSqCLUJDkKPg4RcgV2', '2, rue du Commerce', 'NYC', '2014-08-31 18:30:58'),
(171, 'Trisha Tamanna Priyadarsini', 'trisha@gmail.com', '2222222222', '$2a$10$c9b32f5baa3315554bffcuWfjiXNhO1Rn4hVxMXyJHJaesNHL9U/O', 'C/ Moralzarzal, 86', 'Burlingame', '2014-08-31 18:32:03'),
(172, 'Sai Rimsha', 'rimsha@gmail.com', '3333333333', '$2a$10$477f7567571278c17ebdees5xCunwKISQaG8zkKhvfE5dYem5sTey', '897 Long Airport Avenue', 'Madrid', '2014-08-31 20:34:21'),
(173, 'Satwik Mohanty', 'satwik@gmail.com', '4444444444', '$2a$10$2b957be577db7727fed13O2QmHMd9LoEUjioYe.zkXP5lqBumI6Dy', 'Lyonerstr. 34', 'San Francisco\n', '2014-08-31 20:36:02'),
(174, 'Tapaswini Sahoo', 'linky@gmail.com', '5555555555', '$2a$10$b2f3694f56fdb5b5c9ebeulMJTSx2Iv6ayQR0GUAcDsn0Jdn4c1we', 'ul. Filtrowa 68', 'Warszawa', '2014-08-31 20:44:54'),
(175, 'Manas Ranjan Subudhi', 'manas@gmail.com', '6666666666', '$2a$10$03ab40438bbddb67d4f13Odrzs6Rwr92xKEYDbOO7IXO8YvBaOmlq', '5677 Strong St.', 'Stavern\n', '2014-08-31 20:45:08'),
(178, 'AngularCode Administrator', 'admin@angularcode.com', '0000000000', '$2a$10$72442f3d7ad44bcf1432cuAAZAURj9dtXhEMBQXMn9C8SpnZjmK1S', 'C/1052, Bangalore', '', '2014-08-31 21:00:26');
