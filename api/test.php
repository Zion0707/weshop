<?php 
	
	try {
		$pdo=new PDO('mysql:host=localhost:3306;dbname=weshop','root','Zion');
	} catch (PDOException $e) {
		die( $e->getMessage() );
	}

	//设置为debug模式
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//设置为utf8
	$pdo->exec('set names utf8');

	$stmt=$pdo->prepare('SELECT * FROM `goods` LIMIT 0,1');
	$stmt->execute();
	$arr=[];
	while( $row=$stmt->fetch(PDO::FETCH_ASSOC) ){
		$arr[] = $row;
	}

	exit('<img src="'.$arr[0]['cover'].'">');