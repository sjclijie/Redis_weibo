<?php

	class Myredis {
		
		public $redis;		

		public function __construct(){
			
			$this->redis = new Redis();
			
			$this->redis->connect('localhost',6379) or die('Redis connection falied.');
		}
	}
