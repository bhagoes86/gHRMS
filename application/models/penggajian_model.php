<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Penggajian_model extends CI_Model { 

	public function __construct()
	{
	   parent::__construct();
	   $this->table_name = 'penggajian';
	}

	public function jumlahPenggajian()
	{
		return $this->db->count_all($this->table_name);
	}

	public function listPenggajian($limit = array())
	{
		$this->db->select('id,karyawan_id,gaji,potongan,tunjangan,tgl_pengambilan');
		if ($limit == null) {
			$query = $this->db->get($this->table_name);
		} else {
			$query = $this->db->get($this->table_name, $limit['perpage'], $limit['offset']);
		}
		return $query->result_array();
	}

	public function getPenggajian($kode)
	{
		$this->db->where('id', $kode);  
	  	$query = $this->db->get($this->table_name);  
	  	if($query->num_rows() > 0){  
	   		return $query->row();  
	  	} else{  
	   		return null;  
	  	}  
	}

	public function updatePenggajian($id, $data) {
		$this->db->where('id', $id);  
		$this->db->update($this->table_name, $data);  
		if($this->db->affected_rows() > 0){  
			return true;  
		}  
		else{  
			return false;  
		}  
	}

	 function newPenggajian($data)
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