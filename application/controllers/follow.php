<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Follow extends CI_Controller {
	var $uid ;
	var $mid;
	var $user_key;//会员信息key
	var $weibo_uid_key;//微博uid key
	var $weibo_wid_key; //微博内容ID;
	var $follow_uid_key; //微博关注uid

	public function __construct()
	{
		parent::__construct();
		/*if (is_null($_SESSION['uid'])) {
			if ( $_SERVER['QUERY_STRING'])
			{
				$redirect .= '?' . $_SERVER['QUERY_STRING'];
			}
			redirect('register/login');
		}*/
		$this->uid =  intval($this->input->get("uid")); 
		$this->mid = "12";
		$this->user_key = "user_".$this->uid;
//		$uid = $_SESSION['uid']?$_SESSION['uid']:"1";
	}

	public function index()
	{
		$data = array();
		$data['title'] = "我的关注"; 
		$data['username'] = $this->myredis->redis->hget("user_".$this->uid,"username");
		$data['weibo']  ="1";
		$data['follow']  ="2";
		
		$this->getUserWeibo($this->uid); 
		print_r($data);
		$userInfo = array();
		$userInfo['uid'] = "12";
		$userInfo['username'] = "老张";
		$userInfo['pwd'] = "12";
		$this->myredis->redis->HMSET($this->user_key ,$userInfo);
		
//		print_r($this->myredis->redis->info());
		$this->load->view('follow',$data);

	}

	//获取用户信息
	private function getUserInfo($uid)
	{
		//$this->myredis->redis->
	}
	
	//关注某人
	public function doFollow()
	{
		$uid = $this->input->post("uid");
		$doing = $this->input->post("doing");
	}
	
	//获取用户微博内容
	public function getUserWeibo($uid)
	{
		$weiboID_arr = array();
		$this->weibo_uid_key = "weibo_".$this->uid;
		$weiboID_arr = $this->myredis->redis->sMembers($this->weibo_uid_key);
		
		//print_r($weiboID_arr);
	}
	
	//是否关注某人
	public function isFollow($mid,$uid)
	{
		
	}
	
	
	
	
	
	
	

}

