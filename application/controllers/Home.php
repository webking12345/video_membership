<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Home Page for this controller.
	 *	 
	 */

	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
		$this->load->model('category_model');
		$this->load->model('history_model');
		$this->load->helper('url_helper');
		$this->load->library('session');
	}
	/**
	 * 
	 * @param int $theme  theme=0: dark theme, theme=1: bright theme
	 */
	public function index()
	{
		if( ! file_exists(APPPATH.'views/home.php'))
        {
			// Whoops, we don't have a page for that!
			show_404();
		}
		//keep theme
		if($this->session->userdata("theme")){
			$data['theme'] = "1";
		}else{
			$data['theme'] = "0";
		}
		
		//UserData
		if($this->session->userdata("isLoggedIn"))
		{
			$user_id = $this->session->userdata("user_id");
			$user_data=$this->users_model->getUserData('', $user_id);
			$data["isLoggedIn"]=true;
			$data["username"]=$user_data->username;
			$data["role"]=$user_data->role;

			//save history
			// $this->history_model->addHistory($user_id, 4, 'visit home page', $this->input->ip_address()); // 2nd prams -> 1: register, 2: login, 3:logout, 4: visit page, 5: join membership, 6: purchase contents
		} else {
			// $this->history_model->addHistory('', 4, 'visit home page', $this->input->ip_address()); // 2nd prams -> 1: register, 2: login, 3:logout, 4: visit page, 5: join membership, 6: purchase contents
		}

		$all_category = $this->category_model->getData();
		$data['all_category'] = $all_category;
		$data['resource']='home';
		
		$this->load->view('header',$data);
		$this->load->view('home',$data);
		$this->load->view('footer',$data);
	}
}

