<?php 
	
	require 'Conn.class.php';
	use Weshop\Api\Conn as Conn;

	/**
	* 登录类
	*/
	class Login
	{
		/*
		* @param $post 获取用户名和密码
		* 
		*/ 
		public function loginInput($post){
			//获取对象参数
			$postData = json_decode(json_encode($post));
			$username = trim( $postData->username );
			$password = trim( $postData->password );

			if ( $username && $password ) {
				$Conn = new Conn();
				$pdo = $Conn->connDb();

				$stmt = $pdo->prepare('SELECT * FROM user_info WHERE `username`=? AND `password`=?');

				$stmt->bindParam(1, $username);
				$stmt->bindParam(2, md5($password));
				$stmt->execute();
				$rowArr = [];

				while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
					$rowArr[] = $row;
				}

				//判断是否存在
				if ( count($rowArr) ) {

					//设置 session 1小时过期时间 和 用户uid
					if (!session_id()) session_start();
					$_SESSION['expireTime'] = time() + 3600;
					$_SESSION['uid'] = $rowArr[0]['id'];

					echo json_encode([
						'code'=> 0,
						'msg'=> '登录成功！'
					]);
				}else{
					echo json_encode([
						'code'=> -2,
						'msg'=> '账号或密码错误！'
					]);
				}

			}else{
				echo json_encode([
					'code'=> -2,
					'msg'=>'参数非法，注册失败！'
				]);
			}
		}
	}


	if ( isset($_POST) ) {
		$Login = new Login();
		$Login->loginInput($_POST);	
	}