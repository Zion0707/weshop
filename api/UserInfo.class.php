<?php 
	
	require 'Conn.class.php';
	use Weshop\Api\Conn as Conn;


	/**
	* 用户信息操作类
	*/
	class UserInfo
	{	

		/**
		* @param $uid 用户id
		*/
		public function getUserRow($uid){

			$Conn = new Conn();
			$pdo = $Conn->connDb();

			$stmt = $pdo->prepare('SELECT * FROM user_info WHERE id=?');
			$stmt->bindParam(1, $uid);
			$stmt->execute();

			$rowArr=[];
			while( $row = $stmt->fetch(PDO::FETCH_OBJ) ) {
				$rowArr[] = $row;
			}

			return $rowArr[0];
		}

		//获取用户信息
		public function getUserInfo(){

			$Conn = new Conn();
			$Conn->checkLogin();

			$resObj = $this->getUserRow( $_SESSION['uid'] );
			//剔除不要的属性和值
			unset($resObj->password);
			$resObj->code = 0;
			$resObj->msg = 'success';
			$resObj->createTime = date('Y-m-d H:i:s', $resObj->createTime);

			exit(json_encode($resObj));
			
			
		}
	}



	if( isset($_POST) ) 
	{
		if ( $_POST['type'] == 'get' ) 
		{
			$UserInfo = new UserInfo();
			$UserInfo->getUserInfo();
		}
	}
