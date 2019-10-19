<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin1 extends CI_Controller {

	/**
	 * Admin for this controller.
	 *	 
	 */
	public function __construct()
	{
		parent::__construct();		
		$this->load->model('category_model');
		$this->load->model('users_model');		
		$this->load->model('membershipdata_model');		
		$this->load->model('membershiplevel_model');		
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
	/**
	 * 
	 * 
	 */
	public function index()
	{
		$this->dashboard();
	}

	//verify admin
	public function verify_admin(){
		if($_POST){
			$verify = $this->users_model->verify_admin($_POST['username'], null, $_POST['pwd']);
			if($verify){
				//set session
				$this->session->set_userdata('user', $verify);
				$this->dashboard();
			}else{
				$data['message'] = "Please enter administrator name and password.";
				$this->load->view('admin/login', $data);
			}
		}
		return false;
	}
	// logout
	public function logout(){
		$this->session->unset_userdata('user');
		$this->load->view('admin/login');
		return true;		
	}
	private function dashboard()
	{
		if( ! file_exists(APPPATH.'views/admin/dashboard.php'))
        {
			show_404();
		}


		$data["user"] = $this->session->userdata('user');
		
		$data['page']='Dashboard';
		$data['resource']='dashboard';

		$all_category = $this->category_model->getData();
		$data['all_category'] = $all_category;

		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar', $data);
		$this->load->view('admin/dashboard');
		$this->load->view('admin/footer', $data);
	}

	/*
		level page display
	*/
	public function level_view()
	{
		if( ! file_exists(APPPATH.'views/admin/level.php'))
        {
			// Whoops, we don't have a page for that!
			show_404();
		}
		$data['view'] = "level";
		//level data
		$this->load->model('membershiplevel_model');		
		$level = $this->membershiplevel_model->get_all();
		$data['level'] = $level;
		//feature data
		$this->load->model('feature_model');		
		$feature = $this->feature_model->get_all();
		$data['feature'] = $feature;
		//category data
		$all_category = $this->category_model->getData();
		$data['all_category'] = $all_category;
		$this->load->view('admin/header.php');
		$this->load->view('admin/topbar.php');
		$this->load->view('admin/sidebar.php', $data);
		//main part
		$this->load->view('admin/level.php');
		
		$this->load->view('admin/quicksidebar.php');
		$this->load->view('admin/foot.php');
		$this->load->view('admin/footer.php');
	}

	/**
	 * level data save
	 */
	public function level_save(){
		$data = array(
			'level_name' => $_POST["level_name"],
			'price' => $_POST["price"],
			'timeline' => $_POST["timeline"]
		);
		$this->load->model('membershiplevel_model');	
		$return = $this->membershiplevel_model->update($_POST["id"], $data);
		echo $return;exit;
	}

	/*
		feature page display
	*/
	public function feature_view()
	{
		if( ! file_exists(APPPATH.'views/admin/feature.php'))
        {
			// Whoops, we don't have a page for that!
			show_404();
		}
		$data['view'] = "feature";
		$this->load->model('feature_model');		
		$feature = $this->feature_model->get_all();
		$data['feature'] = $feature;
		$all_category = $this->category_model->getData();
		$data['all_category'] = $all_category;
		$this->load->view('admin/header.php');
		$this->load->view('admin/topbar.php');
		$this->load->view('admin/sidebar.php', $data);
		//main part
		$this->load->view('admin/feature.php');
		
		$this->load->view('admin/quicksidebar.php');
		$this->load->view('admin/foot.php');
		$this->load->view('admin/footer.php');
	}

	/**
	 * feature data save
	 */
	public function feature_save(){
		$data = array(
			'feature' => $_POST["feature"],
			'feature_description' => $_POST["description"],
			'tag' => $_POST["tag"]
		);
		$this->load->model('feature_model');
		if($_POST["insert"]){
			$return = $this->feature_model->insert($data);
		}else{
			$return = $this->feature_model->update($_POST["id"], $data);
		}		
	}

	/**
	 * feature data delete
	 */
	public function feature_del(){		
		$this->load->model('feature_model');
		$return = $this->feature_model->delete($_POST["id"]);
	}

	/*
		feature page display
	*/
	public function users_view()
	{
		if( ! file_exists(APPPATH.'views/admin/users.php'))
        {
			show_404();
		}
		$data['page']='Users';
		$data['resource'] = "users";

		$this->load->model('users_model');		
		$data['users'] = $this->users_model->getUsersData();
		$data['membership_levels'] = $this->membershiplevel_model->get_all();

		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar', $data);
		$this->load->view('admin/users', $data);
		$this->load->view('admin/footer', $data);
	}

	/**
	 * user data save
	 */
	public function user_save1(){
		$data = array(
			'feature' => $_POST["feature"],
			'feature_description' => $_POST["description"],
			'tag' => $_POST["tag"]
		);
		$this->load->model('users_model');
		if($_POST["insert"]){
			$return = $this->users_model->insert($data);
		}else{
			$return = $this->users_model->update($_POST["id"], $data);
		}		
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
		$data = array(
			'membership_id' => $_POST["membership"],
			'user_id' => $_POST["id"]
		);

		$this->membershipdata_model->insert($data);

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

	/*
		contents upload page display
	*/
	public function contents_upload()
	{
		if( ! file_exists(APPPATH.'views/admin/users.php'))
        {
			// Whoops, we don't have a page for that!
			show_404();
		}
		$data['view'] = "upload";
		$user = $this->users_model->get_all();
		$data['user'] = $user;
		$all_category = $this->category_model->getData();
		$data['all_category'] = $all_category;
		$this->load->view('admin/header.php');
		$this->load->view('admin/topbar.php');
		$this->load->view('admin/sidebar.php', $data);
		//main part
		$this->load->view('admin/upload_contents.php');
		
		$this->load->view('admin/quicksidebar.php');
		$this->load->view('admin/foot.php');
		$this->load->view('admin/footer.php');
	}

	/*
		contents upload page display
	*/
	public function profile()
	{
		if( ! file_exists(APPPATH.'views/admin/profile.php'))
        {
			// Whoops, we don't have a page for that!
			show_404();
		}
		$data['view'] = "reset";
		$this->load->model('users_model');		
		$user = $this->users_model->get_all();
		$data['user'] = $user;
		$all_category = $this->category_model->getData();
		$data['all_category'] = $all_category;
		$this->load->view('admin/header.php');
		$this->load->view('admin/topbar.php');
		$this->load->view('admin/sidebar.php', $data);
		//main part
		$this->load->view('admin/profile.php');
		
		$this->load->view('admin/quicksidebar.php');
		$this->load->view('admin/foot.php');
		$this->load->view('admin/footer.php');
	}

	/*
		category page part
	*/
	public function category()
	{
		if( ! file_exists(APPPATH.'views/admin/category.php'))
        {
			show_404();
		}
		$data['page']='Category';
		$data['resource'] = "category";
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
		$data['category_nodes']=json_encode($nodes);

		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar', $data);
		$this->load->view('admin/category', $data);
		$this->load->view('admin/footer', $data);
	}
	
	public function saveCategories()
	{
		foreach ($_POST as $key=>$node) {
			if($key!="deleted_nodes" && $node['id'][0]=="j")//created
			{
				$data = array(
					'name' => $node["text"],
					'parent' => $node["parent"]
				);
				echo $this->category_model->createCategory($data);
			}
			else if($key=="deleted_nodes")//deleted
			{
				
			}
			else //updated
			{
				$data = array(
					'class' => $node["id"],
					'name' => $node["text"],
					'parent' => $node["parent"]
				);
				echo $this->category_model->updateCategory($data);
			}
		}
	}
}

