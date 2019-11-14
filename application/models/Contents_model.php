<?php

/**
 * Contents Model Class
 * author  Elite M
 */
class Contents_model extends MY_model {
	
	protected $table = 'contents';
	protected $datenull = '1000-01-01';
	
    function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}
	/**
	 * get contents
	 */
	function getContents($id='', $term='', $title='', $categoryId='', $order='', $price=''){
		$sql = 'SELECT A.*, B.name as category_name FROM contents AS A';
		$sql.=' LEFT JOIN category AS B ON B.id=A.category_id ';
		if($id){
			$sql .= 'WHERE A.id='.(int)$id;
		}
		//filter condition
		$flag=0;
		if($term){				
			$sql .= ($flag ? ' AND ' : ' WHERE ');
			$sql .= 'A.description LIKE "%'.$term.'%"';
			$flag = 1;
		}
		if($title){
			$sql .= ($flag ? ' AND ' : ' WHERE ');
			$sql .= 'A.title LIKE "'.$title.'%"';
			$flag = 1;				
		}
		if($categoryId){
			$sql .= ($flag ? ' AND ' : ' WHERE ');
			$sql .= 'A.category_id IN (SELECT id FROM category WHERE class like concat((SELECT class from category where id=' . (int)$categoryId . '), "%"))';
			$flag = 1;				
		}
		if($order&&($order==3||$order==4)){
			$sql .= ($flag ? ' AND ' : ' WHERE ');
			$sql .= 'A.type='.($order-2);
			$flag = 1;				
		}
		//order condition
		if($order){
			if($order == 1){
				$sql .= ' ORDER BY A.publish_date';
			}else if($order == 2){
				$sql .= ' ORDER BY A.title';
			}else if($order == 5){
				$sql .= ' ORDER BY A.size';
			}else if($order == 6){
				$sql .= ' ORDER BY A.duration';
			}
		}else{
			$sql .= ' ORDER BY A.publish_date DESC';
		}
		//price condition
		if($price)
		{
			if($order&&($order==3||$order==4)){
				if($price == 1){
					$sql .= ' ORDER BY A.price';
				}else{
					$sql .= ' ORDER BY A.price DESC';
				}
			}else{
				if($price == 1){
					$sql .= ', A.price';
				}else{
					$sql .= ', A.price DESC';
				}
			}
		}
		$query = $this->db->query($sql);
		if(is_null($query->result())){
			return false;
		}else{
			return $query->result();
		}
	}	
	function getOneContent($id)
	{
		$sql = "SELECT * FROM contents WHERE id=".$id;
		$result=$this->db->query($sql);

		return $result->row();
	}
}

/* End of file Contents_model.php */
/* Location: ./application/models/Contents_model.php */