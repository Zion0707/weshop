<?php 

	//命名空间
	namespace Weshop\Api;
	//用了main，就相当于取main目录下面的PDO了，但是PDO是PHP带的，不在main里，所以需要注册一下使用use PDO;
	use PDO; 

	//允许跨域请求
	// header('Access-Control-Allow-Origin: '.$_SERVER['HTTP_ORIGIN']);
	header('Access-Control-Allow-Credentials: true');

	// header('Access-Control-Allow-Origin: *');
	// header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
	// header('Access-Control-Allow-Methods: GET, POST, PUT,DELETE');

	//设置默认时间为中国上海标准时间
	date_default_timezone_set("Asia/Shanghai");

	/*
	 * @param 公共接口内容
	*/ 
	class Conn
	{
		private $pdo;

		// 判断SESSION过期时间
		public function checkLogin(){
			//判断是否存在expireTime，并且是否已经过期，如果过期直接返回首页
			if (!session_id()) session_start();
			if ( isset($_SESSION['expireTime']) ) {
				if ( $_SESSION['expireTime'] < time() ) {
					//销毁全部session
					unset($_SESSION);
					exit(json_encode([
							'code'=> -1,
							'msg'=>'您还未登录，请先登录哦！'
						]));
				}
			}else{
				exit(json_encode([
						'code'=> -1,
						'msg'=>'您还未登录，请先登录哦！'
					]));
			}
		}

		//连接 pdo 数据库
		public function connDb(){
			try {
				$this->pdo = new PDO('mysql:host=localhost:3306;dbname=weshop','root','Zion');
			} catch (PDOException $e) {
				die( $e->getMessage() );
			}

			//设置为debug模式
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//设置为utf8
			$this->pdo->exec('set names utf8');
			return $this->pdo;
		}
	}
