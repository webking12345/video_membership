<?php

/**
 * Membership level Model Class
 * author  Elite M
 */
class MembershipLevel_model extends MY_Model {
	
	protected $table = 'membership_level';
	
    function __construct()
	{
		parent::__construct();
	}
	
	function getDataByDuration(){
		$this->db->order_by('timeline', 'ASC');
		$query = $this->db->get($this->table);

		return $query->result();
	}
}

/* End of file MembershipLevel_model.php */
/* Location: ./application/models/MembershipLevel_model.php */