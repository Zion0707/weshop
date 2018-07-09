<?php 
	
	require 'Conn.class.php';
	use Weshop\Api\Conn as Conn;

	/**
	* 地址管理类
	*/
	class Address
	{
		private $pdo;
		function __construct()
		{
			$Conn = new Conn();
			$this->pdo = $Conn->connDb();
		}

		/*
		* 更新用户地址
		* @param $id 
		* @param $receiver 收货人姓名
		* @param $phoneNumber 收货人手机号
		* @param $district 省市区
		* @param $address 详细地址
		* @param $isDefaultAddress 是否是默认地址：0表示不是，1表示是
		*/
		public function updateAddress($post){
			
			if ( !isset($post['id']) || !isset($post['receiver']) || !isset($post['phoneNumber']) || !isset($post['district']) || !isset($post['address']) || !isset($post['isDefaultAddress']) ) {
				echo(json_encode([
					'code'=> -2,
					'msg'=> '参数错误！'
				]));
				return;
			}

			$pdo = $this->pdo;
			$sqlParam=[
				':val1'=>$post['id'],
				':val2'=>$post['receiver'],
				':val3'=>$post['phoneNumber'],
				':val4'=>$post['district'],
				':val5'=>$post['address'],
				':val6'=>$post['isDefaultAddress']
			];
			$stmt = $pdo->prepare('UPDATE `address` SET `receiver`=:val2 , `phoneNumber`=:val3 , `district`=:val4 , `address`=:val5 , `isDefaultAddress`=:val6 WHERE `id`=:val1');
			
			//判断是否更新成功
			if ( $stmt->execute($sqlParam) ) {
				echo(json_encode([
					'code'=> 0,
					'msg'=> '更新成功！'
				]));
			}else{
				echo(json_encode([
					'code'=> -2,
					'msg'=> '更新失败！'
				]));
			}

		} 

		/*
		* 删除用户地址
		* @param $id
		*/ 
		public function delAddress($post){

			if ( !isset($post['id']) ) {
				echo(json_encode([
					'code'=> -2,
					'msg'=> '参数错误！'
				]));
				return;
			}

			$pdo = $this->pdo;
			$sqlParam = [
				':val1'=> $post['id'] 
			];
			$stmt = $pdo->prepare('UPDATE `address` SET `status`=1 WHERE `id`=:val1');
			$stmt->execute($sqlParam);
			//判断是否更新成功
			if ( $stmt->rowCount() > 0 ) {
				echo(json_encode([
					'code'=> 0,
					'msg'=> '删除成功！'
				]));
			}else{
				echo(json_encode([
					'code'=> -2,
					'msg'=> '删除失败！'
				]));
			}
		}

		/*
		* 新增用户地址
		* @param $receiver 收货人姓名
		* @param $phoneNumber 收货人手机号
		* @param $district 省市区
		* @param $address 详细地址
		* @param $isDefaultAddress 是否是默认地址：0表示不是，1表示是
		*/ 
		public function addAddress($post){
			$Conn = new Conn();
			$Conn->checkLogin();

			if ( !isset($post['receiver']) || !isset($post['phoneNumber']) || !isset($post['district']) || !isset($post['address']) || !isset($post['isDefaultAddress']) ) {
				echo(json_encode([
					'code'=> -2,
					'msg'=> '参数错误，无法添加！'
				]));
				return;
			}

			$pdo = $this->pdo;
			$stmt= $pdo->prepare('INSERT INTO `address`(`receiver`,`phoneNumber`,`district`,`address`,`isDefaultAddress`,`uid`) VALUES (?,?,?,?,?,?)');
			$stmt->bindParam(1, $post['receiver']);			
			$stmt->bindParam(2, $post['phoneNumber']);			
			$stmt->bindParam(3, $post['district']);			
			$stmt->bindParam(4, $post['address']);			
			$stmt->bindParam(5, $post['isDefaultAddress']);		
			$stmt->bindParam(6, $_SESSION['uid']);		
		
			if( $stmt->execute() ){
				echo(json_encode([
					'code'=> 0,
					'msg'=> '新增成功！'
				]));
			}else{
				echo(json_encode([
					'code'=> -2,
					'msg'=> '新增失败！'
				]));
			}
		}

		/*
		* 获取用户收货地址
		*/ 
		public function getAddress($post){
			$Conn = new Conn();
			$Conn->checkLogin();

			if ( !isset($post['pageNo']) || !isset($post['pageSize']) ) {
				echo(json_encode([
					'code'=> -2,
					'msg'=> '参数错误！'
				]));
				return;
			}

			$pdo = $this->pdo;
			$stmt = $pdo->prepare('SELECT * FROM `address` WHERE `uid`=? AND `status`=0 LIMIT ?,?');

			$pageSize = (int)$post['pageSize'];
			$pageNo = ( (int)$post['pageNo'] - 1 ) * $pageSize;

			$stmt->bindParam(1, $_SESSION['uid']);
			$stmt->bindParam(2, $pageNo, PDO::PARAM_INT);
			$stmt->bindParam(3, $pageSize, PDO::PARAM_INT);
			$stmt->execute();
			$rowArr=[];

			while( $row=$stmt->fetch(PDO::FETCH_ASSOC) ){
				// unset( $row['id'] );
				unset( $row['uid'] );
				$rowArr[]=$row;
			}

			echo(json_encode([
				'code'=> 0,
				'msg'=> 'success',
				'addressList'=> $rowArr
			]));
		}
	}



	if ( isset($_POST) ) {
		$Address = new Address();

		switch ($_POST['type']) {
			case 'getAddress':
				$Address->getAddress($_POST);
			break;
			case 'addAddress':
				$Address->addAddress($_POST);
			break;
			case 'delAddress':
				$Address->delAddress($_POST);
			break;
			case 'updateAddress':
				$Address->updateAddress($_POST);
			break;
		}

	}










