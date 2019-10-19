<?php

/**
 * Membership Data Model Class
 * author  Elite M
 */
class MembershipData_model extends MY_model {
	
	protected  $table = 'membership_data';
	
    function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}

	/*
	 * get Membership purchase data
	 * 	$membershpId !=null : get data by membership id
	 *  $userId != null : get data by user id
	 */
	function getData($membershipId=null, $userId=null){
		$sql = "SELECT membership_data.*, users.`name`, membership_level.`level_name`, membership_level.`price` FROM membership_data 
		LEFT JOIN users ON membership_data.user_id = users.id
		LEFT JOIN membership_level ON membership_data.membership_id = membership_level.id";
		$flag = 0;
		if(!is_null($membershipId)){
			$flag = 1;
			$sql .=" WHERE membership_data.membership_id=".(int)$membershipId;
		}
		if(!is_null($userId)){
			$sql .= $flag ? " AND " : " WHERE ";
			$sql .="membership_data.user_id=".(int)$userId;
		}
		$query = $this->db->query($sql);
		if(is_null($query->result())){
			return false;                
		}else{
			return $query->result();
		}
	}
	
	/*
	 * save Membership purchase data 
	 * If user purchased membership, membership price should add in user balance
	*/
	function saveData($userId, $membershipId){
		$val = array(
			'user_id'=>$uId,
			'membership_id'=>($membershipId),
			'purchase_date'=>(date('Y-m-d'))
		);
		$query = $this->insert($val);

		//add user balance
		if($query){
			//get membership price
			$this->load->model('MembershipLevel_model', 'levelmodel');
			$level = $this->levelmodel->get_by_id($membershipId);
			//add user balance
			$this->load->model('users', 'usermodel');
			$balance = $this->users->changeBalance($userId, $level['price'], true);
			return $balance;
		}else{
			return false;	
		}		
	}
}

/* End of file MembershipData_model.php */
/* Location: ./application/models/MembershipData_model.php */