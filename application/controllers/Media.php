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
		$this->load->model('introduction_model');
		$this->load->model('contents_model');
		$this->load->model('purchase_membership_model');
		$this->load->model('purchase_contents_model');
		$this->load->model('setting_model');
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
			show_404();
	}

	public function contents_view($content_id)
	{
		//Check Login
		if(!$this->session->userdata("isLoggedIn"))
		{
			redirect("auth/login");
		}
		//get content by content id
		$content_data = $this->contents_model->getOneContent($content_id);

		if($content_data->price > 0 && !$this->purchase_membership_model->isMember($this->session->userdata("user_id")) && !$this->purchase_contents_model->is_purchased($content_id, $this->session->userdata("user_id")))
			redirect($_SERVER['HTTP_REFERER']);
			
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

		$data['resource'] = 'media';
		$data['page'] = 'View';

		//get content by content id
		$data['view'] = 'contents';
		
		$data['thumb_url']=substr($content_data->thumb_url,0,6)=="public"?base_url().$content_data->thumb_url:$content_data->thumb_url;
		$data['id']=$content_data->id;

		//check youtube
		$domain = str_replace('www.', '', parse_url($content_data->contents_url, PHP_URL_HOST));
		$data['is_youtube'] = $domain=='youtube.com' || $domain=='youtu.be' ? true : false;

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
		
		//log history
		$this->history_model->addHistory($this->session->userdata("user_id"), 4, 'Play' . $content_data->title, $this->input->ip_address()); // 2nd prams -> 1: register, 2: login, 3:logout, 4: visit page, 5: join membership, 6: purchase contents

		//set purchase status of content as played
		$this->purchase_contents_model->setPlayed($content_id, $this->session->userdata("user_id"));
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

		$setting_data=$this->setting_model->get_all();
		if(count($setting_data) > 0){
			$data['title'] = $setting_data[0]->site_title;
			$data['copyright'] = $setting_data[0]->copyright;
		}
		
		$data['view']="category";
		$data['resource'] = 'media';
		$data['page'] = 'View';

		//get intro video by category id
		$cate_data = $this->introduction_model->getContents($category_id);
		$data['thumb_url']=substr($cate_data['thumb_url'],0,6)=="public"?base_url().$cate_data['thumb_url']:$cate_data['thumb_url'];
		$data['video_url']=substr($cate_data['contents_url'],0,6)=="public"?base_url().$cate_data['contents_url']:$cate_data['contents_url'];
		$domain = str_replace('www.', '', parse_url($cate_data['contents_url'], PHP_URL_HOST));
		$data['is_youtube'] = $domain=='youtube.com' || $domain=='youtu.be' ? true : false;

		$this->load->view('header', $data);
		$this->load->view('media/video_view', $data);
		$this->load->view('footer');		
	}
}

