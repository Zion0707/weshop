<?php 
	
	require 'Conn.class.php';
	use Weshop\Api\Conn as Conn;


	/**
	* 用户信息操作类
	*/
	class UserInfo
	{	
		//获取用户信息
		public function getUserInfo(){
			
			if (!session_id()) session_start();
			// $_SESSION['uid'] = 'Zion';
			exit( $_SESSION['uid'] );
		
		}
	}



	$UserInfo = new UserInfo();
	$UserInfo->getUserInfo();
