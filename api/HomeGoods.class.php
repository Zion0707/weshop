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

		//获取单个商品的参数
		private function getOnlyGoodsArg($gid){
			$pdo=$this->pdo;

			//根据gid查询单个商品的相关规格
			$stmt = $pdo->prepare('SELECT * FROM `goods_parameter` WHERE `gid`=? ORDER BY `hot` DESC LIMIT 0,1');	
			$stmt->bindParam(1,$gid);	
			$stmt->execute();
			$rowArr=[];

			while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
				$rowArr[] = $row;
			}

			//处理掉不要的属性
			unset($rowArr[0]['id']);
			return $rowArr;
		}

		//获取每个类型的列表
		private function getLabelTypeList($labelType){
			$pdo=$this->pdo;

			//labelType 为每种类型
			$stmt = $pdo->prepare('SELECT * FROM `goods` WHERE `labelType`=? LIMIT 0,6');
			$stmt->bindParam(1, $labelType);
			$stmt->execute();
			$rowArr = [];
			while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){

				//合并单个商品的参数，组成详细的商品详情
				$arg = $this->getOnlyGoodsArg($row['id']);
				if ( isset($arg[0]) ) {
					$rowArr[] = array_merge($row, (array)$arg[0]);
				}else{
					$rowArr[] = $row;
				}
				
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


	// $_POST['type'] = 'recommended';
	if ( isset($_POST) ) {
		$HomeGoods = new HomeGoods();
		switch( $_POST['type'] ){
			//首页推荐
			case 'recommended':
				$HomeGoods->recommended( $_POST['type'] );
			break;
		}
	}









