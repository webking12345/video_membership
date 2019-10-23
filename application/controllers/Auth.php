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
		$this->load->model('membershipdata_model');
		$this->load->helper('url_helper');
		//load session library
		$this->load->library('session');
		if($this->session->userdata('isLoggedIn'))
			redirect("catalogue");
	}

	//log out
	public function logout(){
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
		$data['theme'] = $this->session->userdata("theme")?1:0;
		$data["resource"] = 'auth';

		$this->load->view('header',$data);
		$this->load->view('login', $data);
		$this->load->view('footer', $data);
	}

	public function register()
	{
		$data['theme'] = $this->session->userdata("theme")?1:0;
		$data["resource"] = 'auth';

		$this->load->view('header',$data);
		$this->load->view('register', $data);
		$this->load->view('footer', $data);
	}

	//verify for login
	public function verify(){
		if($_POST){
			$user_data=$this->users_model->getUserData($_POST['username']);
			if($user_data){
				if($user_data->pwd==md5($_POST["pwd"]))
				{
					//set session
					$this->session->set_userdata("user_id", $user_data->id);
					$this->session->set_userdata('isLoggedIn', true);

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

	//check username or email
	public function checkUser(){
		if($_POST){
			$where = array($_POST['name'] => $_POST['val']);

			//for update profile
			if($this->session->userdata('isLoggedIn'))
			{
				$where = array(
					$_POST['name'] => $_POST['val'],
					"id !=" => $this->session->userdata("user_id")
				);
			}
			$verify = $this->users_model->get_where($where);
			if($verify){
				echo "1"; exit;
			}else{
				echo "0"; exit;
			}
		}
		return false;
	}

	// user data register (sign up)
	public function register_user(){
		$user_name = $_POST['username'];
		$email = $_POST['email'];
		$pwd = $_POST['pwd'];
		$user_id = $this->users_model->register_user($user_name, $email, $pwd);
		if($user_id == "already"){
			echo "already";
			return false;
		}
		if($user_id){
			$this->session->set_userdata("user_id", $user_id);
			$this->session->set_userdata('isLoggedIn', true);

			echo 1;
			return true;
		}else{
			echo 0;
			return false;
		}
	}
}

