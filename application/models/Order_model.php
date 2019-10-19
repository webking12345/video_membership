<?php

/**
 * Order Model Class
 * author  Elite M
 */
class Order_model extends MY_model {
	
	protected $table = 'order';
	protected $datenull = '1000-01-01 00:00:00';
	
    function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}
	
	
}

/* End of file Order_model.php */
/* Location: ./application/models/Order_model.php */