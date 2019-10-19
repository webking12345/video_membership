<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

	/**
	 * Home Page for this controller.
	 *	 
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	}
	/**
	 * 
	 * @param int $theme  theme=0: dark theme, theme=1: bright theme
	 */
	public function index()
	{
		show_404();
	}

	//set theme session
	public function set_theme(){
		if($_POST['theme']){
			$this->session->set_userdata('theme', 'checked');
		}else{
			$this->session->set_userdata('theme', '');
		}
		echo true;
	}
}

