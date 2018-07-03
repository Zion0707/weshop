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
		* 订单总数加操作
		* @param $totalNum 总数
		* @param $type 'plus' or 'less'
		*/
		private function operatingTotalNum($totalNum,$type){
			$pdo = $this->pdo;
			if ( $type=='plus' ) {
				$sql = 'UPDATE `shop_car` SET `totalNum`=`totalNum`+? WHERE `uid`=?';
			}else{
				$sql = 'UPDATE `shop_car` SET `totalNum`=`totalNum`-? WHERE `uid`=?';
			}
			$stmt=$pdo->prepare($sql);
			$uid = $_SESSION['uid'];
			$stmt->bindParam(1, $totalNum);
			$stmt->bindParam(2, $uid);
			$stmt->execute();
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
			$stmt=$pdo->prepare('INSERT INTO `order` (uid, gid, gpid, name, description, marketPrice, totalNum, gcid) VALUES (?,?,?,?,?,?,?,?)');

			if( !isset($post['gid']) || !isset($post['gpid']) || !isset($post['name']) || !isset($post['description']) || !isset($post['marketPrice']) || !isset($post['totalNum']) || !isset($post['gcid']) ){
				exit(json_encode([
					'code'=> -2,
					'msg'=> '参数错误，无法添加！'
				]));
			}

			$uid = $_SESSION['uid'];
			$stmt->bindParam(1, $uid);
			$stmt->bindParam(2, $post['gid']);
			$stmt->bindParam(3, $post['gpid']);
			$stmt->bindParam(4, $post['name']);
			$stmt->bindParam(5, $post['description']);
			$stmt->bindParam(6, $post['marketPrice']);
			$stmt->bindParam(7, $post['totalNum']);
			$stmt->bindParam(8, $post['gcid']);

			if ( $stmt->execute() ) {
				
				//订单数累加
				$this->operatingTotalNum( $post['totalNum'] , 'plus');

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
		* 根据 gcid 查询具体的订单信息
		* @param $gcid 颜色id
		*/ 
		private function orderMsg($gcid){
			$pdo=$this->pdo;
			$stmt=$pdo->prepare('SELECT * FROM `goods_color` WHERE `id`=?');
			$stmt->bindParam(1, $gcid);
			$stmt->execute();
			$rowArr=[];
			while( $row=$stmt->fetch(PDO::FETCH_ASSOC) ){
				unset($row['id']);
				$rowArr[] = $row;
			}

			if ( count($rowArr) ) {
				return $rowArr[0];
			}else{
				return null;
			}

		}

		/*
		* 根据 uid 获取订单列表
		*/ 
		private function orderList(){
			$pdo=$this->pdo;
			$stmt=$pdo->prepare('SELECT * FROM `order` WHERE `uid`=? AND `status`=0 ORDER BY `id` DESC');
			$uid=$_SESSION['uid'];
			$stmt->bindParam(1, $uid);
			$stmt->execute();
			$rowArr=[];
			while( $row=$stmt->fetch(PDO::FETCH_ASSOC) ){
				$orderMsg = $this->orderMsg( $row['gcid'] );
				$resRow = array_merge($row, $orderMsg);

				//剔除不要的信息
				// unset($resRow['id']);
				unset($resRow['uid']);
				// unset($resRow['gid']);
				// unset($resRow['gpid']);
				// unset($resRow['gcid']);

				$rowArr[]=$resRow;
			}

			return $rowArr;
		}

		/*
		* 删除单条订单
		* @param $post 
		*/ 
		public function delOrder($post){
			//检测是否已经登录
			$Conn = new Conn();
			$Conn->checkLogin();

			//判断是否存在关键的请求参数
			if ( !isset( $post['id'] ) ) {
				exit(json_encode([
					'code'=> -2,
					'msg'=> '请求参数错误！'
				]));
			}

			$pdo=$this->pdo;
			$stmt=$pdo->prepare('UPDATE `order` SET `status`=1 WHERE `id`=?');
			$stmt->bindParam(1, $post['id']);

			if( $stmt->execute() ){

				//订单数累减
				$this->operatingTotalNum(1,'less');

				exit(json_encode([
					'code'=> 0,
					'msg'=> 'success'
				]));
			}else{
				exit(json_encode([
					'code'=> -2,
					'msg'=> '删除失败！'
				]));
			}
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
			
			//返回对象
			while( $row=$stmt->fetch(PDO::FETCH_OBJ) ){
				unset($row->id);
				unset($row->uid);
				$resObj = $row;
			}

			$orderList = $this->orderList();
			$resObj->code = 0;
			$resObj->msg = 'success';
			$resObj->orderList=$orderList;

			exit( json_encode($resObj) );

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
			//删除单条订单
			case 'delOrder':
				$ShopCar->delOrder( $_POST );
			break;
		}
	}












