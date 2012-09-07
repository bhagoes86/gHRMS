<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Presensi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('presensi_model', 'presensi');
    }

    public function index($offset = 0)
    {
        $view = 'presensi/index';
        //tentukan jumlah perpage boz
        $perpage = 5;
         //load dulu dong library paginationnya
        $this->load->library('pagination');

        $pencarian = $this->input->get('pencarian');
        $presensi = $this->presensi->listPresensi(array('perpage' => $perpage, 'offset' => $offset), $pencarian);
        
        if (!$pencarian) {
            $total_rows = $this->presensi->jumlahPresensi();
        } else {
            $total_rows = $presensi['count'];
        }

        //untuk konfigurasi pagination pake ini
        $config = array(
            'base_url' => base_url() . 'index.php/presensi/index/',
            'total_rows' => $total_rows,
            'per_page' => $perpage,
        );

        //inisialisasi pagination & config di atas
        $this->pagination->initialize($config);

       // var_dump($presensi);
       // exit;
        
        $data = array(
            'presensi' => $presensi ['result'],
            'jumlah' => $presensi ['count']
            );
        gview($view, $data);
    }

    public function submit()
    {
        $result =  $this->input->post();
        $tanggal =  $result['tanggal'];
        foreach ($result['keterangan'] as $va => $k) {

            $this->presensi->update_absensi($tanggal, $va, $k);
        }
        redirect('presensi');
        // var_dump($this->input->post());

    }

    public function edit()
    {
        // initialize view
        $view = 'presensi/edit';
        $this->load->helper('form');
        $id = $this->input->post('id');
        if (!empty($id)) 
            $kode = $id;
        else 
            $kode = $this->security->xss_clean($this->uri->segment(3));
        $result = $this->presensi->getPresensi($kode);  
        // print_r($result);exit;
        if ($result == null) 
            redirect('presensi');
        else 
            $data['data_presensi'] = $result;     
        gview($view, $data);
     }

     public function tambah() {
        // initialize view
        $view = 'presensi/edit';
        $data['presensi'] = '';
        gview($view, $data);
     }
     
     function delete() //untuk menghapus data cd
     {   
        $id = $this->security->xss_clean($this->uri->segment(3));
        $result = $this->presensi->getPresensi($id);
        if ($result == null) {
            redirect('presensi');
        } else { 
            $delete = $this->presensi->delete_data($id);
            if ($delete) set_flash('message', 'alert-success', 'Presensi deleted', 'presensi');
            else set_flash('message', 'alert-error', 'Failed to delete data!', 'presensi');
        }
     }
     
     function create() //untuk menambah data cd
     {
        // setting konfigurasi form validation
        $this->form_validation->set_error_delimiters('<div id="error">', '</div>');
        $this->form_validation->set_rules('presensi','presensi', 'trim|required|xss_clean');

        // jika tidak lolos validasi
        if ($this->form_validation->run() == FALSE){
            $this->index();

      // jika lolos validasi
        } else {
            $data = array(
                'nik' => $this->input->post('nik'),
                'nama_depan'=> $this->input->post('nama_depan'),
                'nama_belakang'=> $this->input->post('nama_belakang')

                );
            $create = $this->presensi->newPresensi($data);
            // tampilkan information message
            if ($create) set_flash('message', 'alert-success', 'Presensi created', 'presensi');
            else set_flash('message', 'alert-error', 'Failed to create data!', 'presensi');
        }
     }
     
     function update() //untuk meng-update data cd
     {
        // setting konfigurasi form validation
        $this->form_validation->set_error_delimiters('<div id="error">', '</div>');
        $this->form_validation->set_rules('presensi','presensi', 'trim|required|xss_clean');
        // jika tidak lolos validasi
        if ($this->form_validation->run() == FALSE){
            $this->edit();

        // jika lolos validasi
        } else {
            $id = $this->input->post('id');
            $data = array(
                'nik' => $this->input->post('nik'),
                'nama_depan'=> $this->input->post('nama_depan'),
                'nama_belakang'=> $this->input->post('nama_belakang'),

                );
            $update = $this->presensi->updatePresensi($id,$data);
            // tampilkan information message
            if ($update) set_flash('message', 'alert-success', ' Presensi updated', 'presensi');
            else set_flash('message', 'alert-error', 'Failed to update data!', 'presensi');
        }
     }

}

/* End of file presensi.php */
/* Location: ./application/controllers/presensi.php */