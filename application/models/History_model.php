<?php

/**
 * History Model Class
 * author  Elite M
 */
class History_model extends MY_model {
	
	protected $table = 'history';
	
    function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}

	function addHistory($user_id = 0, $action, $description='', $user_ip=''){
		$data=array(
			"user_id" => $user_id,
			"action" => $action,
			"description" => $description,
			"user_ip" => $user_ip
		);
		return $this->insert($data);
	}
}

/* End of file History_model.php */
/* Location: ./application/models/History_model.php */