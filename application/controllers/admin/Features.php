<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Features extends CI_Controller {

	/**
	 * Admin for this controller.
	 *	 
	 */
	public function __construct()
	{
		parent::__construct();		
		$this->load->model('feature_model');
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
		if( ! file_exists(APPPATH.'views/admin/features.php'))
        {
			show_404();
		}
		$data['page']='Features';
		$data['resource'] = "features";

		$user_data=$this->users_model->getUserData('',$this->session->userdata("user_id"));
		$data['email'] = $user_data->email;
		
		$setting_data=$this->setting_model->get_all();
		if(count($setting_data) > 0){
			$data['title'] = $setting_data[0]->site_title;
			$data['copyright'] = $setting_data[0]->copyright;
		}

		$data['features'] = $this->feature_model->get_all();

		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar', $data);
		$this->load->view('admin/features', $data);
		$this->load->view('admin/footer', $data);
	}

	public function saveData(){
		$data = array(
			'feature' => $_POST["name"],
			'feature_description' => $_POST["description"],
			'tag' => $_POST["tag"]
		);
		
		if($_POST['id']>0)
			$this->feature_model->update($_POST["id"], $data);
		else
			$this->feature_model->insert($data);
		echo 1;
	}

	public function deleteFeature(){		
		echo $this->feature_model->delete($_POST["id"]);
	}
}

