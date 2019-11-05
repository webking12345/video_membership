<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	/**
	 * Admin for this controller.
	 *	 
	 */
	public function __construct()
	{
		parent::__construct();		
		$this->load->model('category_model');
		$this->load->model('users_model');		
		$this->load->model('membershiplevel_model');		
		$this->load->model('purchase_membership_model');		
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
		if( ! file_exists(APPPATH.'views/admin/users.php'))
        {
			show_404();
		}
		$data['page']='Users';
		$data['resource'] = "users";
		
		$user_data=$this->users_model->getUserData('',$this->session->userdata("user_id"));
		$data['email'] = $user_data->email;

		$setting_data=$this->setting_model->get_all();
		if(count($setting_data) > 0){
			$data['title'] = $setting_data[0]->site_title;
			$data['copyright'] = $setting_data[0]->copyright;
		}

		$data['users'] = $this->users_model->getUsersData();
		$data['membership_levels'] = $this->membershiplevel_model->get_all();

		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar', $data);
		$this->load->view('admin/users', $data);
		$this->load->view('admin/footer', $data);
	}

	/**
	 * get user data by id
	 */
	public function getuserdata(){
		
		$this->load->model('users_model');
		if($_POST["id"]){
			$return = $this->users_model->get_by_id($_POST['id']);
		}
		echo json_encode($return);		
	}

	/**
	 *  update user data
	 */
	public function update_user(){
		if($_POST["membership"] > 0)
			$this->purchase_membership_model->saveData($_POST["id"], $_POST["membership"]);

		if($_POST['password']){
			$data = array(
				'username' => $_POST["name"],
				'email' => $_POST["email"],
				'role' => $_POST["role"],
				'allow' => $_POST["allow"],
				'pwd' => md5($_POST["password"])
			);
		}else{
			$data = array(
				'username' => $_POST["name"],
				'email' => $_POST["email"],
				'role' => $_POST["role"],
				'allow' => $_POST["allow"]
			);
		}
		$this->users_model->update($_POST["id"], $data);
		echo 1;
	}
	/**
	 * user data delete
	 */
	public function user_del(){		
		$this->load->model('users_model');
		$return = $this->users_model->delete($_POST["id"]);
		echo $return;
	}
}

