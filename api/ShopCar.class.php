<?php 

	namespace Weshop\Api;
	
	// require 'Conn.class.php';
	// use Weshop\Api\Conn;

	/**
	* 购物车类
	*/
	class ShopCar
	{
		/*
		* 创建购物车
		* @param $pdo PDO 对象
		* @param $uid 用户id
		*/ 
		public function createCar($pdo, $uid){
			$stmt = $pdo->prepare('INSERT INTO shop_car (`uid`, `createTime`) VALUES (?,?) ');
			$stmt->bindParam(1, $uid);
			$stmt->bindParam(2, time());
			$stmt->execute();
		}	
	}
