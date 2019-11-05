<?php

/**
 * Balance Model Class
 * author  Elite M
 */
class Balance_model extends MY_model {
	
	protected  $table = 'balance_history';
	
    function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}

	function getAllData()
	{
		$query = "SELECT A.id, B.username AS name, B.email, A.in_amount, A.in_description, A.in_date FROM " . $this->table . " AS A";
		$query .= " LEFT JOIN users AS B ON B.email=A.user_email";
		$query .= " ORDER BY A.id DESC";

		$result = $this->db->query($query);
		return $result->result();
	}
}

/* End of file Balance_model.php */
/* Location: ./application/models/Balance_model.php */