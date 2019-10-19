<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	/**
	 * Login, Register, Membership Page for this controller.
	 *	 
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
		$this->load->model('feature_model');
		$this->load->model('membershiplevel_model');
		$this->load->model('membershipdata_model');
		$this->load->helper('url_helper');
		//load session library
		$this->load->library('session');
		
	}

	//log out
	public function logout(){
		$this->session->unset_userdata('user');
		$this->session->unset_userdata('status');
		redirect("home");
	}
	public function index($view)
	{
		if( ! file_exists(APPPATH.'views/home/users.php'))
        {
			// Whoops, we don't have a page for that!
			show_404();
		}
		//restrict users to go back to login if session has been set
		// if($this->session->userdata('user')){
		// 	// redirect('browse');
		// }
		// else{
			if($this->session->userdata("theme")){
				$data['theme'] = "1";
			}else{
				$data['theme'] = "0";
			}			
			$data["user"] = $this->session->userdata('user');
			$data["view"] = $view;
			$data["resource"] = $view;
			if($view == "join"){
				//get feature data
				$features = $this->feature_model->get_all();
				foreach($features as $f){
					$fdata[$f->id] = $f->feature;
				}
				$data['feature'] = $fdata;
				//get membership level data
				$levels= $this->membershiplevel_model->get_all();
				foreach($levels as $l){
					$level[$l->id]['name']= $l->level_name;
					$level[$l->id]['price']= $l->price;
					$level[$l->id]['feature']= $l->feature_id;
					$level[$l->id]['timeline']= $l->timeline;
				}
				$data['level'] = $level;
			}
			
			$this->load->view('header',$data);
			$this->load->view($view, $data);
			if($view == "join"){
				$this->load->view('home/membership', $data);
			}			
			$this->load->view('footer', $data);
		// }        
	}
		
	//login
	public function login(){
		if($_POST){
			$verify = $this->users_model->verify_user($_POST['username'], null, $_POST['pwd']);
			if($verify){
				//set session
				$this->session->set_userdata('user', $verify);
				// redirect("/catalogue", "location");
				echo "1";exit;
			}else{
				echo "0";exit;
			}
		}
		return false;
	}

	
	//verify username or email
	public function verify(){
		if($_POST){
			$where = array($_POST['name'] => $_POST['val']);
			$verify = $this->users_model->get_where($where);
			if($verify){
				echo "1"; exit;
			}else{
				echo "0"; exit;
			}
		}
		return false;
	}

	// user data register (sign up)
	public function register(){
		$user_name = $_POST['username'];
		$email = $_POST['email'];
		$pwd = $_POST['pwd'];
		$user_id = $this->users_model->register_user($user_name, $email, $pwd);
		if($user_id == "already"){
			echo "already";
			exit;
		}
		if($user_id){
			$this->session->set_userdata('user', $user_id);
			redirect("catalogue" , 'refresh');
			exit;
		}else{
			echo 0;
			exit;
		}
	}	

	// join
	public function join(){
		$user_name = $_POST['username'];
		$email = $_POST['email'];
		$pwd = $_POST['pwd'];
		if($user_name && $email && $pwd){
			$user_id = $this->users_model->register_user($user_name, $email, $pwd);
		}else{
			$user_id = $this->session->userdata('user');
		}
		
	}	
	
	//Forget Password : Send Verification Code Email
    public function sendVerificationCode(){
	    if($this->login_model->checkEmail()>0)
        {
            $from_email = $this->login_model->getAdminEmail();
            $to_email = $this->input->post('email');
            $code=$this->login_model->generateCode();
            if($code>0)
            {
                //Load email library
                $this->load->library('email');

                $config = array();
//                $config['protocol'] = 'smtp';
//                $config['smtp_host'] = 'ssl://smtp.googlemail.com';
//                $config['smtp_user'] = 'xxx';
//                $config['smtp_pass'] = 'xxx';
//                $config['smtp_port'] = 465;
//                $this->email->initialize($config);
//                $this->email->set_newline("\r\n");
//
//                $this->email->from($from_email, 'Identification');
//                $this->email->to($to_email);
//                $this->email->subject('Reset Password Verification Code');
//                $this->email->message($code);
//                //Send mail
//                if($this->email->send())
//                    echo 3;//Success
//                else
//                    echo 2;//Fail
                echo 1;
            }
            else{
                echo 1;//Code Fail
            }
        }
	    else{
	        echo 0;//Unregistered User
        }
    }

    //Reset Password
    public function resetPassword(){
        echo $this->login_model->resetPassword();
    }

	
}

