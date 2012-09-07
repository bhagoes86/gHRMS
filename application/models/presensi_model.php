<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Presensi_model extends CI_Model { 

	public function __construct()
	{
	   parent::__construct();
	   $this->table_name = 'presensi';
	}

	public function jumlahPresensi()
	{
		return $this->db->count_all($this->table_name);
	}

	public function update_absensi($tanggal, $nik, $keterangan) {
		$data = array(
               'tanggal' => $tanggal,
               'karyawan_id' => $nik,
               'keterangan' => $keterangan
            );

		$this->db->where('karyawan_id', $nik);
		// $this->db->where('tanggal', $tanggal);
		$this->db->update($this->table_name, $data); 
	}

	public function listPresensi($limit = array(), $pencarian)
	{

		$this->db->select('*');
		$this->db->join('karyawan', 'karyawan.nik = '.$this->table_name.'.karyawan_id');
		if ($pencarian) {
			$this->db->like('presensi',$pencarian);
		}

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

	public function getPresensi($kode)
	{
		$this->db->where('id', $kode);  
	  	$query = $this->db->get($this->table_name);  
	  	if($query->num_rows() > 0){  
	   		return $query->row();  
	  	} else{  
	   		return null;  
	  	}  
	}

	public function updatePresensi($id, $data) {
		$this->db->where('id', $id);  
		$this->db->update($this->table_name, $data);  
		if($this->db->affected_rows() > 0){  
			return true;  
		}  
		else{  
			return false;  
		}  
	}

	 function newPresensi($data)
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
