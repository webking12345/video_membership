<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	private static $default_pwd="default_pwd"; 

	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
		$this->load->model('purchase_membership_model');
		$this->load->model('membershiplevel_model');
		$this->load->model('setting_model');
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
		$data['page'] = 'Profile';

		$setting_data=$this->setting_model->get_all();
		if(count($setting_data) > 0){
			$data['title'] = $setting_data[0]->site_title;
			$data['copyright'] = $setting_data[0]->copyright;
		}
		
		$user_data=$this->users_model->getUserData('',$this->session->userdata("user_id"));
		$data["isLoggedIn"]=true;
		$data["username"]=$user_data->username;
		$data["email"]=$user_data->email;

		$data["is_member"] = $this->purchase_membership_model->isMember($this->session->userdata("user_id"));;
		if($data["is_member"])
		{
			$data["remain_days"] = $this->purchase_membership_model->remainDays($this->session->userdata("user_id"));
			$data["is_expired"] = $data["remain_days"]==0;

			$current_membership_data = $this->purchase_membership_model->getData(null, $this->session->userdata("user_id"));
			$data['current_membership'] = $current_membership_data[0];
		}

		$levels= $this->membershiplevel_model->getDataByDuration();
		$data['level'] = $levels;

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
		$data['page'] = 'Join';

		//get features data
		// $features = $this->feature_model->get_all();
		// foreach($features as $f){
		// 	$fdata[$f->id] = $f->feature;
		// }
		// $data['feature'] = $fdata;
		//get membership level data
		$levels= $this->membershiplevel_model->getDataByDuration();
		// foreach($levels as $l){
		// 	$level[$l->id]['name']= $l->level_name;
		// 	$level[$l->id]['price']= $l->price;
		// 	$level[$l->id]['feature']= $l->feature_id;
		// 	$level[$l->id]['timeline']= $l->timeline;
		// }
		$data['level'] = $levels;
		
		$setting_data=$this->setting_model->get_all();
		if(count($setting_data) > 0){
			$data['title'] = $setting_data[0]->site_title;
			$data['copyright'] = $setting_data[0]->copyright;
			$data['description'] = $setting_data[0]->join_description;
		}

		//UserData
		if($this->session->userdata("isLoggedIn"))
		{
			$user_id = $this->session->userdata("user_id");
			$user_data=$this->users_model->getUserData('', $user_id);
			$data["isLoggedIn"]=true;
			$data["username"]=$user_data->username;
			$data["role"]=$user_data->role;
		}
		
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

