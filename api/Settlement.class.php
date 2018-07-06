<?php 
	
	require 'Conn.class.php';
	use Weshop\Api\Conn as Conn;

	/**
	* 结算类
	*/
	class Settlement
	{	
		private $pdo;
		function __construct()
		{
			$Conn = new Conn();
			$this->pdo = $Conn->connDb();
		}

		/*
		* 要结算的订单价格和数量
		*/
		public function settlementPrice(){
			$sqlParam = [
				':val1'=> 0,
				':val2'=> $_SESSION['uid']
			];
			$pdo = $this->pdo;
			$stmt = $pdo->prepare('SELECT SUM(`totalNum`) AS allTotalNum , SUM(`marketPrice` * `totalNum`) AS allMarketPrice FROM `order` WHERE `isCheck`=:val1 AND `uid`=:val2');
			$stmt->execute($sqlParam);
			while ( $row=$stmt->fetch(PDO::FETCH_OBJ) ) {
				$resObj = $row;
			}

			return $resObj;
		}


		/*
		* 要结算的订单列表
		*/ 
		public function settlementList(){
			$sqlParam = [
				':val1'=> 0,
				':val2'=> $_SESSION['uid']
			];
			$pdo = $this->pdo;
			$stmt=$pdo->prepare('SELECT * FROM `order` WHERE `isCheck`=:val1 AND `uid`=:val2');
			$stmt->execute($sqlParam);

			$rowArr = [];
			while( $row=$stmt->fetch(PDO::FETCH_ASSOC) ){
				unset( $row['uid'] );
				$rowArr[] = $row;
			}

			return $rowArr;
		}


		public function settlementOrder(){
			//检测是否已经登录
			$Conn = new Conn();
			$Conn->checkLogin();
		
			$settlementList = $this->settlementList();
			$settlementPrice = $this->settlementPrice();

			if ( !empty( $settlementList ) && !empty( $settlementPrice ) ) {
				exit(json_encode([
					'code'=> 0, 
					'msg'=> 'success',
					'settlementList'=> $settlementList,
					'allTotalNum'=> $settlementPrice->allTotalNum,
					'allMarketPrice'=> $settlementPrice->allMarketPrice
				]));
			}else{
				exit(json_encode([
					'code'=> -2,
					'msg'=> '请求错误！'
				]));
			}

		}
	}


	if ( isset($_POST) ) {

		$Settlement = new Settlement();

		switch( $_POST['type'] ){
			case 'settlementOrder':
				$Settlement->settlementOrder();
			break;
		}
	}