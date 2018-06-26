# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.20)
# Database: weshop
# Generation Time: 2018-06-26 07:08:32 +0000
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
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL COMMENT '商品名称',
  `cover` varchar(255) DEFAULT NULL COMMENT '商品封面',
  `description` varchar(255) DEFAULT NULL COMMENT '商品描述',
  `realPrice` decimal(11,2) DEFAULT NULL COMMENT '商品真实价格',
  `marketPrice` decimal(11,2) DEFAULT NULL COMMENT '商品市场价格',
  `createTime` int(10) DEFAULT NULL COMMENT '商品创建时间',
  `hot` int(11) DEFAULT '0' COMMENT '热度:用户购买1次就加1',
  `types` int(10) DEFAULT NULL COMMENT '商品类型：0:手机、1:电脑、2:电视、3:键盘',
  `status` int(1) DEFAULT '0' COMMENT '商品状态：0:正常、1:售罄、3:停售',
  `label` varchar(255) DEFAULT NULL COMMENT '标签:有利于模糊搜索',
  `labelType` int(11) DEFAULT NULL COMMENT '标签类型:0表示`每日精选`,1表示`优惠精选`，2表示`新品上市`',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `goods` WRITE;
/*!40000 ALTER TABLE `goods` DISABLE KEYS */;

INSERT INTO `goods` (`id`, `name`, `cover`, `description`, `realPrice`, `marketPrice`, `createTime`, `hot`, `types`, `status`, `label`, `labelType`)
VALUES
	(1,'黑鲨游戏手机 液冷更快','//cdn.cnbj0.fds.api.mi-img.com/b2c-mimall-media/ee44583e8167f3d250186069a26c1384.jpg?thumb=1&w=360&h=360','液冷更快，独显芯片',3200.00,0.00,1529992051,0,0,0,'手机',0),
	(2,'红米6','//cdn.cnbj0.fds.api.mi-img.com/b2c-mimall-media/7c4c3f392acbce030e183681995f49ab.jpg?thumb=1&w=360&h=360','AI双摄，小屏高性能',799.00,0.00,1529992051,0,0,0,'手机',1),
	(3,'红米6A','//cdn.cnbj0.fds.api.mi-img.com/b2c-mimall-media/3c1cc1a103dbccafee59d542ded8aa80.jpg?thumb=1&w=360&h=360','AI人脸解锁，小巧屏高性能',599.00,0.00,1529992051,0,0,0,'手机',0),
	(4,'小米MIX 2S','//cdn.cnbj0.fds.api.mi-img.com/b2c-mimall-media/53d32c5e55cba00b473b48908c571f02.jpg?thumb=1&w=360&h=360','骁龙845旗舰处理器，AI双摄',3299.00,0.00,1529992051,0,0,0,'手机',2),
	(5,'小米Max 2 大屏大电量','//i8.mifile.cn/v1/a1/d5c8ea24-5290-46e0-8064-7634b4cbad70!360x360.webp','6.44\"大屏，5300mAh大电量',1099.00,0.00,1529992051,0,0,0,'手机',0),
	(6,'红米5 Plus','//i8.mifile.cn/v1/a1/e7853ea5-1260-6cb2-91ed-2c539a87db0a!360x360.webp','全面屏，4000mAh大电量',899.00,0.00,1529992051,0,0,0,'手机',1),
	(7,'小米MIX 2','//cdn.cnbj0.fds.api.mi-img.com/b2c-mimall-media/d68da7f79cc9800a34b1b48e1a439e44.jpg?thumb=1&w=360&h=360','5.99\"大屏，4轴光学防抖',2599.00,0.00,1529992051,0,0,0,'手机',0),
	(8,'红米自拍手机S2','//cdn.cnbj0.fds.api.mi-img.com/b2c-mimall-media/8612f157af2c116b7e3fc47356cdb7be.jpg?thumb=1&w=360&h=360','1600万像素自拍手机',899.00,0.00,1529992051,0,0,0,'手机',2),
	(9,'红米5 16GB','//i8.mifile.cn/v1/a1/48af122b-362c-dae5-8305-899805faf635!360x360.webp','千元全面屏，前置柔光自拍',699.00,0.00,1529992051,0,0,0,'手机',0),
	(10,'红米S2 3GB+32GB','//cdn.cnbj0.fds.api.mi-img.com/b2c-mimall-media/8612f157af2c116b7e3fc47356cdb7be.jpg?thumb=1&w=360&h=360','1600万像素自拍手机',899.00,0.00,1529992051,0,0,0,'手机',1),
	(11,'红米6','//cdn.cnbj0.fds.api.mi-img.com/b2c-mimall-media/7c4c3f392acbce030e183681995f49ab.jpg?thumb=1&w=360&h=360','AI双摄，小屏高性能',799.00,0.00,1529992051,0,0,0,'手机',0),
	(12,'小米8 6GB+64GB','//cdn.cnbj0.fds.api.mi-img.com/b2c-mimall-media/cbbf4728cf72469446dd98a51c564537.jpg?thumb=1&w=360&h=360','全球首款双频GPS，骁龙845',2699.00,0.00,1529992051,0,0,0,'手机',2),
	(13,'43\"电视4A 青春版','//cdn.cnbj0.fds.api.mi-img.com/b2c-mimall-media/c77c22ad69ab6b7387d302cac174d2de.jpg?thumb=1&w=344&h=280','全高清屏，人工智能语音',1499.00,0.00,1529992051,0,1,0,'电视',0),
	(14,'小米电视4A 55英寸','//cdn.cnbj0.fds.api.mi-img.com/b2c-mimall-media/3cb082d39f6fac08de86bcd4a7c1c816.jpg?thumb=1&w=344&h=280','4K HDR，64位处理器',2499.00,0.00,1529992051,0,1,0,'电视',1),
	(15,'小米电视4C 32英寸','//cdn.cnbj0.fds.api.mi-img.com/b2c-mimall-media/703a49de28da3958709534542bd6cb05.jpg?thumb=1&w=344&h=280','高清液晶屏，人工智能系统',849.00,0.00,1529992051,0,1,0,'电视',2),
	(16,'小米电视4C 50英寸','//cdn.cnbj0.fds.api.mi-img.com/b2c-mimall-media/e2f13c29e527488223ee673f477b76a5.jpg?thumb=1&w=344&h=280','钢琴烤漆，4K HDR',1999.00,0.00,1529992051,0,1,0,'电视',0),
	(17,'12.5\"笔记本Air 256GB','//i8.mifile.cn/v1/a1/28bf863f-1c2d-52b8-a2e5-186dfcbaad1e!360x360.webp','轻薄长续航，金属机身',3999.00,0.00,1529992051,0,2,0,'电脑',1),
	(18,'13.3\"笔记本 四核i5','//i8.mifile.cn/v1/a1/ce985ac0-8fb7-1472-ccd9-f937b4ea43c7!360x360.webp','四核增强版，独立显卡',4999.00,0.00,1529992051,0,2,0,'电脑',0),
	(19,'12.5\"笔记本Air 256GB','//i8.mifile.cn/v1/a1/28bf863f-1c2d-52b8-a2e5-186dfcbaad1e!360x360.webp','轻薄长续航，金属机身',3999.00,0.00,1529992051,0,2,0,'电脑',2),
	(20,'15.6\"笔记本i7 8GB','//i8.mifile.cn/v1/a1/82488d9e-b7ec-c845-e9d7-4e03f5c5e272!360x360.webp','全新高性能独显',6399.00,0.00,1529992051,0,2,0,'电脑',0),
	(21,'游戏本 15.6\"  i5 GTX 1050Ti ','//cdn.cnbj0.fds.api.mi-img.com/b2c-mimall-media/3b06702e8e7421404c8c6b0446bfbf3d.jpg?thumb=1&w=360&h=360','电竞级性能怪兽',5799.00,0.00,1529992051,0,2,0,'电脑',1),
	(22,'悦米机械键盘Pro静音版','//cdn.cnbj0.fds.api.mi-img.com/b2c-mimall-media/d67b10a1ab4a6a3d4bdc7c32d5493954.jpg?thumb=1&w=360&h=360','天生极简 精致由内到外',599.00,0.00,1529992051,0,3,0,'机械键盘',2);

/*!40000 ALTER TABLE `goods` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table order
# ------------------------------------------------------------

DROP TABLE IF EXISTS `order`;

CREATE TABLE `order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单id',
  `uid` int(10) DEFAULT NULL COMMENT '用户id',
  `oid` varchar(100) DEFAULT NULL COMMENT '订单编号',
  `name` varchar(100) DEFAULT NULL COMMENT '商品名称',
  `description` varchar(255) DEFAULT NULL COMMENT '商品描述',
  `createTime` int(10) DEFAULT NULL COMMENT '订单创建时间',
  `realPrice` decimal(11,2) DEFAULT NULL COMMENT '订单真实价格',
  `marketPrice` decimal(11,2) DEFAULT NULL COMMENT '订单市场价格',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



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
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
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
	(1,'Zion','41c45c00e7515f75bfccda7eaf3086cc',NULL,'../../../static/images/logo.png',NULL,NULL,NULL,1529749975,0,0),
	(2,'Zion2','3d39b90398028dc2f30902704865963d',NULL,'../../../static/images/logo.png',NULL,NULL,NULL,1529811964,0,0);

/*!40000 ALTER TABLE `user_info` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
