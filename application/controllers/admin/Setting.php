<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

	/**
	 * Admin for this controller.
	 *	 
	 */
	public function __construct()
	{
		parent::__construct();		
		$this->load->model('users_model');
		$this->load->model('setting_model');
		$this->load->helper('url_helper');
		$this->load->library('session');

		//UserData
		if($this->session->userdata("isLoggedIn"))
		{
			$user_data=$this->users_model->getUserData('',$this->session->userdata("user_id"));
			if($user_data->role==2)
				redirect("auth/login");
		}
		else{
			redirect("auth/login");
		}
	}
	public function index()
	{
		if( ! file_exists(APPPATH.'views/admin/setting.php'))
        {
			show_404();
		}
		$data['page']='Setting';
		$data['resource'] = "setting";

		$user_data=$this->users_model->getUserData('',$this->session->userdata("user_id"));
		$data['email'] = $user_data->email;

		$setting_data=$this->setting_model->get_all();
		if(count($setting_data) > 0){
			$data['title'] = $setting_data[0]->site_title;
			$data['copyright'] = $setting_data[0]->copyright;
			$data['welcome'] = $setting_data[0]->welcome_text;
			$data['register_description1'] = $setting_data[0]->register_description1;
			$data['register_description2'] = $setting_data[0]->register_description2;
			$data['login_description'] = $setting_data[0]->login_description;
			$data['join_description'] = $setting_data[0]->join_description;
		}

		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar', $data);
		$this->load->view('admin/setting', $data);
		$this->load->view('admin/footer', $data);
	}

	//Save site title and copyright
	public function saveHeaderFooter(){
		$setting_data=$this->setting_model->get_all();

		$data=array(
			"site_title" => $_POST['title'],
			"copyright" => $_POST['copyright']
		);

		if(count($setting_data) > 0){
			echo $this->setting_model->update($setting_data[0]->id, $data);
		} else {
			echo $this->setting_model->insert($data);
		}
	}

	//Save welcome text of Home Page
	public function saveHome(){
		$setting_data=$this->setting_model->get_all();

		$data=array(
			"welcome_text" => $_POST['welcome']
		);

		if(count($setting_data) > 0){
			echo $this->setting_model->update($setting_data[0]->id, $data);
		} else {
			echo $this->setting_model->insert($data);
		}
	}

	//Save descriptions of Register Page
	public function saveRegister(){
		$setting_data=$this->setting_model->get_all();

		$data=array(
			"register_description1" => $_POST['register_description1'],
			"register_description2" => $_POST['register_description2']
		);

		if(count($setting_data) > 0){
			echo $this->setting_model->update($setting_data[0]->id, $data);
		} else {
			echo $this->setting_model->insert($data);
		}
	}

	//Save descriptions of Login Page
	public function saveLogin(){
		$setting_data=$this->setting_model->get_all();

		$data=array(
			"login_description" => $_POST['login_description']
		);

		if(count($setting_data) > 0){
			echo $this->setting_model->update($setting_data[0]->id, $data);
		} else {
			echo $this->setting_model->insert($data);
		}
	}

	//Save descriptions of Join Page
	public function saveJoin(){
		$setting_data=$this->setting_model->get_all();

		$data=array(
			"join_description" => $_POST['join_description']
		);

		if(count($setting_data) > 0){
			echo $this->setting_model->update($setting_data[0]->id, $data);
		} else {
			echo $this->setting_model->insert($data);
		}
	}
}

