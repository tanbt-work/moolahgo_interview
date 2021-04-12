--
-- Current Database: `moolahgo`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `ec` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `moolahgo`;

DROP TABLE IF EXISTS `referal_code`;
CREATE TABLE `referal_code` (
`id` SMALLINT NOT NULL AUTO_INCREMENT,
`code` VARCHAR(255) NOT NULL,
`owner` VARCHAR(255) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO referal_code (code, owner) VALUES ('ABC123', 'OwnerA');
INSERT INTO referal_code (code, owner) VALUES ('ABCDEF', 'OwnerB');
INSERT INTO referal_code (code, owner) VALUES ('123456', 'OwnerC');
INSERT INTO referal_code (code, owner) VALUES ('DDDDDD', 'OwnerD');
