<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    public function index()
    {
        $uid = $this->session->userdata('uid');
        $username = $this->session->userdata('username');
        if(empty($uid) || empty($username)){
            $this->load->view('login');
        }
        else{
            echo "<script>location='".site_url()."'</script>";
        }
    }

    public function dologin(){
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        $uid =  $this->myredis->redis->get($username);

        if(intval($uid) > 0){
            $pwd = $this->myredis->redis->hget("user_$uid",'password');
            if(md5($password) == $pwd){
                $this->session->set_userdata('uid',$uid);
                $this->session->set_userdata('username',$username);
                echo "<script>alert('OK');location='".site_url()."'</script>";
            }
        }
        echo "<script>alert('error');location='".site_url('login')."'</script>";
    }

    public function logout(){
        $this->session->set_userdata('uid','');
        $this->session->set_userdata('username','');
        echo "<script>alert('OK');location='".site_url()."'</script>";
    }


}

