<?php 

	$arr1=['code'=>0];
	$arr2=['code'=>-2,'msg'=>'error'];
	$res=array_merge($arr1,$arr2);
	print_r($res);