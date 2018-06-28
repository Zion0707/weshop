<?php 

	namespace Weshop\Api;
	
	require 'Conn.class.php';
	use Weshop\Api\Conn;

	/**
	* 购物车类
	*/
	class ShopCar
	{
		private $pdo;
		public function __construct(){
			$Conn = new Conn();
			$this->pdo = $Conn->connDb();
		}

		/*
		* 添加订单 
		*/ 
		public function addGoods($post){
			//检测是否已经登录
			$Conn = new Conn();
			$Conn->checkLogin();

			$pdo = $this->pdo;
			$stmt=$pdo->prepare('INSERT INTO `order` (uid, gid, goodsParameterId, name, description, marketPrice, totalNum, goodsColor) VALUES (?,?,?,?,?,?,?,?)');

			$uid = $_SESSION['uid'];
			$stmt->bindParam(1, $uid);
			$stmt->bindParam(2, $post['gid']);
			$stmt->bindParam(3, $post['goodsParameterId']);
			$stmt->bindParam(4, $post['name']);
			$stmt->bindParam(5, $post['description']);
			$stmt->bindParam(6, $post['marketPrice']);
			$stmt->bindParam(7, $post['totalNum']);
			$stmt->bindParam(8, $post['goodsColor']);

			if ( $stmt->execute() ) {
				exit(json_encode([
					'code'=> 0,
					'msg'=> '添加成功！'
				]));
			}else{
				exit(json_encode([
					'code'=> -2,
					'msg'=> '添加失败！'
				]));
			}

		}
	}





	// $_POST['type'] = 'addGoods';

	if ( isset($_POST) ) {
		$ShopCar=new ShopCar();
		switch ( $_POST['type'] ) {
			//添加订单
			case 'addGoods':
				$ShopCar->addGoods( $_POST );	
			break;
		}
	}