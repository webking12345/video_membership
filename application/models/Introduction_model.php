<?php

/**
 * Contents Model Class
 * author  Elite M
 */
class Introduction_model extends MY_model {
	
	protected $table = 'introduction';
	protected $datenull = '1000-01-01';
	
    function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}
	/**
	 * get contents
	 * @param int $id category_id
	 */
	function getContents($id=''){
		$sql = "SELECT * FROM category as A WHERE LENGTH(class) = 5";
		if($id !== ''){
			$sql .= ' AND id='.$id;
		}	
		$query = $this->db->query($sql);
		$cate = array();
		if(!is_null($query->result())){
			foreach($query->result() as $row){
				$cate[$row->id] = $row->name;
			}
		}
		$rows = array();
		$sql = 'SELECT * FROM introduction';
		if($id !== ''){
			$sql .= ' WHERE category_id='.$id;
		}			
		$query = $this->db->query($sql);
		$i = 0;
		$intro = array();
		$data = array();
		if(sizeof($query->result()) > 0){
			foreach($query->result() as $row){				
				$data[$row->category_id] = $row;
			}			
		}
		//view category video 
		if( $id !== ''){
			$intro['thumb_url'] = sizeof($data) > 0 ? $data[$id]->thumb_url : 'public/uploads/video/thumb/default.png';
			$intro['contents_url'] = sizeof($data) > 0 ? $data[$id]->contents_url : '';
			return $intro;					
		}		
		//add home video 
		$intro[$i]['id'] = array_key_exists(0, $data) ? $data[0]->category_id : 999;
		$intro[$i]['category_id'] = 0;
		$intro[$i]['thumb_url'] = array_key_exists(0, $data) ? $data[0]->thumb_url : '';
		$intro[$i]['contents_url'] = array_key_exists(0, $data) ? $data[0]->contents_url : '';
		//add category video 
		foreach($cate as $key=>$row){
			$i++;
			$intro[$i]['id'] = $key;
			$intro[$i]['category_id'] = $key;
			$intro[$i]['thumb_url'] = array_key_exists($key, $data) ? $data[$key]->thumb_url : '';
			$intro[$i]['contents_url'] = array_key_exists($key, $data) ? $data[$key]->contents_url : '';
		}
		if(sizeof($intro) > 0){
			return $intro;			
		}else{
			return false;
		}
	}
	/**
	 * update introduce
	 */
	public function updatedata($id, $data) {
		$sql = "SELECT * FROM introduction WHERE category_id=".$id;
		$query = $this->db->query($sql);
		if(sizeof($query->result()) > 0){
			$this->db->where('category_id', $id);
			$this->db->update($this->table, $data);
		}else{
			$this->db->insert($this->table, $data);
		}		
        if($this->db->affected_rows() > 0){
            return true;    
        }else{
            return false;
        }        
    }
	
}

/* End of file Contents_model.php */
/* Location: ./application/models/Contents_model.php */