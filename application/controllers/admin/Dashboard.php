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
		$this->load->model('purchase_membership_model');
		$this->load->model('balance_model');
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
		$data['resource']='dashboard';

		$data['totalUsers']=count($this->users_model->getUsersData());
		$data['totalMembers']=count($this->purchase_membership_model->get_all());
		
		$data['totalContents']=count($this->contents_model->getContents());
		$data['totalVideos']=count($this->contents_model->getContents('', '', '', '', 3));
		$data['totalPDFs']=count($this->contents_model->getContents('', '', '', '', 4));

		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar', $data);
		$this->load->view('admin/dashboard');
		$this->load->view('admin/footer', $data);
	}

	public function getBalance(){
		$rows = $this->balance_model->getAllData();
		$data = array();
		foreach ($rows as $key => $row) {
			$data[] = array(
				'DT_RowId'=> $row->id,
				'no'=>$key + 1,
				'name'=>$row->name,
				'email'=>$row->email,
				'amount'=>$row->in_amount,
				'description'=>$row->in_description,
				'date'=>$row->in_date
			);
		}

		echo json_encode($data);
	}
}

