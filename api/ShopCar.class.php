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
		* 加入购物车的时候判断订单是否存在
		* @param $gid
		* @param $gpid
		* @param $gcid
		* @return 返回的条数
		*/ 
		private function orderIsHas($gid,$gpid,$gcid){
			$pdo = $this->pdo;
			$stmt = $pdo->prepare('SELECT COUNT(*) AS count FROM `order` WHERE `gid`=? AND `gpid`=? AND `gcid`=? AND `status`=0');
			$stmt->bindParam(1, $gid);
			$stmt->bindParam(2, $gpid);
			$stmt->bindParam(3, $gcid);
			$stmt->execute();

			while ( $row=$stmt->fetch(PDO::FETCH_OBJ) ) {
				$resObj = $row;
			}

			return $resObj->count;
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
			$uid = $_SESSION['uid'];

			//判断参数是否齐全
			if( !isset($post['gid']) || !isset($post['gpid']) || !isset($post['gcid']) || !isset($post['name']) || !isset($post['description']) || !isset($post['marketPrice']) || !isset($post['totalNum']) ){
				exit(json_encode([
					'code'=> -2,
					'msg'=> '参数错误，无法添加！'
				]));
			}

			//先进行查询是否存在
			$count=$this->orderIsHas($post['gid'] , $post['gpid'] , $post['gcid']);

			if ( $count > 0 ) {
				//表示存在有相同规格的商品，那么进行总数+1即可
				$stmt=$pdo->prepare('UPDATE `order` SET `totalNum`=`totalNum`+? WHERE `gid`=? AND `gpid`=? AND `gcid`=?');
				$stmt->bindParam(1, $post['totalNum']);
				$stmt->bindParam(2, $post['gid']);
				$stmt->bindParam(3, $post['gpid']);
				$stmt->bindParam(4, $post['gcid']);
			}else{
				//如果不存在相同规格的商品，那么插入新的订单
				$stmt=$pdo->prepare('INSERT INTO `order` (uid, gid, gpid, name, description, marketPrice, totalNum, gcid) VALUES (?,?,?,?,?,?,?,?)');
				$stmt->bindParam(1, $uid);
				$stmt->bindParam(2, $post['gid']);
				$stmt->bindParam(3, $post['gpid']);
				$stmt->bindParam(4, $post['name']);
				$stmt->bindParam(5, $post['description']);
				$stmt->bindParam(6, $post['marketPrice']);
				$stmt->bindParam(7, $post['totalNum']);
				$stmt->bindParam(8, $post['gcid']);
			}
			
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
			if (!session_id()) session_start();
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
		* 查询购物车订单总数和总价格
		*/
		private function totalPriceAndCount(){
			
			$pdo=$this->pdo;
			$stmt=$pdo->prepare('SELECT SUM(`marketPrice` * `totalNum`) AS `allMarketPrice` , SUM(`totalNum`) AS `allTotalNum` FROM `order` WHERE `status`=0 AND `isCheck`=0 AND `uid`=?');

			if (!session_id()) session_start();
			$uid = $_SESSION['uid'];
			$stmt->bindParam(1, $uid);
			$stmt->execute();

			while ( $row = $stmt->fetch(PDO::FETCH_OBJ) ) {
				$resObj = $row;
			}

			//判断返回是否为null，如果为空那么设置默认值
			if ( empty( $resObj->allMarketPrice ) ) {
				$resObj->allMarketPrice='0.00';
				$resObj->allTotalNum='0';
			}

			return $resObj;
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

				exit(json_encode([
					'code'=> 0,
					'allMarketPrice'=> $this->totalPriceAndCount()->allMarketPrice,
					'allTotalNum'=> $this->totalPriceAndCount()->allTotalNum,
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
			$resObj->allMarketPrice=$this->totalPriceAndCount()->allMarketPrice;
			$resObj->allTotalNum=$this->totalPriceAndCount()->allTotalNum;

			exit( json_encode($resObj) );

		}


		/*
		* 设置订单是否选中状态
		* @param $post 请求值
		*/ 
		public function setOrderCheck($post){

			if ( !isset($post['status']) || !isset($post['id']) ) {
				exit(json_encode([
					'code'=> -2,
					'msg'=> '请求参数错误！'
				]));
			}

			$pdo=$this->pdo;
			$stmt=$pdo->prepare('UPDATE `order` SET `isCheck`=? WHERE `id`=?');
			$stmt->bindParam(1, $post['status']);
			$stmt->bindParam(2, $post['id']);

			if ( $stmt->execute() ) {
				exit(json_encode([
					'code'=> 0,
					'allMarketPrice'=> $this->totalPriceAndCount()->allMarketPrice,
					'allTotalNum'=> $this->totalPriceAndCount()->allTotalNum,
					'msg'=> '修改成功！'
				]));
			}else{
				exit(json_encode([
					'code'=> -2,
					'msg'=> '修改失败！'
				]));
			}

		}


		/*
		* 设置订单是否选中状态
		* @param $post 请求值
		* 	->@param $totalNum 请求值
		*   ->@param $id 请求值
		*/ 
		public function updateOnlyOrderNum($post){
			if ( !isset($post['totalNum']) || !isset($post['id']) ) {
				exit(json_encode([
					'code'=> -2,
					'msg'=> '请求参数错误！'
				]));
			}

			$pdo=$this->pdo;
			$stmt=$pdo->prepare('UPDATE `order` SET `totalNum`=? WHERE `id`=?');
			$stmt->bindParam(1, $post['totalNum']);
			$stmt->bindParam(2, $post['id']);

			if ( $stmt->execute() ) {
				exit(json_encode([
					'code'=> 0,
					'allMarketPrice'=> $this->totalPriceAndCount()->allMarketPrice,
					'allTotalNum'=> $this->totalPriceAndCount()->allTotalNum,
					'msg'=> '修改成功！'
				]));
			}else{
				exit(json_encode([
					'code'=> -2,
					'msg'=> '修改失败！'
				]));
			}

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
			//设置订单是否选中状态
			case 'setOrderCheck':
				$ShopCar->setOrderCheck( $_POST );
			break;
			//更改单条订单数量
			case 'updateOnlyOrderNum':
				$ShopCar->updateOnlyOrderNum( $_POST );
			break;
		}
	}












