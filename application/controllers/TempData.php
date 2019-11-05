<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TempData extends CI_Controller {

	/**
	 * Temp Data controller.
	 *	 
	 */
	public function __construct()
	{
		parent::__construct();
       $this->load->model("users_model");
       $this->load->model("purchase_membership_model");
       $this->load->model("purchase_contents_model");
       $this->load->model("history_model");
	   $this->load->library('session');
       $this->load->helper('url');
	}

	public function index()
	{
		$this->session->unset_userdata('tmp');
		show_404();
	}

	//store temp data
	public function storeTempData(){
		$tmp_data = array();
		if(!is_null($this->session->userdata('tmp')))
			$tmp_data = $this->session->userdata('tmp');

		$new_data = array();
		foreach ($_POST as $key => $value) {
			$new_data[$key] = $value;
		}
		$tmp_data[] = $new_data;

		$this->session->set_userdata('tmp',$tmp_data);
		echo 1;
	}

	//save tempdata to database and clear temp
	public function saveData(){
		foreach ($this->session->userdata('tmp') as $key => $tmp) {
			$new_data=array();
			foreach ($tmp as $column => $value) {
				if($column != "table")
				{
					if($column == "pwd")
						$new_data[$column] = md5($value);
					else
						$new_data[$column] = $value;
				}
			}
			//register user in the case to join with register.
			if($tmp['table'] == "users"){
				$user_id = $this->users_model->insert($new_data);
				$this->session->set_userdata("user_id", $user_id);
				$this->session->set_userdata('isLoggedIn', true);
				$this->history_model->addHistory($user_id, 1, 'register', $this->input->ip_address()); // 2nd prams -> 1: register, 2: login, 3:logout, 4: visit page, 5: join membership, 6: purchase contents
			}

			//save purchase membership data
			if($tmp['table'] == "purchase_membership")
			{
				$new_data['user_id'] = $this->session->userdata("isLoggedIn") ? $this->session->userdata("user_id") : $user_id;
				$this->purchase_membership_model->insert($new_data);
				$this->history_model->addHistory($new_data['user_id'], 5, 'purchase membership', $this->input->ip_address()); // 2nd prams -> 1: register, 2: login, 3:logout, 4: visit page, 5: join membership, 6: purchase contents
			}

			//save purchase contents data
			if($tmp['table'] == "purchase_contents")
			{
				$new_data['user_id'] = $this->session->userdata("user_id");
				$this->purchase_contents_model->insert($new_data);
				$this->history_model->addHistory($new_data['user_id'], 6, 'purchase content', $this->input->ip_address()); // 2nd prams -> 1: register, 2: login, 3:logout, 4: visit page, 5: join membership, 6: purchase contents
			}
		}
		$this->session->unset_userdata('tmp');
		
		$redirect_url=$this->session->userdata('redirect_url');
		$this->session->unset_userdata('redirect_url');

		redirect($redirect_url, 'refresh');
	}
}

