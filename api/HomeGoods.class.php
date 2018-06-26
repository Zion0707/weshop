<?php 
	
	require 'Conn.class.php';
	use Weshop\Api\Conn as Conn;

	/**
	* 首页商品类
	*/
	class HomeGoods 
	{

		private $pdo;
		public function __construct()
		{
			$Conn = new Conn();
			$this->pdo = $Conn->connDb();
		}	

		//获取每个类型的列表
		private function getLabelTypeList($labelType){
			$pdo=$this->pdo;
			$stmt = $pdo->prepare('SELECT * FROM `goods` WHERE `labelType`=? LIMIT 0,6');
			$stmt->bindParam(1, $labelType);
			$stmt->execute();
			$rowArr = [];
			while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
				$rowArr[] = $row;
			}
			return $rowArr;
		}

		//推荐数据列表
		public function recommended(){
			//每日精选
			$labelTypeList0 = $this->getLabelTypeList(0);
			//优惠精品
			$labelTypeList1 = $this->getLabelTypeList(1);
			//新品上市
			$labelTypeList2 = $this->getLabelTypeList(2);


			exit( json_encode([
				'code'=> 0,
				'msg'=> 'success',
				'dailyList'=> $labelTypeList0,
				'preferentialList'=> $labelTypeList1,
				'newProductsList'=> $labelTypeList2
			]));

		}	

	}



	if ( isset($_POST) ) {
		$HomeGoods = new HomeGoods();
		switch( $_POST['type'] ){
			//首页推荐
			case 'recommended':
				$HomeGoods->recommended( $_POST['type'] );
			break;
		}
	}









