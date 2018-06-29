<?php 

	// namespace Weshop\Api;
	
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
		* @param $post 为前端传过来的值
		*/ 
		public function addOrder($post){
			//检测是否已经登录
			$Conn = new Conn();
			$Conn->checkLogin();

			$pdo = $this->pdo;
			$stmt=$pdo->prepare('INSERT INTO `order` (uid, gid, gpId, name, description, marketPrice, totalNum, gcId) VALUES (?,?,?,?,?,?,?,?)');

			if( !isset($post['gid']) || !isset($post['gpId']) || !isset($post['name']) || !isset($post['description']) || !isset($post['marketPrice']) || !isset($post['totalNum']) || !isset($post['gcId']) ){
				exit(json_encode([
					'code'=> -2,
					'msg'=> '参数错误，无法添加！'
				]));
			}

			$uid = $_SESSION['uid'];
			$stmt->bindParam(1, $uid);
			$stmt->bindParam(2, $post['gid']);
			$stmt->bindParam(3, $post['gpId']);
			$stmt->bindParam(4, $post['name']);
			$stmt->bindParam(5, $post['description']);
			$stmt->bindParam(6, $post['marketPrice']);
			$stmt->bindParam(7, $post['totalNum']);
			$stmt->bindParam(8, $post['gcId']);

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



		/*
		* 根据 gcId 查询具体的订单信息
		* @paramg $gcId 颜色id
		*/ 
		private function orderMsg($gcId){
			$pdo=$this->pdo;
			$stmt=$pdo->prepare('SELECT * FROM `goods_color` WHERE `id`=?');
			$stmt->bindParam(1, $gcId);
			$stmt->execute();
			$rowArr=[];

			//.....
		}



		/*
		* 根据 uid 获取订单列表
		*/ 
		private function orderList(){
			$pdo=$this->pdo;
			$stmt=$pdo->prepare('SELECT * FROM `order` WHERE `uid`=? ORDER BY `id` DESC');
			$uid=$_SESSION['uid'];
			$stmt->bindParam(1, $uid);
			$stmt->execute();
			$rowArr=[];
			while( $row=$stmt->fetch(PDO::FETCH_ASSOC) ){
				$rowArr[] = $row;
			}

			return $rowArr;
		}


		/*
		* 返回购物车信息
		*/ 
		public function getOrder(){

			//检测是否已经登录
			$Conn = new Conn();
			$Conn->checkLogin();

			$pdo=$this->pdo;
			$stmt=$pdo->prepare('SELECT * FROM `shop_car` WHERE `uid`=?');
			$uid = $_SESSION['uid'];
			$stmt->bindParam(1, $uid);
			$stmt->execute();
			
			//返回参数
			while( $row=$stmt->fetch(PDO::FETCH_OBJ) ){
				$resObj = $row;
			}

			$orderList = $this->orderList();
			exit( json_encode($orderList) );



		}

	}





	// $_POST['type'] = 'getOrder';

	if ( isset($_POST) ) {
		$ShopCar=new ShopCar();
		switch ( $_POST['type'] ) {
			//添加订单
			case 'addOrder':
				$ShopCar->addOrder( $_POST );	
			break;
			//获取所有订单
			case 'getOrder':
				$ShopCar->getOrder();
			break;
		}
	}












