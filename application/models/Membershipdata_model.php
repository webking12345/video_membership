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
	*/
	function saveData($user_id, $membership_id){
		$this->db->where('id', $user_id);							
		$query = $this->db->get($this->table);

		if($query->num_rows())
		{
			$query="UPDATE ".$this->table." SET membership_id=".$membership_id.", purchase_date=CURRENT_TIMESTAMP WHERE user_id=".$user_id;
			return $this->db->query($query);
		}
		else
		{
			$data = array(
				'user_id'=>$user_id,
				'membership_id'=>$membership_id
			);
			return $this->insert($data);	
		}
	}

	//check if current user bought membership
	function isMember($user_id)
	{
		$this->db->where('user_id', $user_id);							
		$query = $this->db->get($this->table);

		$sql="SELECT CURRENT_DATE AS now";
		$result=$this->db->query($sql);
		$date=$result->row();
		$now = $date->now;

		if($query->num_rows())
			return $now <= $this->caculateUserMembershipEndDate($user_id);
		else
			return false;
	}

	//caculate user membership end date
	function caculateUserMembershipEndDate($user_id)
	{
		//get user membership data
		$sql="SELECT B.timeline, A.purchase_date FROM ".$this->table." AS A";
		$sql.=" LEFT JOIN membership_level AS B ON B.id=A.membership_id";
		$sql.=" WHERE A.user_id=".$user_id;
		
		$result=$this->db->query($sql);
		$user_data=$result->row();

		$start = date_timestamp_get(date_create($user_data->purchase_date));
		$end = $start + (3600*24*$user_data->timeline);

		return date('Y-m-d', $end);
	}
}

/* End of file MembershipData_model.php */
/* Location: ./application/models/MembershipData_model.php */