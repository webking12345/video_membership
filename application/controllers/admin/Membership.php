<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Membership extends CI_Controller {

	/**
	 * Admin for this controller.
	 *	 
	 */
	public function __construct()
	{
		parent::__construct();		
		$this->load->model('feature_model');
		$this->load->model('membershiplevel_model');
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
		if( ! file_exists(APPPATH.'views/admin/membership.php'))
        {
			show_404();
		}
		$data['page']='Membership';
		$data['resource'] = "membership";
		
		$user_data=$this->users_model->getUserData('',$this->session->userdata("user_id"));
		$data['email'] = $user_data->email;

		$setting_data=$this->setting_model->get_all();
		if(count($setting_data) > 0){
			$data['title'] = $setting_data[0]->site_title;
			$data['copyright'] = $setting_data[0]->copyright;
		}
		
		$data['features'] = $this->feature_model->get_all();
		$data['levels'] = $this->membershiplevel_model->get_all();

		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar', $data);
		$this->load->view('admin/membership', $data);
		$this->load->view('admin/footer', $data);
	}

	public function saveLevel(){
		$data = array(
			'level_name' => $_POST["name"],
			'description' => $_POST["description"],
			'timeline' => $_POST["timeline"],
			'price' => $_POST["price"]
		);
		
		if($_POST['id']>0)
			$this->membershiplevel_model->update($_POST["id"], $data);
		else
			$this->membershiplevel_model->insert($data);
		echo 1;
	}

	public function updateMembership(){
		$ids=explode("_", $_POST['id']);
		$level_id=$ids[0];
		$feature_id=$ids[1];

		$level=$this->membershiplevel_model->get_by_id($level_id);
		$feature_list=explode(",", $level->feature_id);

		if(in_array($feature_id, $feature_list))
		{
			if (($key = array_search($feature_id, $feature_list)) !== false) {
				unset($feature_list[$key]);
			}
		}else{
			array_push($feature_list, $feature_id);
		}

		$data = array(
			'feature_id' => implode(",", $feature_list)
		);
		
		$this->membershiplevel_model->update($level_id, $data);

		echo 1;
	}

	public function deleteLevel(){		
		echo $this->membershiplevel_model->delete($_POST["id"]);
	}
}

