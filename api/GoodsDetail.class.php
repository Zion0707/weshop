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
		* @param $gid 根据商品id查询单个商品相关参数
		*/ 
		private function getOnlyGoodsArg($gid){
			$pdo = $this->pdo;
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


		/*
		* @param $gid 根据商品id查询单个商品
		*/ 
		private function goodsRow($gid){
			$pdo = $this->pdo;
			$stmt=$pdo->prepare('SELECT * FROM `goods` WHERE `id`=? LIMIT 0,1');
			$stmt->bindParam(1, $gid);
			$stmt->execute();
			$goodsArr=[];
			while ( $row=$stmt->fetch(PDO::FETCH_ASSOC) ) {

				//合并单个商品的参数，组成详细的商品详情
				$arg = $this->getOnlyGoodsArg($row['id']);
				if ( isset($arg[0]) ) {
					$goodsArr[] = array_merge($row, (array)$arg[0]);
				}else{
					$goodsArr[] = $row;
				}

			}

			return $goodsArr;
		}

		/*
		* @param $gid 根据商品id查询商品展示图
		*/
		private function goodsBanner($gid){
			$pdo = $this->pdo;
			$stmt=$pdo->prepare('SELECT * FROM `goods_banner` WHERE `gid`=? ORDER BY `index`');
			$stmt->bindParam(1, $gid);
			$stmt->execute();
			$bannerArr=[];
			while ( $row=$stmt->fetch(PDO::FETCH_ASSOC) ) {
				$bannerArr[]=$row;
			}

			return $bannerArr;
		}

		/*
		* 返回最终的商品详情数据
		*/
		public function goodsRes($gid){
			$goods = $this->goodsRow($gid);
			$banner = $this->goodsBanner($gid);

			//判断是否存在该商品
			if ( count($goods) != 0 ) {

				$success = ['code'=> 0, 'msg'=> 'success', 'banner'=> $banner];
				$resArr = array_merge($goods[0], $success);
				exit(json_encode($resArr));

			}else{

				exit(json_encode([
					'code'=> -2,
					'msg'=> '找不到该商品！'
				]));
				
			}



		}
	}
		
	
	// $_POST['goodsId'] = 1;
	//判断参数是否有goodsId，有则查询
	if ( isset($_POST['goodsId']) ) 
	{
		$GoodsDetail = new GoodsDetail();	
		$GoodsDetail->goodsRes( $_POST['goodsId'] );
	}else
	{
		exit(json_encode([
			'code'=> -2,
			'msg'=> '请求参数错误！'
		]));
	}


