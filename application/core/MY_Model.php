<?php 
    (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Base Model Class
 * author Elite M
 */
class MY_Model extends CI_Model {

    protected $table = '';

    public function __construct() {
        parent::__construct();
    }

    public function get_all() {
        return $this->db->get($this->table)
                        ->result();
    }

    public function get_by_id($id) {
        return $this->db->get_where($this->table, array('id' => $id))
                        ->row();
    }

    public function get_where($where) {
        return $this->db->where($where)
                        ->get($this->table)
                        ->result();
    }

    public function insert($data) {
        $this->db->insert($this->table, $data);
		return $this->db->affected_rows();
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
        if($this->db->affected_rows() > 0){
            return $id;    
        }else{
            return false;
        }        
    }

    public function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
        if($this->db->affected_rows() > 0){
            return $id;    
        }else{
            return false;
        }
    }
}

/* End of file base_model.php */
/* Location: ./application/models/base_model.php */