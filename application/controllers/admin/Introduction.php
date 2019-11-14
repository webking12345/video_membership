<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Introduction extends CI_Controller {

	/**
	 * Admin for this controller.
	 *	 
	 */
	public function __construct()
	{
		parent::__construct();		
		$this->load->model('introduction_model');
		$this->load->model('category_model');
		$this->load->model('users_model');
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
		if( ! file_exists(APPPATH.'views/admin/introduction.php'))
        {
			show_404();
		}
		$data['page']='Introduction';
		$data['resource'] = "introduction";

		$categories = $this->category_model->getData();
		$data['categories']=$categories;

		$user_data=$this->users_model->getUserData('',$this->session->userdata("user_id"));
		$data['email'] = $user_data->email;

		$setting_data=$this->setting_model->get_all();
		if(count($setting_data) > 0){
			$data['title'] = $setting_data[0]->site_title;
			$data['copyright'] = $setting_data[0]->copyright;
		}

		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar', $data);
		$this->load->view('admin/introduction', $data);
		$this->load->view('admin/footer', $data);
	}

	public function getAllContents(){
		$contents = $this->introduction_model->getContents();
		$data=array();
		$i=0;
		if($contents){
			foreach ($contents as $content) {
				$i++;
				$data[]=array(
					'DT_RowId'=> $content['id'],
					'no'=>$i,
					'category'=>$content['category_id'],
					'source_url'=>$content['contents_url'],
					'thumb_url'=>$content['thumb_url']
				);
			}
		}		
		echo json_encode($data);
	}

	public function saveData(){
		if($_POST['source']==1) // By URL
		{
			$source_url = $_POST['source_url'];
			$thumb_url = 'public/uploads/video/thumb/default.png';
			$thumb_url = $_POST['thumb_url']!='' ? $_POST['thumb_url'] : $thumb_url;

			$data=array(
				'contents_url'=>$source_url,
				'thumb_url'=>$thumb_url,
				'category_id'=>$_POST['category_id'],
			);
		}else{ // By Local File
				$path = 'public/uploads/video';

			if($_FILES['source_file']['name'] != ''){
				$date = date("YmdHis");
				$filename = $date . "_" . basename( $_FILES['source_file']['name']);
				$source_file = $path .'/'. $filename;
				move_uploaded_file($_FILES['source_file']['tmp_name'], $source_file);
			}

			if($_FILES['thumb_file']['name'] != ''){
				$date = date("YmdHis");
				$filename = $date . "_" . basename( $_FILES['thumb_file']['name']);

				$source_info = pathinfo($source_file);
				$thumb_info = pathinfo($filename);

				$thumb_file = $path . "/thumb/" . $source_info['filename'] . "." . $thumb_info['extension'];
				
				move_uploaded_file($_FILES['thumb_file']['tmp_name'], $thumb_file);
			} else {
				$thumb_file=$path."/thumb/default.png";
			}

			require_once(APPPATH . 'third_party/getid3/getid3.php');
			$getID3 = new getID3;
			$FileInfo = $getID3->analyze($source_file);

			$data=array(
				'contents_url'=>$source_file,
				'thumb_url'=>$thumb_file,
				'category_id'=>$_POST['category'],
			);
		}
		
		echo $this->introduction_model->updatedata($_POST['edit_id'], $data);
	}

}

