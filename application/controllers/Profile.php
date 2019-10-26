<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	private static $default_pwd="default_pwd"; 

	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
		$this->load->model('membershipdata_model');
		$this->load->model('membershiplevel_model');
		$this->load->model('feature_model');
		$this->load->helper('url_helper');
		//load session library
		$this->load->library('session');
	}

	public function index()
	{
		if(!$this->session->userdata("isLoggedIn"))
			redirect("auth/login");

		$data['theme'] = $this->session->userdata("theme")?1:0;
		$data["resource"] = 'profile';

		$user_data=$this->users_model->getUserData('',$this->session->userdata("user_id"));
		$data["isLoggedIn"]=true;
		$data["username"]=$user_data->username;
		$data["email"]=$user_data->email;

		$is_member = $this->membershipdata_model->isMember($this->session->userdata("user_id"));
		
		$data["is_member"]=$is_member;
		$data["membership_end_date"]=$is_member?$this->membershipdata_model->caculateUserMembershipEndDate($this->session->userdata("user_id")):'';

		$data["default_pwd"]=self::$default_pwd;
		$data["role"]=$user_data->role;

		$this->load->view('header',$data);
		$this->load->view('profile', $data);
		$this->load->view('footer', $data);
	}

	public function join()
	{
		$data['theme'] = $this->session->userdata("theme")?1:0;
		$data["resource"] = 'join';

		//get features data
		$features = $this->feature_model->get_all();
		foreach($features as $f){
			$fdata[$f->id] = $f->feature;
		}
		$data['feature'] = $fdata;
		//get membership level data
		$levels= $this->membershiplevel_model->get_all();
		foreach($levels as $l){
			$level[$l->id]['name']= $l->level_name;
			$level[$l->id]['price']= $l->price;
			$level[$l->id]['feature']= $l->feature_id;
			$level[$l->id]['timeline']= $l->timeline;
		}
		$data['level'] = $level;
		
		$this->load->view('header',$data);
		$this->load->view('join', $data);
		$this->load->view('membership', $data);
		$this->load->view('footer', $data);
	}

	public function update()
	{
		$data = array(
			'email' => $_POST["email"],
		);
		if($_POST['pwd'] != self::$default_pwd)
		{
			$data = array(
				'email' => $_POST["email"],
				'pwd' => md5($_POST["pwd"])
			);
		}

		$this->users_model->update($this->session->userdata("user_id"), $data);
		echo 1;
	}
}

