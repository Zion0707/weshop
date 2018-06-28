<?php 

	require 'Conn.class.php';
	use Weshop\Api\Conn as Conn;

	/**
	* 商品详情类
	*/
	class GoodsDetail
	{
		private $pdo;
		public function __construct(){
			$Conn = new Conn();
			$this->pdo = $Conn->connDb();
		}

		/*
		* @param $gid 根据商品id查询单个商品相关参数
		* @param $gIndex 根据规格索引来定位具体对应的索引商品
		*/ 
		private function getOnlyGoodsParameter($gid, $gIndex){
			$pdo = $this->pdo;
			//根据gid查询单个商品的相关规格
			$stmt = $pdo->prepare('SELECT * FROM `goods_parameter` WHERE `gid`=? AND `gIndex`=? LIMIT 0,1');	
			$stmt->bindParam(1,$gid);	
			$stmt->bindParam(2,$gIndex);	
			$stmt->execute();
			$rowArr=[];

			while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
				//剔除不要的信息
				unset( $row['id'] );

				$rowArr[] = $row;
			}
			return $rowArr;
		}

		/*
		* @param $gpid 根据规格参数查询相对应的颜色及库存
		*/
		private function goodsParameterColor($gpid){
			$pdo = $this->pdo;
			//根据 $gpid 查询对应的颜色
			$stmt = $pdo->prepare('SELECT * FROM `goods_color` WHERE `gpid`=?');
			$stmt->bindParam(1, $gpid);
			$stmt->execute();
			$rowArr=[];

			while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
				//剔除不要的信息
				unset( $row['id'] );

				$rowArr[] = $row;
			}

			return $rowArr;
		}

		/*
		* @param $gid 根据商品id查询单个商品的所有相关参数
		*/ 
		private function getAllGoodsParameter($gid){
			$pdo = $this->pdo;
			$stmt = $pdo->prepare('SELECT * FROM `goods_parameter` WHERE `gid`=? ORDER BY `hot` DESC');
			$stmt->bindParam(1,$gid);
			$stmt->execute();
			$rowArr=[];

			while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
				//把该型号的颜色和库存塞入到对应的型号中
				$colorList = $this->goodsParameterColor( $row['id'] );
				$row['colorList'] = $colorList;

				//剔除不要的信息
				// unset( $row['id'] );
				// unset( $row['gid'] );
				unset( $row['realPrice'] );
				$rowArr[] = $row;
			}
			return $rowArr;
		}

		/*
		* @param $gid 根据商品id查询单个商品
		* @param $gIndex 根据规格索引来定位具体对应的索引商品
		*/ 
		private function goodsRow($gid,$gIndex){
			$pdo = $this->pdo;
			$stmt=$pdo->prepare('SELECT * FROM `goods` WHERE `id`=? LIMIT 0,1');
			$stmt->bindParam(1, $gid);
			$stmt->execute();
			$goodsArr=[];
			while ( $row=$stmt->fetch(PDO::FETCH_ASSOC) ) {

				//合并单个商品的参数，组成详细的商品详情
				$arg = $this->getOnlyGoodsParameter($row['id'], $gIndex);
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
		* @param $gid 根据商品id查询单个商品
		* @param $gIndex 根据规格索引来定位具体对应的索引商品
		*/
		public function goodsRes($gid,$gIndex){

			//单个商品基本信息
			$goods = $this->goodsRow($gid,$gIndex);
			//banner图集
			$banner = $this->goodsBanner($gid);
			//参数列表
			$parameterList = $this->getAllGoodsParameter($gid);

			//判断是否存在该商品
			if ( count($goods) != 0 ) {

				$success = ['code'=> 0, 'msg'=> 'success', 'banner'=> $banner, 'parameterList'=> $parameterList];
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
		
	
	// $_POST['gid'] = 1;
	// $_POST['gIndex'] = 1;
	//判断参数是否有gid和gIndex，有则查询
	if ( isset($_POST['gid']) && isset($_POST['gIndex']) ) 
	{
		$GoodsDetail = new GoodsDetail();	
		$GoodsDetail->goodsRes( $_POST['gid'] , $_POST['gIndex']);
	}else
	{
		exit(json_encode([
			'code'=> -2,
			'msg'=> '请求参数错误！'
		]));
	}


