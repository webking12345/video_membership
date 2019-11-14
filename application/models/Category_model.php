<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');
/**
 * Category Model Class
 * author  Elite M
 */
class Category_model extends MY_Model {
	
	protected $table = 'category';
	protected $datenull = '1000-01-01 00:00:00';
	
    function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}
	/**
	 * get category data
	 * $catId != 0  return   sub categroy
	 * $catId = 0  return   all categroy
	 */
	function getData($catId=0){
		
		if($catId == 0){
			$sql = "SELECT * FROM category as A WHERE (LENGTH(A.class)-LENGTH(REPLACE(A.class, '.', ''))) = 0";
		}else{
			$sql = "SELECT * FROM category WHERE class LIKE CONCAT((SELECT class FROM category WHERE id=".(int)$catId." ), '%') AND id<>".(int)$catId." ORDER BY class";
		}
		
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			foreach($query->result() as $d){
				$data[] = $d;
			}
			return $data;
		}else{
			return false;
		}
	}

	function getAllData(){
		$sql = "SELECT * FROM category ORDER BY class";
		$result = $this->db->query($sql);

		if($result->num_rows()){
			foreach($result->result() as $d){
				$data[] = $d;
			}
			return $data;
		}
		return false;
	}

	function getOneCategory($id='',$class='')
	{
		if($id!='')
			$sql = "SELECT * FROM category WHERE id=".$id;
		if($class!='')
			$sql = "SELECT * FROM category WHERE class=".$class;

		$result=$this->db->query($sql);

		return $result->row();
	}

	function createCategory($cate)
	{
		//Get the max child class for parent class
		if($cate['parent']!="root" && $cate['parent']!="#")
			$sql='SELECT MAX(class) as last_class FROM '.$this->table.' WHERE `class` like "'.$cate['parent'].'.%"';
		else
			$sql='SELECT MAX(class) as last_class FROM '.$this->table.' WHERE LENGTH(class)=5';

		$result=$this->db->query($sql);
		$row=$result->row();
		$last_class=substr($row->last_class,-5);

		$class=str_pad($last_class+1, 5, '0', STR_PAD_LEFT);
		if($cate['parent']!="root" && $cate['parent']!="#")
			$class=$cate['parent'].".".$class;
		
		$data = array(
			'name' => $cate["name"],
			'class' => $class
		);
		return $this->insert($data);
	}

	function moveCategory($cate)
	{
		//Get the max child class for parent class
		if($cate['parent']!="root" && $cate['parent']!="#")
			$sql='SELECT MAX(class) as last_class FROM '.$this->table.' WHERE `class` like "'.$cate['parent'].'.%"';
		else
			$sql='SELECT MAX(class) as last_class FROM '.$this->table.' WHERE LENGTH(class)=5';
		
		$result=$this->db->query($sql);
		$row=$result->row();
		if(is_null ($row->last_class))
		{
			$class="00001";
		}else{
			$last_class=substr($row->last_class,-5);
			$class=str_pad($last_class+1, 5, '0', STR_PAD_LEFT);
		}
		
		if($cate['parent']!="root" && $cate['parent']!="#")
		{
			$class=$cate['parent'].".".$class;
		}

		$sql='UPDATE '.$this->table.' SET class=CONCAT("'.$class.'",SUBSTR(class,LENGTH("'.$cate['class'].'")+1)) WHERE class LIKE "'.$cate['class'].'%"';
		$this->db->query($sql);

		//set target parent's is_leaf=0
		$this->set_leaf($cate['parent']);

		//check original parent's is_leaf and set as 1
		if(strlen($cate['class'])>5)
		{
			$this->set_leaf(substr($cate['class'], 0, strlen($cate['class'])-6));
		}

		return true;
	}

	function set_leaf($class)
	{
		$sql='SELECT COUNT(*) as count FROM '.$this->table.' WHERE `class` LIKE "'.$class.'.%"';
		$result=$this->db->query($sql);
		$count=$result->row()->count;
		if($count==0)
			$sql='UPDATE '.$this->table.' SET is_leaf=1 WHERE class="'.$class.'"';
		else
			$sql='UPDATE '.$this->table.' SET is_leaf=0 WHERE class="'.$class.'"';
		$this->db->query($sql);

	}
}

/* End of file Category_model.php */