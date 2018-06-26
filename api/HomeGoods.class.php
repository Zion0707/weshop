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

		//每日精选
		private function daily(){

			$pdo=$this->pdo;

			$stmt = $pdo->prepare('SELECT * FROM `goods` WHERE `labelType`=0 LIMIT 0,6');
			$stmt->execute();
			$rowArr = [];
			while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
				$rowArr[] = $row;
			}

			print_r($rowArr);


		}

		//优惠精品
		private function preferential(){
			
		}

		//新品上市
		private function newProduct(){
			
		}

		//总的数据汇总
		public function homeData(){
			$this->daily();
		}

	}



	//调用
	$HomeGoods = new HomeGoods();
	$HomeGoods->homeData();







