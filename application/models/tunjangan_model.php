<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tunjangan_model extends CI_Model { 

	public function __construct()
	{
	   parent::__construct();
	   $this->table_name = 'tunjangan';
	}

	public function jumlahTunjangan()
	{
		return $this->db->count_all($this->table_name);
	}

	public function listTunjangan($limit = array(), $pencarian)
	{
		$this->db->select('tunjangan.id,tunjangan.nama_tunjangan,tunjangan.jumlah,status.nama_status');
		if ($pencarian) {
			
			$this->db->like('nama_tunjangan',$pencarian);
			
		}
		$this->db->join('status', 'status.id = tunjangan.status_id', 'left');
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

	public function getTunjangan($kode)
	{
		$this->db->where('id', $kode);  
	  	$query = $this->db->get($this->table_name);  
	  	if($query->num_rows() > 0){  
	   		return $query->row();  
	  	} else{  
	   		return null;  
	  	}  
	}

	public function updateTunjangan($id, $data) {
		$this->db->where('id', $id);  
		$this->db->update($this->table_name, $data);  
		if($this->db->affected_rows() > 0){  
			return true;  
		}  
		else{  
			return false;  
		}  
	}

	 function newTunjangan($data)
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