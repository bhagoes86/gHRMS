<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index()
    {
    	$view = 'home/index';
    	$data = array();
    	gview($view,$data);
    	$this->check_isvalidated();
    }

    public function check_isvalidated()
    {
        if (!$this->session->userdata('validated')) {
            redirect('login');
        }
    }

    public function login() {
    	
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */	