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
			if (!session_id()) session_start();
			$Conn = new Conn();
			$Conn->checkLogin();

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

			if (!session_id()) session_start();
			if ( isset($_SESSION['uid']) ) {

				$resObj = $this->getUserRow( $_SESSION['uid'] );
				//剔除不要的属性和值
				unset($resObj->password);
				$resObj->code = 0;
				$resObj->msg = 'success';
				$resObj->createTime = date('Y-m-d H:i:s', $resObj->createTime);

				exit(json_encode($resObj));
			}else{
				exit(json_encode([
					'code'=> -2,
					'msg'=> '用户信息获取失败，请重新登录！'
				]));
			}
			
		}
	}



	$UserInfo = new UserInfo();
	$UserInfo->getUserInfo();
