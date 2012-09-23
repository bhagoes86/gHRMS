<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Penggajian_model extends CI_Model { 

	public function getListGaji($month, $year, $search, $by) {
		$this->db->select('p.nik, p.id, k.nama_depan, k.nama_belakang,pd.total_gaji, p.tgl_pengambilan');
		if ($by == 'nik') {
			$this->db->like('p.nik', $search);
		} else {
			$this->db->like('k.nama_depan', $search);
		}
		$this->db->where("MONTH(p.tgl_pengambilan)", $month);
		$this->db->where("YEAR(p.tgl_pengambilan)", $year);
		$this->db->join('karyawan k', 'k.nik = p.nik', 'left');
		$this->db->join('penggajian_detail pd', 'pd.penggajian_id = p.id', 'left');
		$query = $this->db->get('penggajian p');
		// echo $this->db->last_query();

		return $query->result_array();
	}

	public function getListGajiById($ids = array()) {
		$this->db->select('p.nik, p.id, k.nama_depan, k.nama_belakang,pd.total_gaji, p.tgl_pengambilan');
		$this->db->where_in('p.id', $ids);
		$this->db->join('karyawan k', 'k.nik = p.nik', 'left');
		$this->db->join('penggajian_detail pd', 'pd.penggajian_id = p.id', 'left');
		$query = $this->db->get('penggajian p');

		return $query->result_array();
	}

	public function getGaji($nik) {
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
		// return $query->result_array();

		$this->db->select('tunjangan.id,tunjangan.nama_tunjangan,tunjangan.jumlah');
		$this->db->where('karyawan.nik',$nik);
		$this->db->join('tunjangan', 'tunjangan.status_id = karyawan.status_id', 'left');
		$tunjangan = $this->db->get('karyawan');

		$this->db->select('potongan.id,potongan.nama_potongan,potongan.jumlah');
		$this->db->where('karyawan.nik',$nik);
		$this->db->join('potongan', 'potongan.status_id = karyawan.status_id', 'left');
		$potongan = $this->db->get('karyawan');

		$list = array(
			'result' => $query->result_array(),		
			'tunjangan' => $tunjangan->result_array(),
			'potongan' => $potongan->result_array()
			);
		
		return $list;
	}

	public function inputGaji($nik, $gapok, $tunjangan, $potongan, $tgl_ambil) {
		$data = array(
			'nik'	=> $nik,
			'gaji'	=> $gapok,
			'tunjangan' => $tunjangan,
			'potongan' => $potongan,
			'tgl_pengambilan' => $tgl_ambil
		);

		$this->db->insert('penggajian', $data);  
	 	if($this->db->affected_rows() > 0){  
	 		$detail = array(
	 			'penggajian_id' => $this->db->insert_id(),
	 			'total_gaji'=> $gapok + $tunjangan - $potongan
	 		); 

	 		$this->db->insert('penggajian_detail', $detail);
	 		if ($this->db->affected_rows() > 0) {
	 			return true;  	
	 		} else {
	 			return false;	
	 		}
	 	} else {  
	 		return false;  
	 	}  
	}

}