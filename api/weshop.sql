# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.20)
# Database: weshop
# Generation Time: 2018-06-25 02:27:05 +0000
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
  `cover` varchar(255) DEFAULT NULL COMMENT '商品封面',
  `name` varchar(100) DEFAULT NULL COMMENT '商品名称',
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

INSERT INTO `goods` (`id`, `cover`, `name`, `description`, `realPrice`, `marketPrice`, `createTime`, `types`, `status`, `model`)
VALUES
	(1,'//cdn.cnbj0.fds.api.mi-img.com/b2c-mimall-media/ee44583e8167f3d250186069a26c1384.jpg?thumb=1&w=360&h=360','黑鲨手机','专业游戏手机',3200.00,4000.00,NULL,0,0,NULL);

/*!40000 ALTER TABLE `goods` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table shop_car
# ------------------------------------------------------------

DROP TABLE IF EXISTS `shop_car`;

CREATE TABLE `shop_car` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '购物车id',
  `uid` int(10) DEFAULT NULL COMMENT '用户id',
  `status` int(1) DEFAULT '0' COMMENT '购物车状态：0表示正常，1表示禁用',
  `createTime` int(10) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `shop_car` WRITE;
/*!40000 ALTER TABLE `shop_car` DISABLE KEYS */;

INSERT INTO `shop_car` (`id`, `uid`, `status`, `createTime`)
VALUES
	(1,16,0,1529811570),
	(2,17,0,1529811964);

/*!40000 ALTER TABLE `shop_car` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_info
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_info`;

CREATE TABLE `user_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `username` varchar(20) DEFAULT NULL COMMENT '用户名',
  `password` varchar(32) DEFAULT NULL COMMENT '用户密码',
  `tellphone` int(11) DEFAULT NULL COMMENT '手机号码',
  `avatarUrl` varchar(100) DEFAULT '../../../static/images/logo.png' COMMENT '用户头像地址',
  `sex` int(1) DEFAULT NULL COMMENT '性别：0男，1女',
  `age` int(3) DEFAULT NULL COMMENT '年龄',
  `address` varchar(255) DEFAULT NULL COMMENT '地址',
  `createTime` int(10) DEFAULT NULL COMMENT '创建时间',
  `character` int(1) DEFAULT '0' COMMENT '角色：0表示普通用户，2表示vip，3表示管理员',
  `status` int(1) DEFAULT '0' COMMENT '用户状态：0表示正常 , 1表示禁用，2表示删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `user_info` WRITE;
/*!40000 ALTER TABLE `user_info` DISABLE KEYS */;

INSERT INTO `user_info` (`id`, `username`, `password`, `tellphone`, `avatarUrl`, `sex`, `age`, `address`, `createTime`, `character`, `status`)
VALUES
	(12,'Zion','41c45c00e7515f75bfccda7eaf3086cc',NULL,'../../../static/images/logo.png',NULL,NULL,NULL,1529749975,0,0),
	(17,'Zion2','3d39b90398028dc2f30902704865963d',NULL,'../../../static/images/logo.png',NULL,NULL,NULL,1529811964,0,0);

/*!40000 ALTER TABLE `user_info` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
