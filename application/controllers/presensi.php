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

        $dari_month = date("m",strtotime($dari));
        $sampai_month = date("m",strtotime($sampai));

        $dari_day = date("d",strtotime($dari));
        $sampai_day = date("d",strtotime($sampai));

        if (date($dari) > date($sampai)) {
            set_flash('message', 'alert-error', 'Tanggal mulai lebih besar dari Tanggal akhir', 'presensi/rekap');
        }
        $data_presensi = $this->presensi->get_rekap($dari, $sampai);
        // echo count($data_presensi);exit;

        $nik_prev = '';
        $tableRow = array();

        foreach ($data_presensi as $absen) {
            $nik = $absen['karyawan_id'];
            $dari_save2 = $dari;
            $sampai_save2 = $sampai;
            
            // if ($nik_prev != $nik) {
                $tanggal = $absen['tanggal'];
                $nama = $absen['nama_depan'].' '.$absen['nama_belakang'];

                $jam_masuk = $absen['jam_masuk'];
                $jam_keluar = $absen['jam_keluar'];

                $absen = array($tanggal=>$jam_masuk.' '.$jam_keluar);
                exit;
            // } else {
            //     $nik_prev = $nik;
            // }

        }
        echo json_encode($bulan);
        
        $data = array(
                'data_presensi' => $tableRow,
                'dari' => $dari,
                'sampai' => $sampai
            );
        $this->load->view('presensi/print_rekap', $data);
    }

}

/* End of file presensi.php */
/* Location: ./application/controllers/presensi.php */
