<?php

/**
 * Purchase Contents Model Class
 * author  Elite M
 */
class Purchase_contents_model extends MY_model {
	
	protected  $table = 'purchase_contents';
	
    function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}

	public function is_purchased($content_id, $user_id)
	{
		$this->db->where('content_id', $content_id);							
		$this->db->where('user_id', $user_id);							
		$this->db->where('is_played', 0);							
		$query = $this->db->get($this->table);

		return $query->num_rows();
	}

	public function setPlayed($content_id, $user_id)
	{
		$query="UPDATE ".$this->table." SET is_played=1, play_date=CURRENT_TIMESTAMP WHERE user_id=" . $user_id . " AND content_id=" . $content_id;
		return $this->db->query($query);
	}
}

/* End of file Purchase_contents_model.php */
/* Location: ./application/models/Purchase_contents_model.php */