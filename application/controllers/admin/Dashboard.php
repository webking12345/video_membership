<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	/**
	 * Admin for this controller.
	 *	 
	 */
	public function __construct()
	{
		parent::__construct();		
		$this->load->model('users_model');		
		$this->load->model('contents_model');		
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
		if( ! file_exists(APPPATH.'views/admin/dashboard.php'))
        {
			show_404();
		}

		$user_data=$this->users_model->getUserData('',$this->session->userdata("user_id"));
		$data['email'] = $user_data->email;

		$setting_data=$this->setting_model->get_all();
		if(count($setting_data) > 0){
			$data['title'] = $setting_data[0]->site_title;
			$data['copyright'] = $setting_data[0]->copyright;
		}
		
		$data["user"] = $this->session->userdata('user');
		
		$data['page']='Dashboard';
		$data['totalUsers']=count($this->users_model->getUsersData());
		
		$data['totalContents']=count($this->contents_model->getContents());
		$data['totalVideos']=count($this->contents_model->getContents('', '', '', '', 3));
		$data['totalPDFs']=count($this->contents_model->getContents('', '', '', '', 4));

		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar', $data);
		$this->load->view('admin/dashboard');
		$this->load->view('admin/footer', $data);
	}
}

