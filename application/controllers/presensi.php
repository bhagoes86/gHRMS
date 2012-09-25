<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Presensi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('presensi_model', 'presensi');
    }


    public function index()
    {
        $view = 'presensi/index';
        // $nik = $this->input->get('nik');
        $hari_ini = date("Y-m-d");
        if ($this->input->post('hari_ini')) {
            $hari_ini = $this->input->post('hari_ini');
        }
        $data = array(
                'data_presensi' => $this->presensi->get_all($hari_ini)
            );
        gview($view, $data);
    }

    public function check_in()
    {
        $nik = $this->input->get('nik');
        $hari_ini = date("Y-m-d");
        return $this->presensi->check_in($nik, $hari_ini);
    }

}

/* End of file presensi.php */
/* Location: ./application/controllers/presensi.php */
