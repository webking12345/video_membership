<?php

/**
 * Feature Model Class
 * author  Elite M
 */
class Feature_model extends MY_model {
	
	protected $table = 'feature_list';
	protected $datenull = '1000-01-01 00:00:00';
	
    function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}	
}

/* End of file Feature_model.php */
/* Location: ./application/models/Feature_model.php */