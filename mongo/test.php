<?php
	
	try{
		$m = new MongoClient('mongodb://192.166.1.38:27017');
		$db = $m->selectDB('good');
	}catch(MongoConnectionException $e){
		exit('数据库连接失败！');
	}
	
	$collection = $db->selectCollection('user');
	
	$cursor = $collection->find()->sort(array('age'=>1));

	
	echo "<pre>";
	foreach($cursor as $item){
		print_r($item);
	}
	echo "</pre>";
