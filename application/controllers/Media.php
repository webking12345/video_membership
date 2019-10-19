<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media extends CI_Controller {

	/**
	 * Home Page for this controller.
	 *	 
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
		$this->load->model('category_model');
		$this->load->model('contents_model');
		$this->load->helper('url_helper');
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

	public function contents_view($content_id)
	{
		//Check Login
		if(!$this->session->userdata("isLoggedIn"))
		{
			redirect("auth/login");
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
			$user_data=$this->users_model->getUserData('',$this->session->userdata("user_id"));
			$data["isLoggedIn"]=true;
			$data["username"]=$user_data->username;
			$data["role"]=$user_data->role;
		}

		$data['resource'] = 'media';
		//get content by content id
		$data['view'] = 'contents';
		$content_data = $this->contents_model->getOneContent($content_id);
		$data['thumb_url']=substr($content_data->thumb_url,0,6)=="public"?base_url().$content_data->thumb_url:$content_data->thumb_url;
		$data['id']=$content_data->id;

		if($content_data->type==1)
			$data['video_url']=substr($content_data->contents_url,0,6)=="public"?base_url().$content_data->contents_url:$content_data->contents_url;
		else
			$data['pdf_url']=substr($content_data->contents_url,0,6)=="public"?base_url().$content_data->contents_url:$content_data->contents_url;

		$this->load->view('header', $data);
		if($content_data->type==1)
			$this->load->view('media/video_view', $data);
		else
			$this->load->view('media/pdf_view', $data);

		$this->load->view('footer');		
	}

	public function category_view($category_id)
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

		$data['view']="category";
		$data['resource'] = 'media';
		//get content by content id
		$cate_data = $this->category_model->getOneCategory($category_id);
		$data['thumb_url']=substr($cate_data->thumb_url,0,6)=="public"?base_url().$cate_data->thumb_url:$cate_data->thumb_url;
		$data['video_url']=substr($cate_data->video_url,0,6)=="public"?base_url().$cate_data->video_url:$cate_data->video_url;

		$this->load->view('header', $data);
		$this->load->view('media/video_view', $data);
		$this->load->view('footer');		
	}
}

