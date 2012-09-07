<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model { 
	public function login($username, $password)
	{
		$this->db->select('id,username,password');
		$this->db->from('admin');
		$this->db->where('username', $username);
		$this->db->where('password', md5($password));

		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			$row =  $query->row();
			$data = array(
				'userid' => $row->id,
				'username' => $row->username,
				'password'	=> $row->password,
				'validated'	=> true
			);
			$this->session->set_userdata($data);
			return true;
		}
		return false;
	}
}