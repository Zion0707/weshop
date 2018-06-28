<?php 
		
	require 'Conn.class.php';
	use Weshop\Api\Conn as Conn;

	/**
	* 注册类
	*/
	class Register
	{ 

		private $pdo;
		public function __construct()
		{
			$Conn = new Conn();
			$this->pdo = $Conn->connDb();
		}	

		/*
		* 判断用户是否已经注册
		* @return 查询用户的数量
		*/ 
		private function isRegister($pdo, $username){
			$stmt = $pdo->prepare('SELECT `username` FROM user_info WHERE `username`=?');
			$stmt->bindParam(1, $username);
			$stmt->execute();
			$userArr = [];
			while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
				$userArr[] = $row;
			}
			return $userArr;
		}

		
		/*
		* 注册新用户
		* @param $pdo PDO 对象
		*/ 
		private function registerNewUser($pdo, $username ,$password){
			//注册新用户
			$stmt = $pdo->prepare('INSERT INTO user_info (`username`,`password`,`createTime`) VALUES (?,?,?)');			
			//这里使用用户名和密码作为md5加密，即使两个人密码相同但是用户名不一样，也会生成不一样的密码	
			$psw = md5( $username.$password );
			$createTime = time();
			$stmt->bindParam(1, $username);
			$stmt->bindParam(2, $psw);
			$stmt->bindParam(3, $createTime);
			return $stmt->execute();
		}

		/*
		* 创建购物车
		* @param $pdo PDO 对象
		* @param $uid 用户id
		*/ 
		private function createCar($pdo, $uid){
			$stmt = $pdo->prepare('INSERT INTO shop_car (`uid`, `createTime`) VALUES (?,?) ');
			$stmt->bindParam(1, $uid);
			$createTime = time();
			$stmt->bindParam(2, $createTime);
			return $stmt->execute();
		}	

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
				$pdo = $this->pdo;

				//判断用户是否已经注册过
				$userArr = $this->isRegister($pdo, $username);
				if ( count($userArr) ) {
					exit( json_encode([
						'code'=> -2,
						'msg'=> '该用户名已经注册过！'
					]) );
				}
				
				
				if ( $this->registerNewUser($pdo, $username, $password) ) {		
					
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

					//创建购物车
					$this->createCar($pdo, $_SESSION['uid']);

					exit( json_encode([
						'code'=> 0,
						'msg'=> '恭喜您注册成功！'
					]) );
				}
				
			}else{
			
				exit( json_encode([
					'code'=> -2,
					'msg'=>'用户名和密码不能为空，注册失败！'
				]) );
			
			}
		}
	}


	if ( isset($_POST) ) {
		$Register = new Register();
		$Register->registerInput($_POST);	
	}