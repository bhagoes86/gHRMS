<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Departemen_model extends CI_Model { 

	public function __construct()
	{
		parent::__construct();
		$this->table_name = 'departemen';
	}

	public function jumlahDepartemen()
	{
		return $this->db->count_all($this->table_name);
	}

	public function listDepartemen($limit = array(), $pencarian)
	{
		$this->db->select('*');
		if ($pencarian) {
			
			$this->db->like('nama_departemen',$pencarian);
			
		}
		if ($limit == null) {
			$query = $this->db->get($this->table_name);
		} else {
			$query = $this->db->get($this->table_name, $limit['perpage'], $limit['offset']);
		}
		// return $query->result_array();
		$list = array(
			
			'result' => $query->result_array(),
			
			'count' => $this->db->count_all_results()
			
			);
		
		return $list;
	}

	public function getDepartemen($kode)
	{
		$this->db->where('id', $kode);  
		$query = $this->db->get($this->table_name);  
		if($query->num_rows() > 0){  
			return $query->row();  
		} else{  
			return null;  
		}  
	}

	public function updateDepartemen($id, $data) {
		$this->db->where('id', $id);  
		$this->db->update($this->table_name, $data);  
		if($this->db->affected_rows() > 0){  
			return true;  
		}  
		else{  
			return false;  
		}  
	}

	function newDepartemen($data)
	{  
		$this->db->insert($this->table_name, $data);  
		if($this->db->affected_rows() > 0){  
			return true;  
		} else {  
			return false;  
		}  
	} 
	function delete_data($id)
	{  
		$this->db->where('id', $id);  
		$this->db->delete($this->table_name);  
		if($this->db->affected_rows() > 0){  
			return true;  
		}  
		else{  
			return false;  
		}      
	} 
}