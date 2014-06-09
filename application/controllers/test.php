<?php

	class Test extends CI_Controller{
		
		public function index(){
			print_r($this->myredis->redis->info());			
		}
	}
