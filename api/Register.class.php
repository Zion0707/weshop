<?php 
		
	require 'Conn.class.php';
	use Weshop\Api\Conn as Conn;

	/**
	* 注册类
	*/
	class Register
	{ 
		/**
		* @param $post 是注册传递过来的值
		*/
		public function registerInput($post){
			//获取对象参数
			$postData = json_decode(json_encode($post));

			$username = trim($postData->username);
			$password = trim($postData->password);

			//判断参数是否正确
			if ( $username && $password ) {
				$Conn = new Conn();
				$pdo = $Conn->connDb();
				
				//判断用户是否已经注册过
				$stmt = $pdo->prepare('SELECT `username` FROM user_info WHERE `username`=?');
				$stmt->bindParam(1, $username);
				$stmt->execute();
				$userArr = [];
				while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
					$userArr[] = $row;
				}
				//判断用户数量
				if ( count($userArr) ) {
					echo json_encode([
						'code'=> -2,
						'msg'=> '该用户名已经注册过！'
					]);
					return;
				}


				//注册新用户
				$stmt = $pdo->prepare('INSERT INTO user_info (`username`,`password`,`createTime`) VALUES (?,?,?)');				
				$psw = md5($password);
				$createTime = time();
				$stmt->bindParam(1, $username);
				$stmt->bindParam(2, $psw);
				$stmt->bindParam(3, $createTime);
				if ( $stmt->execute() ) {

					
					//根据username查询uid
					$stmt = $pdo->prepare('SELECT * FROM user_info WHERE `username`=?');
					$stmt->bindParam(1, $username);
					$stmt->execute();

					//设置 session 1小时过期时间 和 用户uid
					if (!session_id()) session_start();
					$_SESSION['expireTime'] = time() + 3600;

					while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){						
						$_SESSION['uid'] = $row['id'];
					}

					echo json_encode([
						'code'=> 0,
						'msg'=> '恭喜您注册成功！'
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
		$Register = new Register();
		$Register->registerInput($_POST);	
	}