<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contents extends CI_Controller {

	/**
	 * Admin for this controller.
	 *	 
	 */
	public function __construct()
	{
		parent::__construct();		
		$this->load->model('contents_model');
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
		if( ! file_exists(APPPATH.'views/admin/contents.php'))
        {
			show_404();
		}
		$data['page']='Contents';
		$data['resource'] = "contents";

		$categories = $this->category_model->getAllData();
		$data['categories']=$categories;

		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar', $data);
		$this->load->view('admin/contents', $data);
		$this->load->view('admin/footer', $data);
	}

	public function getAllContents(){
		$contents = $this->contents_model->getContents();
		$data=array();
		$i=0;
		foreach ($contents as $content) {
			$i++;
			$unit="B";
			$size=round(($content->size),2);
			if( round(($size/1024),2) > 0 ){
				$size=round(($size/1024),2);
				$unit="KB";
			}

			if( round(($size/1024),2) > 0){
				$size=round(($size/1024),2);
				$unit="MB";
			}

			if( round(($size/1024),2) > 0){
				$size=round(($size/1024),2);
				$unit="GB";
			}
			
			$data[]=array(
				'DT_RowId'=> $content->id,
				'no'=>$i,
				'type'=>$content->type,
				'category'=>$content->category_id,
				'title'=>$content->title,
				'description'=>$content->description,
				'duration'=>$content->duration,
				'price'=>$content->price,
				'size'=>$size.$unit,
				'date'=>$content->publish_date,
				'source_url'=>$content->contents_url,
				'thumb_url'=>$content->thumb_url,
				'actions'=>'',
			);
		}
		echo json_encode($data);
	}

	public function saveData(){
		//Calculate PDF pages
		function count_pages($pdfname) {
			$pdftext = file_get_contents($pdfname);
			$num = preg_match_all("/\/Page\W/", $pdftext, $dummy);
			return $num;
		}

		if($_POST['source']==1) // By URL
		{
			$filePath = $_POST['source_url'];
			if($filePath){
				$filename = tempnam(sys_get_temp_dir(),'ci_temp');
				if (file_put_contents($filename, file_get_contents($filePath, false, null, 0, 300000))) {
					if (require_once(APPPATH . 'third_party/getid3/getid3.php')) {
						$getID3 = new getID3;
						$FileInfo = $getID3->analyze(substr($filename,0,6)=="public" ? $this->base_url().$filename : $filename);
					}

				unlink($filename);
				}
			}

			$data=array(
				'title'=>$_POST['title'],
				'type'=>$_POST['type'],
				'contents_url'=>$_POST['source_url'],
				'thumb_url'=>$_POST['thumb_url'],
				'category_id'=>$_POST['category'],
				'description'=>$_POST['description'],
				'price'=>$_POST['price'],
				'duration'=>$_POST['type']==1?$FileInfo['playtime_string']:count_pages($_POST['source_url']),
				'size'=>substr($_POST['source_url'],0,6)!="public" ? $this->retrieve_remote_file_size($_POST['source_url']) : filesize($_POST['source_url'])
			);
		}else{ // By Local File
			if($_POST['type']==1)
				$path = 'public/uploads/video';
			else
				$path = 'public/uploads/doc';

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
			}

			require_once(APPPATH . 'third_party/getid3/getid3.php');
			$getID3 = new getID3;
			$FileInfo = $getID3->analyze($source_file);

			$data=array(
				'title'=>$_POST['title'],
				'type'=>$_POST['type'],
				'contents_url'=>$source_file,
				'thumb_url'=>$thumb_file,
				'category_id'=>$_POST['category'],
				'description'=>$_POST['description'],
				'price'=>$_POST['price'],
				'duration'=>$_POST['type']==1?$FileInfo['playtime_string']:count_pages($source_file),
				'size'=>$_FILES['source_file']['size']
			);
		}
		
		if($_POST['edit_id']>0)
			echo $this->contents_model->update($_POST['edit_id'], $data);
		else
			echo $this->contents_model->insert($data);
	}

	public function deleteData(){		
		echo $this->contents_model->delete($_POST["id"]);
	}

	//Calculate file size of Remote file
	private function retrieve_remote_file_size($url){
		$ch = curl_init($url);
   
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, TRUE);
		curl_setopt($ch, CURLOPT_NOBODY, TRUE);
   
		$data = curl_exec($ch);
		$size = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
   
		curl_close($ch);
		return $size;
   }
}
