<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Presensi_model extends CI_Model {

	public function get_all($hari_ini)
	{
		$this->db->select('presensi.id,presensi.tanggal,presensi.karyawan_id,presensi.jam_masuk,presensi.jam_keluar,karyawan.nama_depan,karyawan.nama_belakang,jabatan.nama_jabatan');
		$this->db->join('karyawan','karyawan.nik = presensi.karyawan_id', 'left');
		$this->db->join('jabatan', 'jabatan.id = karyawan.jabatan_id');
		$this->db->where('presensi.tanggal', $hari_ini);
		$query = $this->db->get('presensi');
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		} else {
			return null;
		}
		
	}

	public function check_in($nik, $hari_ini)    
	{
		$masuk = $this->sudah_masuk($nik, $hari_ini);
		if ($masuk) {
			$this->keluar($nik, $hari_ini);
		} else {
			$this->masuk($nik, $hari_ini);
		}
	}

	public function sudah_masuk($nik, $hari_ini)
	{
		$this->db->select('*');
		$query = $this->db->get_where('presensi', array('karyawan_id'=>$nik, 'tanggal'=>$hari_ini));
		if ($query->num_rows() > 0) {
			return true;
		}
		return false;
	}

	public function masuk($nik, $hari_ini) {
		$time = date('H:i:s');
		$data = array(
				'jam_masuk' =>$time,
				'karyawan_id' => $nik,
				'tanggal' => $hari_ini
			);
		return $this->db->insert('presensi', $data);
	}

	public function keluar($nik, $hari_ini) {
		$time = date('H:i:s');
		$data = array(
				'jam_keluar' =>$time,
				'karyawan_id' => $nik,
				'tanggal' => $hari_ini
			);
		return $this->db->update('presensi', $data);
	}

}

/* End of file presensi_model.php */
/* Location: ./application/models/presensi_model.php */
