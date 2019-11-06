<?php
defined('BASEPATH') OR exit('No direct script access allowed');
   
class Stripe extends CI_Controller {
    
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function __construct() {
       parent::__construct();
       $this->load->model("users_model");
       $this->load->model("setting_model");
       $this->load->model("balance_model");
       $this->load->library("session");
       $this->load->helper('url');
    }
    
    /**
     * Get All Data from this method.
     *
     * @return Response
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
			$user_id = $this->session->userdata("user_id");
			$user_data=$this->users_model->getUserData('', $user_id);
			$data["isLoggedIn"]=true;
			$data["username"]=$user_data->username;
			$data["role"]=$user_data->role;
		}

		$setting_data=$this->setting_model->get_all();
		if(count($setting_data) > 0){
			$data['title'] = $setting_data[0]->site_title;
			$data['copyright'] = $setting_data[0]->copyright;
			$data['welcome_text'] = $setting_data[0]->welcome_text;
        }
		$data["page"] = "Checkout";
		$data["resource"]='checkout/stripe';
		$data['publish_key'] = $this->config->item('stripe_key');
		$data['amount'] = $this->session->userdata('checkout_amount');

		$this->load->view('header', $data);
        $this->load->view('checkout/stripe', $data);
		$this->load->view('footer', $data);
    }
       
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function subscribe()
    {
        require_once('application/libraries/stripe-php/init.php');
    
        \Stripe\Stripe::setApiKey($this->config->item('stripe_secret'));
     
        \Stripe\Charge::create ([
                "amount" => $this->session->userdata('checkout_amount') * 100,
                "currency" => "usd",
                "source" => $this->input->post('token'),
                "description" => $this->session->userdata('checkout_description') 
        ]);
        
        //log balance history
        $user_email = "";
        if($this->session->userdata("isLoggedIn"))
        {
            $user_id = $this->session->userdata("user_id");
			$user_data = $this->users_model->getUserData('', $user_id);
			$user_email = $user_data->email;
        } else {
            $user_email = $this->session->userdata("tmp")[0]["email"];
        }
        $data = array(
            "user_email" => $user_email,
            "in_amount" => $this->session->userdata('checkout_amount'),
            "in_description" => $this->session->userdata('checkout_description')
        );

        $this->balance_model->insert($data);
        ///
		$this->session->unset_userdata('checkout_description');
		$this->session->unset_userdata('checkout_amount');
        
        $this->session->set_flashdata('success', 'Payment made successfully.');
        redirect('checkout/stripe', 'refresh');
    }

    public function setSess(){
		$this->session->set_userdata('checkout_description', $_POST['description']);
        $this->session->set_userdata('checkout_amount', $_POST['amount']);
        $this->session->set_userdata('redirect_url', $_POST['redirect_url']);
        echo 1;
    }
}