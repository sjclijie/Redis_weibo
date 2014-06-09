<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		
		$userinfo = $this->session->userdata('username');

		if(!$userinfo){
			$this->load->view('index');
		}else{
			
			$uid = $this->session->userdata('uid');
			
			$weibo_wid = $this->myredis->redis->zRange('weibo_'.$uid, 0 , -1);
				
			print_r($weibo_wid);
			
			$this->load->view('index2');
		}
	}
	
	//发布微博
	public function publish(){
		
		/**
			wid
			uid
			content
			ctim	
			up
			down
		*/
		$weibo = array();
		
		$weibo['wid'] = $this->myredis->redis->get('wid');
		$this->myredis->redis->incr('wid');
		
		$weibo['uid'] = $this->session->userdata('uid');
		$weibo['content'] = $this->input->post('content');
		$weibo['ctime'] = time();
		$weibo['up'] = 0;
		$weibo['down'] = 0;
		
		//插入weibo_uid
		$this->myredis->redis->zAdd('weibo_'.$weibo['uid'], 1,$weibo['wid']);
		
		//插入微博
		$this->myredis->redis->hSet('weibo_content_'.$weibo['wid'],'wid', $weibo['wid']);
		$this->myredis->redis->hSet('weibo_content_'.$weibo['wid'],'uid', $weibo['uid']);
		$this->myredis->redis->hSet('weibo_content_'.$weibo['wid'],'content', $weibo['content']);
		$this->myredis->redis->hSet('weibo_content_'.$weibo['wid'],'ctime', $weibo['ctime']);
		$this->myredis->redis->hSet('weibo_content_'.$weibo['wid'],'up', $weibo['up']);
		$this->myredis->redis->hSet('weibo_content_'.$weibo['wid'],'dowm', $weibo['down']);
	
		redirect('home/index');
	}	
}

