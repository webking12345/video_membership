<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home1 extends CI_Controller {

	/**
	 * Home Page for this controller.
	 *	 
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('category_model');
		$this->load->helper('url_helper');
		$this->load->library('session');
	}
	/**
	 * 
	 * @param int $theme  theme=0: dark theme, theme=1: bright theme
	 */
	public function index()
	{
		if( ! file_exists(APPPATH.'views/home/home.php'))
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
		
		$data['resource'] = 'home';		
		//get parent category
		$id = "parent";
		$all_category = $this->category_model->getData();
		$data['all_category'] = $all_category;
		$this->load->view('home/header.php', $data);
		// $this->load->view('home/stickyBar.php', $data);
		$this->load->view('home/home.php', $data);
		$this->load->view('home/foot.php');
		$this->load->view('home/footer.php');		
	}

	// ajax get subCategory data
	public function get_subcategory(){
		$sub = $this->category_model->getData($_POST['id']);
		if($sub){
			$data = array();
			foreach($sub as $row){
				foreach($row as $key=>$val){
					$sub_data[$key] = $val;
				}				
				$data[] = $sub_data;
			}
			echo json_encode($data);
			exit;
		}
		echo "failed";
	}
	//set session
	public function set_sess(){
		if($_POST['theme']){
			$this->session->set_userdata('theme', 'checked');
		}else{
			$this->session->set_userdata('theme', '');
		}
		echo true;
	}
}

