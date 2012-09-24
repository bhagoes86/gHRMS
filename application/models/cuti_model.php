<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cuti_model extends CI_Model { 

	public function __construct()
	{
	   parent::__construct();
	   $this->table_name = 'permohonan_cuti';
	}

	public function jumlahCuti()
	{
		return $this->db->count_all($this->table_name);
	}

	public function listCuti($limit = array(), $pencarian)
	{

		$this->db->select('*');
		if ($pencarian) {
			$this->db->like('nik',$pencarian);
			$this->db->or_like('kd_pcuti',$pencarian);
		}
		$this->db->join('jenis_cuti', 'jenis_cuti.id = '.$this->table_name.'.jenis_cuti_id', 'left');
		if ($limit == null) {
			$query = $this->db->get($this->table_name);
		} else {
			$query = $this->db->get($this->table_name, $limit['perpage'], $limit['offset']);
		}
		$list = array(
			'result' => $query->result_array(),
			'count' => $this->db->count_all_results()
		);
		return $list;
	}

	public function getCuti($kode)
	{
		$this->db->where('kd_pcuti', $kode);  
	  	$query = $this->db->get($this->table_name);  
	  	if($query->num_rows() > 0){  
	   		return $query->row();  
	  	} else{  
	   		return null;  
	  	}  
	}

	public function updateCuti($id, $data) {
		$this->db->where('kd_pcuti', $id);  
		$this->db->update($this->table_name, $data);  
		// echo $this->db->last_query();exit;
		if($this->db->affected_rows() > 0){  
			return true;  
		}  
		else{  
			return false;  
		}  
	}

	 function newCuti($data)
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
		$this->db->where('kd_pcuti', $id);  
		$this->db->delete($this->table_name);  
		if($this->db->affected_rows() > 0){  
			return true;  
		}  
		else{  
			return false;  
		}      
	} 
}
