<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	/**
	 * Admin for this controller.
	 *	 
	 */
	public function __construct()
	{
		parent::__construct();		
		$this->load->model('category_model');
		$this->load->model('users_model');		
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
		if( ! file_exists(APPPATH.'views/admin/category.php'))
        {
			show_404();
		}
		$data['page']='Category';
		$data['resource'] = "category";

		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar', $data);
		$this->load->view('admin/category', $data);
		$this->load->view('admin/footer', $data);
	}
	public function getAllCategories(){
		$categories = $this->category_model->getAllData();
		$nodes=array();
		$nodes[]=array(
			"id"=>"root",
			"parent"=>"#",
			"text"=>"categories",
			"icon" => "fa fa-folder m--font-brand"
		);
		foreach ($categories as $category) {
			$nodes[]=array(
				"id"=>$category->class,
				"parent"=>strlen($category->class)>6?substr($category->class,0,strlen($category->class)-6):"root",
				"text"=>$category->name,
				"icon" => $category->is_leaf?"fa fa-file m--font-success":"fa fa-folder m--font-warning"
			);
		}
		echo json_encode($nodes);
	}

	public function deleteCategory(){
		$cate=$this->category_model->getOneCategory('',$_POST['class']);
		$this->category_model->delete($cate->id);
		$this->category_model->set_leaf($_POST['parent']);

		echo true;
	}

	public function createCategory(){
		$this->category_model->createCategory($_POST);
		$this->category_model->set_leaf($_POST['parent']);
		echo true;
	}

	public function renameCategory(){
		$cate=$this->category_model->getOneCategory('',$_POST['class']);
		$data = array(
			'name' => $_POST["name"],
		);
		echo $this->category_model->update($cate->id, $data);
	}

	public function moveCategory(){
		echo $this->category_model->moveCategory($_POST);
	}
}

