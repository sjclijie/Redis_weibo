<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

    public function index()
    {
        $this->load->view('register');
    }

    public function doreg(){
        $this->myredis->redis->incr('uid');

        $uid = $this->myredis->redis->get('uid');
        $username = $this->input->post("username");
        $email = $this->input->post("email");
        $password = $this->input->post("password");

        $this->myredis->redis->set($username,$uid);
        $this->myredis->redis->hset("user_$uid",'uid',$uid);
        $this->myredis->redis->hset("user_$uid",'username',$username);
        $this->myredis->redis->hset("user_$uid",'email',$email);
        $this->myredis->redis->hset("user_$uid",'password',md5($password));

        $this->session->set_userdata('uid',$uid);
        $this->session->set_userdata('username',$username);
        echo "<script>alert('OK');location='".site_url()."'</script>";


    }


}

