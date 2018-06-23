<?php 
		
	require 'Conn.class.php';
	use Weshop\Api\Conn;

	/**
	* 退出登录
	*/
	class Logout
	{
		public function userLogout()
		{	
			//清除所有session
			if (!session_id()) session_start();
			session_destroy();

			exit( json_encode([
				'code'=> 0,
				'msg'=> '退出成功！'
			]) );
		}
	}


	$Logout = new Logout();
	$Logout->userLogout();