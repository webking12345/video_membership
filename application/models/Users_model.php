<?php

/**
 * Users Model Class
 * author Elite M
 */
class Users_model extends MY_Model {
	
	protected $table = 'users';
	protected $datenull = '1000-01-01';
	
    function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}
	
	/* verify registered user by username or email
		return true : registered user
		return false : unregistered user
	*/
	function getUsersData(){
		$sql = 'SELECT A.*, B.membership_id FROM users AS A';
		$sql.=' LEFT JOIN membership_data as B on B.user_id=A.id ';
		$sql.=' ORDER BY A.id';

		$query = $this->db->query($sql);
		if(is_null($query->result())){
			return false;
		}else{
			return $query->result();
		}
	}
	
	function verify_user($username, $email, $pwd)
	{
		if($username || $email){
			if($username){
				$this->db->where('username', $username);							
			}			
			if($email){
				$this->db->where('email', $email);
			}
			$this->db->where('pwd', md5($pwd));
			$query = $this->db->get('users');
            if(is_null($query->result())){
                return false;                
            }else{
				// if(is_null($pwd) && is_null($email)){
				// 	$alert = "The same user name already used";
				// 	return $alert;
				// }else if(is_null($pwd) && is_null($email)){
				// 	$alert = "Same Email address already registered";
				// 	return $alert;
				// }else{
				$data = $query->row_array();
				return $data['id'];
            }
		}		
		return false;
	}
	
	/* register user */
	function register_user($username, $email, $pwd)
	{
		$user = $this->verify_user($username, $email, $pwd);
		if($user){
            return "already";
        }
		$data = array(          
				"username"=>$username,
				"email"=>$email,
				"pwd"=> md5($pwd),
				"reg_datetime"=>date("Y-m-d H:i:s"),
				"last_datetime"=>date("Y-m-d H:i:s")           
		);
		$id = $this->insert($data);
		return  ($id ? $id : false);
	}

	/**
	 * change user balance
	 * $plus = true: Increase balance
	 * $plus = false: Decrease balance
	 */

	function changeBalace($userId, $price, $plus){
		if($plus){
			$sql = "UPDATE ".$table." SET balance+=".$price." WHERE id=".$userId;
		}else{
			$sql = "UPDATE ".$table." SET balance-=".$price." WHERE id=".$userId;
		}		
		$query = $this->db->query($sql);
		if($query->result()){
			return true;
		}else{
			return false;
		}	
	}

	function getUserData($username,$user_id=0){
		if($username || $user_id){
			if($user_id>0)
				$this->db->where('id', $user_id);							
			else
				$this->db->where('username', $username);							
			$query = $this->db->get('users');
            if(is_null($query->result())){
                return false;                
            }else{
				$data = $query->row();
				return $data;
            }
		}		
	}

	/*
		verify administrator
	*/
	function verify_admin($username, $email, $pwd, $uid=null)
	{
		if(is_null($uid)){
			$uid = $this->verify_user($username, $email, $pwd);
		}
		if($uid){
			$admin = $this->users_model->get_by_id($uid);
			if($admin->role_id == "1"){
				return 1;
			}
		}
		return 0;
	}
	/* 
	*	forgot password 
	*/
	// public function sendpassword($data) {
	// 	// include your libary at the top
	// 	require FCPATH . 'assets/PHPMailer/PHPMailerAutoload.php';
	// 	// email retrieved from the ForgotPassword() method.
	// 	$email = $data['user_email'];
	// 	// get the user_info array row
	// 	$query1 = $this->db->query("SELECT * from user_registration where user_email = '" . $email . "'");
	// 	$row = $query1->result_array();
	// 	if ($query1->num_rows() > 0) {
	// 		// assign users name to a variable
	// 		$full_name = $row['full_name'];
	// 		// generate password from a random integer
	// 		$passwordplain = rand(999999999, 9999999999);
	// 		// encrypt password
	// 		$encrypted_pass = $this->pass_gen($passwordplain);
	// 		$newpass['user_password'] = $encrypted_pass;
	// 		// update password in db
	// 		$this->db->where('user_email', $email);
	// 		$this->db->update('user_registration', $newpass);
	// 	// begin email functions
	// 	$result = $this->email_user($full_name, $email, $passwordplain);
	// 	echo $result;
	// 	}
	// }

	// // email sending
	// public function email_user($full_name, $email, $passwordplain) {
	// 	// compose message
	// 	$mail_message = 'Dear ' . $full_name. ',' . "\r\n";
	// 	$mail_message .= 'Thanks for contacting regarding to forgot password,<br> Your <b>Password</b> is <b>' . $passwordplain . '</b>' . "\r\n";
	// 	$mail_message .= '<br>Please Update your password.';
	// 	$mail_message .= '<br>Thanks & Regards';
	// 	$mail_message .= '<br>Your company name';
	// 	// email config
	// 	$mail = new PHPMailer;
	// 	$mail->isSMTP();
	// 	$mail->SMTPSecure = "tls";
	// 	$mail->Debugoutput = 'html';
	// 	$mail->Host = "ssl://smtp.googlemail.com";
	// 	$mail->Port = 465;
	// 	$mail->SMTPAuth = true;
	// 	$mail->Username = "xxxxxxxxx@gmail.com";
	// 	$mail->Password = "xxxxxxxx";
	// 	$mail->setFrom('xxxxxxx@gmail.com', 'admin');
	// 	$mail->IsHTML(true);
	// 	$mail->addAddress('user_email', $email);
	// 	$mail->Subject = 'OTP from company';
	// 	$mail->Body = $mail_message;
	// 	$mail->AltBody = $mail_message;
	// 	// send the mail
	// 	if (!$mail->send()) {
	// 		return $this->email->print_debugger();
	// 		$this->session->set_flashdata('msg', 'Failed to send password, please try again!');
	// 	} else {
	// 		return $this->email->print_debugger();
	// 		$this->session->set_flashdata('msg', 'Password sent to your email!');
	// 	}
	// }

	// // Password encryption
	// public function pass_gen($password) {
	// 	$encrypted_pass = md5($password);
	// 	return $encrypted_pass;
	// }
}

/* End of file Users_model.php */
/* Location: ./application/models/Users_model.php */