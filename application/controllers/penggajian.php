<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class  Penggajian extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('penggajian_model', 'gaji');
        $this->load->model('penggajian_model', 'gaji_detail');
    }

    public function index() {
        $view = "penggajian/index";
        $monthNow = date("m");
        $yearNow = date('Y');
        $month = $this->input->post('month');
        $year = $this->input->post('year');
        if (!$month || !$year) {
            $penggajian = $this->gaji->getListGaji($monthNow, $yearNow);
        } else {
            $penggajian = $this->gaji->getListGaji($month, $year);
        }
        $data = array('penggajian'=>$penggajian);
        gview($view, $data);
    }

    public function get_gaji() {
        $nik = $this->input->get('nik');
        $data = $this->gaji->getGaji($nik);
        echo json_encode($data);
        exit;
    }

    public function input_gaji() {
        $view = "penggajian/input_gaji";
        $data = array();
        gview($view, $data);
    }

    public function simpan_gaji() {
        // $kode_gaji = $this->input->post('kode_gaji');
        $nik = $this->input->post('nik');
        $gapok = $this->input->post('gapok');
        $tunjangan = $this->input->post('total_tunjangan');
        $potongan = $this->input->post('total_potongan');
        $tgl_ambil = $this->input->post('tgl_penggajian');

        $status = $this->gaji->inputGaji($nik, $gapok, $tunjangan, $potongan, $tgl_ambil);
        if ($status) {
            $this->index();
        }
    }

    
}

/* End of file penggajian.php */
/* Location: ./application/controllers/penggajian.php */