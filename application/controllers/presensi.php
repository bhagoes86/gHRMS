<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Presensi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->check_isvalidated();
        $this->load->model('presensi_model', 'presensi');
    }

    public function check_isvalidated()
    {
        if (!$this->session->userdata('validated')) {
            redirect('login');
        }
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

    public function rekap()
    {
        $view = "presensi/rekap_presensi";
        $data = array();
        gview($view, $data);
    }

    public function generate()
    {
        $dari = $this->input->post('dari');
        $sampai = $this->input->post('sampai');

        if (date($dari) > date($sampai)) {
            set_flash('message', 'alert-error', 'Tanggal mulai lebih besar dari Tanggal akhir', 'presensi/rekap');
        }
        $data_presensi = $this->presensi->get_rekap($dari, $sampai);
        // echo count($data_presensi);exit;

        
        $data = array(
                'data_presensi' => $data_presensi,
                'dari' => $dari,
                'sampai' => $sampai
            );
        $this->load->view('presensi/print_rekap', $data);
    }

}

/* End of file presensi.php */
/* Location: ./application/controllers/presensi.php */
