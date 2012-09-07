<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class  Penggajian extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('penggajian_model', 'penggajian');
    }

    public function index($offset = 0)
    {
        $view = 'penggajian/index';
        //tentukan jumlah perpage boz
        $perpage = 5;
         //load dulu dong library paginationnya
        $this->load->library('pagination');

        //untuk konfigurasi pagination pake ini
        $config = array(
            'base_url' => base_url() . 'index.php/penggajian/index/',
            'total_rows' => $this->penggajian->jumlahPenggajian(),
            'per_page' => $perpage,
        );

        //inisialisasi pagination & config di atas
        $this->pagination->initialize($config);

        $penggajian = $this->penggajian->listPenggajian(array('perpage' => $perpage, 'offset' => $offset));
        $data = array(
            'penggajian' => $penggajian,
            'jumlah' => $this->penggajian->jumlahPenggajian()
            );
        gview($view, $data);
    }

    public function edit()
    {
        // initialize view
        $view = 'penggajian/edit';
        $this->load->helper('form');
        $id = $this->input->post('id');
        if (!empty($id)) 
            $kode = $id;
        else 
            $kode = $this->security->xss_clean($this->uri->segment(3));
        $result = $this->penggajian->getPenggajian($kode);  
        // print_r($result);exit;
        if ($result == null) 
            redirect('karyawan_id','gaji','potongan','tunjangan','tgl_pengambilan');
        else 
            $data['data_penggajian'] = $result;     
        gview($view, $data);
     }

     public function tambah() {
        // initialize view
        $view = 'penggajian/edit';
        $data['penggajian'] = '';
        gview($view, $data);
     }
     
     function delete() //untuk menghapus data cd
     {   
        $id = $this->security->xss_clean($this->uri->segment(3));
        $result = $this->penggajian->getPenggajian($id);
        if ($result == null) {
            redirect('karyawan_id','gaji','potongan','tunjangan','tgl_pengambilan');
        } else { 
            $delete = $this->penggajian->delete_data($id);
            if ($delete) set_flash('message', 'alert-success', 'Payrolls deleted', 'penggajian');
            else set_flash('message', 'alert-error', 'Failed to delete data!', 'penggajian');
        }
     }
     
     function create() //untuk menambah data cd
     {
        // setting konfigurasi form validation
        $this->form_validation->set_error_delimiters('<div id="error">', '</div>');
        $this->form_validation->set_rules('karyawan_id','karyawan_id', 'trim|required|xss_clean');
        $this->form_validation->set_rules('gaji','gaji', 'trim|required|xss_clean');
        $this->form_validation->set_rules('potongan','potongan', 'trim|required|xss_clean');
        $this->form_validation->set_rules('tunjangan','tunjangan', 'trim|required|xss_clean');
        $this->form_validation->set_rules('tgl_penggajian','tgl_pengambilan', 'trim|required|xss_clean');
        // jika tidak lolos validasi
        if ($this->form_validation->run() == FALSE){
            $this->index();

      // jika lolos validasi
        } else {
            $data = array(
                'karyawan_id' => $this->input->post('karyawan_id'),
                'gaji' => $this->input->post('gaji'),
                'potongan' => $this->input->post('potongan'),
                'tunjangan' => $this->input->post('tunjangan'),
                'tgl_pengambilan' => $this->input->post('tgl_pengambilan'),
                );
            $create = $this->penggajian->newPenggajian($data);
            // tampilkan information message
            if ($create) set_flash('message', 'alert-success', 'Payrolls created', 'penggajian');
            else set_flash('message', 'alert-error', 'Failed to create data!', 'penggajian');
        }
     }
     
     function update() //untuk meng-update data cd
     {
        // setting konfigurasi form validation
        $this->form_validation->set_error_delimiters('<div id="error">', '</div>');
        $this->form_validation->set_rules('karyawan_id','karyawan_id', 'trim|required|xss_clean');
        $this->form_validation->set_rules('gaji','gaji', 'trim|required|xss_clean');
        $this->form_validation->set_rules('potongan','potongan', 'trim|required|xss_clean');
        $this->form_validation->set_rules('tunjangan','tunjangan', 'trim|required|xss_clean');
        $this->form_validation->set_rules('tgl_penggajian','tgl_pengambilan', 'trim|required|xss_clean');
        // jika tidak lolos validasi
        if ($this->form_validation->run() == FALSE){
            $this->edit();

        // jika lolos validasi
        } else {
            $id = $this->input->post('id');
            $data = array(
                'karyawan_id' => $this->input->post('karyawan_id'),
                'gaji' => $this->input->post('gaji'),
                'potongan' => $this->input->post('potongan'),
                'tunjangan' => $this->input->post('tunjangan'),
                'tgl_pengambilan' => $this->input->post('tgl_pengambilan'),
                );
            $update = $this->penggajian->updatePenggajian($id,$data);
            // tampilkan information message
            if ($update) set_flash('message', 'alert-success', 'Penggajian updated', 'penggajian');
            else set_flash('message', 'alert-error', 'Failed to update data!', 'penggajian');
        }
     }

}

/* End of file penggajian.php */
/* Location: ./application/controllers/penggajian.php */