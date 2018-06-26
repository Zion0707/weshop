# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.20)
# Database: weshop
# Generation Time: 2018-06-26 03:49:02 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table goods
# ------------------------------------------------------------

DROP TABLE IF EXISTS `goods`;

CREATE TABLE `goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品id',
  `hot` int(11) DEFAULT '0' COMMENT '热度:用户购买1次就加1',
  `name` varchar(100) DEFAULT NULL COMMENT '商品名称',
  `cover` varchar(255) DEFAULT NULL COMMENT '商品封面',
  `description` varchar(255) DEFAULT NULL COMMENT '商品描述',
  `realPrice` decimal(11,2) DEFAULT NULL COMMENT '商品真实价格',
  `marketPrice` decimal(11,2) DEFAULT NULL COMMENT '商品市场价格',
  `createTime` int(10) DEFAULT NULL COMMENT '商品创建时间',
  `types` int(10) DEFAULT NULL COMMENT '商品类型：0:手机、1:电脑、2:电视',
  `status` int(1) DEFAULT '0' COMMENT '商品状态：0:正常、1:售罄、3:停售',
  `model` varchar(255) DEFAULT NULL COMMENT '型号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `goods` WRITE;
/*!40000 ALTER TABLE `goods` DISABLE KEYS */;

INSERT INTO `goods` (`id`, `hot`, `name`, `cover`, `description`, `realPrice`, `marketPrice`, `createTime`, `types`, `status`, `model`)
VALUES
	(1,0,'黑鲨手机','//cdn.cnbj0.fds.api.mi-img.com/b2c-mimall-media/ee44583e8167f3d250186069a26c1384.jpg?thumb=1&w=360&h=360','专业游戏手机',3200.00,4000.00,NULL,0,0,NULL);

/*!40000 ALTER TABLE `goods` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
