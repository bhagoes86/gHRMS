<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Karyawan_tunjangan_model extends CI_Model { 

	public function __construct()
	{
	   parent::__construct();
	   $this->table_name = 'karyawan_tunjangan';
	}

	public function jumlahKaryawan_tunjangan()
	{
		return $this->db->count_all($this->table_name);
	}

	public function update_Karyawan_tunjangan($nik,$karyawan_id,$tunjangan_id, $keterangan,$tgl_update) 
	{
		$data = array(
               'karyawan_id' => $status_id,
               'tunjangan_id' => $tunjangan_id,
               'keterangan'=> $keterangan,
               'tgl_update' => $tgl_update,
            );

		$this->db->where('karyawan_id', $nik);
		// $this->db->where('tanggal', $tanggal);
		$this->db->update($this->table_name, $data); 
	}

	public function listKaryawan_tunjangan($limit = array(), $pencarian)
	{

		$this->db->select('*');
		$this->db->join('karyawan', 'karyawan.status_id = '.$this->table_name.'.karyawan_id');
		if ($pencarian) {
			$this->db->like('karyawan_tunjangan',$pencarian);
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

	public function getkaryawan_tunjangan($kode)
	{
		$this->db->where('id', $kode);  
	  	$query = $this->db->get($this->table_name);  
	  	if($query->num_rows() > 0){  
	   		return $query->row();  
	  	} else{  
	   		return null;  
	  	}  
	}

	public function updateKaryawan_tunjangan($id, $data) {
		$this->db->where('id', $id);  
		$this->db->update($this->table_name, $data);  
		if($this->db->affected_rows() > 0){  
			return true;  
		}  
		else{  
			return false;  
		}  
	}

	 function newKaryawan_tunjangan($data)
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
