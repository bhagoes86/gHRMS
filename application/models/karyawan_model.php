<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Karyawan_Model extends CI_Model { 

	public function __construct()
	{
	   parent::__construct();
	   $this->table_name = 'karyawan';
	}

	public function jumlahKaryawan()
	{
		return $this->db->count_all($this->table_name);
	}

	public function listKaryawan($limit = array(), $pencarian="")
	{
		$this->db->select('karyawan.id, 
			karyawan.nik, karyawan.nama_depan, karyawan.nama_belakang, 
			departemen.nama_departemen, 
			jabatan.nama_jabatan, status.nama_status, karyawan.join_date');
		if ($pencarian != "") {
			
			$this->db->like('nama_depan',$pencarian);
			$this->db->or_like('nama_belakang',$pencarian);
			
		}	
		$this->db->join('departemen', 'departemen.id = '.$this->table_name.'.departemen_id', 'left');
		$this->db->join('jabatan', 'jabatan.id = '.$this->table_name.'.jabatan_id', 'left');
		$this->db->join('status', 'status.id = '.$this->table_name.'.status_id', 'left');
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

	public function getKaryawan($kode)
	{
		$this->db->where('id', $kode);  
	  	$query = $this->db->get($this->table_name);  
	  	if($query->num_rows() > 0){  
	   		return $query->row();  
	  	} else{  
	   		return null;  
	  	}  
	}

	public function getKaryawanByNik($nik)
	{
		$this->db->select('
			karyawan.nik,
			karyawan.nama_depan, 
			karyawan.nama_belakang, 
			karyawan.alamat, 
			karyawan.gapok,
			jabatan.nama_jabatan, 
			jabatan.tunjangan as tunjangan_jabatan'
		);		
		$this->db->where('karyawan.nik',$nik);
		$this->db->join('jabatan', 'jabatan.id = karyawan.jabatan_id', 'left');
		$this->db->join('status', 'status.id = karyawan.status_id', 'left');
		$query = $this->db->get('karyawan');
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return null;
		}
	}

	public function updateKaryawan($id, $data) {
		$this->db->where('id', $id);  
		$this->db->update($this->table_name, $data);  
		if($this->db->affected_rows() > 0){  
			return true;  
		}  
		else{  
			return false;  
		}  
	}

	 function newKaryawan($data)
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