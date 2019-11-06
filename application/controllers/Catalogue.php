<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogue extends CI_Controller {

	/**
	 * Home Page for this controller.
	 *	 
	 */
	private $contents = array();
	private $totalPages=0;
	private $current_page=1;
	private $count_per_page=6;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
		$this->load->model('category_model');
		$this->load->model('contents_model');
		$this->load->model('purchase_membership_model');
		$this->load->model('purchase_contents_model');
		$this->load->model('setting_model');
		$this->load->helper('url_helper');
		$this->load->library('session');
		//Check Login
		if(!$this->session->userdata("isLoggedIn"))
		{
			redirect("auth/login");
		}
	}
	/**
	 * 
	 * @param int $theme  theme=0: dark theme, theme=1: bright theme
	 */
	public function index()
	{
		//keep theme
		if($this->session->userdata("theme")){
			$data['theme'] = "1";
		}else{
			$data['theme'] = "0";
		}
		//UserData
		if($this->session->userdata("isLoggedIn"))
		{
			$user_data=$this->users_model->getUserData('',$this->session->userdata("user_id"));
			$data["isLoggedIn"]=true;
			$data["username"]=$user_data->username;
			$data["role"]=$user_data->role;
		}

		$setting_data=$this->setting_model->get_all();
		if(count($setting_data) > 0){
			$data['title'] = $setting_data[0]->site_title;
			$data['copyright'] = $setting_data[0]->copyright;
		}

		$data['resource'] = 'catalogue/catalogue';
		$data['page'] = 'Catalogue';
			
		//get parent category
		$categories = $this->category_model->getAllData();
		$data['categories'] = $categories;

		$this->getContents();
		$data['contents']=array_slice($this->contents,0,$this->count_per_page);
		$data['pages']=$this->totalPages;
		$this->load->view('header.php', $data);
		$this->load->view('catalogue/catalogue.php', $data);
		$this->load->view('footer.php');		
	}

	private function getContents($id='', $term='', $title='', $categoryId='', $order='', $price='')
	{
		$this->contents=$this->contents_model->getContents($id, $term, $title, $categoryId,  $order, $price);
		$this->totalPages=ceil(count($this->contents)/$this->count_per_page);
	}

	public function filterPage()
	{
		$this->current_page=$_POST['current_page'];
		$this->getContents('', $_POST['term'], $_POST['title'], $_POST['categoryId'], $_POST['order'], $_POST['price']);
		$this->totalPages < $this->current_page ? $this->current_page = $this->totalPages : $this->current_page;

		$data=array(
			'contents'=>array_slice($this->contents, ($this->current_page-1)*$this->count_per_page, $this->count_per_page),
			'pages'=>$this->totalPages
		);

		echo json_encode($data);
		return true;
	}

	public function details($content_id)
	{
		//keep theme
		if($this->session->userdata("theme")){
			$data['theme'] = "1";
		}else{
			$data['theme'] = "0";
		}
		//UserData
		if($this->session->userdata("isLoggedIn"))
		{
			$user_data=$this->users_model->getUserData('',$this->session->userdata("user_id"));
			$data["isLoggedIn"]=true;
			$data["username"]=$user_data->username;
			$data["role"]=$user_data->role;
		}
		
		$is_member = $this->purchase_membership_model->isMember($this->session->userdata("user_id"));
		$data["is_member"]=$is_member;

		//Check purchased
		$is_purchased = $this->purchase_contents_model->is_purchased($content_id, $this->session->userdata("user_id"));
		$data["is_purchased"]=$is_purchased;

		$setting_data=$this->setting_model->get_all();
		if(count($setting_data) > 0){
			$data['title'] = $setting_data[0]->site_title;
			$data['copyright'] = $setting_data[0]->copyright;
		}
		
		$data['resource'] = 'catalogue/details';
		$data['page'] = 'Content Detail';
		
		//get content by content id
		$this->getContents($content_id);
		$data['content']=$this->contents[0];

		$this->getContents('','','',$this->contents[0]->category_id);
		// foreach ($this->contents as $key => $content) {
		// 	if($content->id == $content_id)
		// 		unset($this->contents[$key]);
		// }
		
		$data['similar_contents']=$this->contents;
		$this->load->view('header.php', $data);
		$this->load->view('catalogue/details.php', $data);
		$this->load->view('footer.php', $data);		
	}
}