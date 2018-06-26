<?php 

	require 'Conn.class.php';
	use Weshop\Api\Conn as Conn;

	/**
	* 商品详情类
	*/
	class GoodsDetail
	{
		private $pdo;
		public function __construct()
		{
			$Conn = new Conn();
			$this->pdo = $Conn->connDb();
		}

		/*
		* @param $goodId 根据商品id查询单个商品
		*/ 
		private function goodsRow(){

		}

		/*
		* @param $goodId 根据商品id查询商品展示图
		*/
		private function goodsBanner(){

		}

		/*
		* 返回最终的商品详情数据
		*/
		public function goodsRes(){

		}


	}
		
	// $_POST['goodsId'] = 1;
	if ( isset($_POST['goodsId']) ) {
		$GoodsDetail = new GoodsDetail();	
		$GoodsDetail->goodsRes();
	}else{
		exit(json_encode([
			'code'=> -2,
			'msg'=> '请求参数错误！'
		]));
	}


