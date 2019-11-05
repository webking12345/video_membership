<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

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
		if( ! file_exists(APPPATH.'views/admin/profile.php'))
        {
			show_404();
		}
		$data['page']='Profile';
		$data['resource'] = "profile";

		$user_data=$this->users_model->getUserData('',$this->session->userdata("user_id"));
		$data['email'] = $user_data->email;
		
		$setting_data=$this->setting_model->get_all();
		if(count($setting_data) > 0){
			$data['title'] = $setting_data[0]->site_title;
			$data['copyright'] = $setting_data[0]->copyright;
		}

		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar', $data);
		$this->load->view('admin/profile', $data);
		$this->load->view('admin/footer', $data);
	}

	public function saveData(){
		$adminInfo=$this->users_model->getUserData('',$this->session->userdata("user_id"));
		if(md5($_POST['current_pwd'])==$adminInfo->pwd)
		{
			$data = array(
				'pwd' => md5($_POST["new_pwd"]),
			);
			
			echo $this->users_model->update($this->session->userdata("user_id"), $data);
		}
		else{
			echo 0;
		}
	}
}

