<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
	   parent::__construct();
	   $this->load->model('login_model','login');
	}

    public function index()
    {
    	$this->load->helper(array('form','url'));
    	gview('login/login_view', array());
    }

    public function verify()
    {
    	// load library validation form
    	$this->load->library('form_validation');
    	$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
    	$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');

    	if ($this->form_validation->run() == false) {
    		// jika validasi gagal maka redirect ke form login lagi
    		gview('login/login_view', array());
    	} else {
    		redirect('/','refresh');
    	}
    }

    public function check_database($password)
    {
    	// validasi sukses. tinggal validasi di database coy
    	$username = $this->input->post('username');

    	// query database
    	$result = $this->login->login($username, $password);

    	if ($result) {
    		return true;
    	} else {
    		$this->form_validation->set_message('check_database', 'Username dan Password Salah');
    		return false;
    	}
    }


    public function logout()
    {
    	$this->session->unset_userdata('useid');
    	$this->session->unset_userdata('username');
    	$this->session->unset_userdata('password');
    	$this->session->unset_userdata('validated');
    	// session_destroy();
    	redirect('login/index');
    }
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */	