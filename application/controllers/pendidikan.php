<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pendidikan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('pendidikan_model', 'pendidikan');
    }

    public function index($offset = 0)
    {
        $view = 'pendidikan/index';
        //tentukan jumlah perpage boz
        $perpage = 15;
         //load dulu dong library paginationnya
        $this->load->library('pagination');

        //untuk konfigurasi pagination pake ini
        $config = array(
            'base_url' => base_url() . 'index.php/pendidikan/index/',
            'total_rows' => $this->pendidikan->jumlahPendidikan(),
            'per_page' => $perpage,
        );

        //inisialisasi pagination & config di atas
        $this->pagination->initialize($config);

        $pendidikan = $this->pendidikan->listPendidikan(array('perpage' => $perpage, 'offset' => $offset));
        $data = array(
            'pendidikan' => $pendidikan,
            'jumlah' => $this->pendidikan->jumlahPendidikan()
            );
        gview($view, $data);
    }

    public function edit()
    {
        // initialize view
        $view = 'pendidikan/edit';
        $this->load->helper('form');
        $id = $this->input->post('id');
        if (!empty($id)) 
            $kode = $id;
        else 
            $kode = $this->security->xss_clean($this->uri->segment(3));
        $result = $this->pendidikan->getPendidikan($kode);  
        // print_r($result);exit;
        if ($result == null) 
            redirect('pendidikan');
        else 
            $data['data_pendidikan'] = $result;     
        gview($view, $data);
     }

     public function tambah() {
        // initialize view
        $view = 'pendidikan/edit';
        $data['pendidikan'] = '';
        gview($view, $data);
     }
     
     function delete() //untuk menghapus data cd
     {   
        $id = $this->security->xss_clean($this->uri->segment(3));
        $result = $this->pendidikan->getPendidikan($id);
        if ($result == null) {
            redirect('pendidikan');
        } else { 
            $delete = $this->pendidikan->delete_data($id);
            if ($delete) set_flash('message', 'alert-success', 'Pendidikan berhasil dihapus', 'pendidikan');
            else set_flash('message', 'alert-error', 'Failed to delete data!', 'pendidikan');
        }
     }
     
     function create() //untuk menambah data cd
     {
        // setting konfigurasi form validation
        $this->form_validation->set_error_delimiters('<div id="error">', '</div>');
        $this->form_validation->set_rules('nama_pendidikan','pendidikan', 'trim|required|xss_clean');

        // jika tidak lolos validasi
        if ($this->form_validation->run() == FALSE){
            $this->index();

      // jika lolos validasi
        } else {
            $data = array(
                'nama_pendidikan' => $this->input->post('nama_pendidikan')
                );
            // echo var_dump($data);exit;
            $create = $this->pendidikan->newPendidikan($data);
            // tampilkan information message
            if ($create) set_flash('message', 'alert-success', 'Pendidikan berhasil dibuat', 'pendidikan');
            else set_flash('message', 'alert-error', 'Failed to create data!', 'pendidikan');
        }
     }
     
     function update() //untuk meng-update data cd
     {
        // setting konfigurasi form validation
        $this->form_validation->set_error_delimiters('<div id="error">', '</div>');
        $this->form_validation->set_rules('nama_pendidikan','pendidikan', 'trim|required|xss_clean');
        // jika tidak lolos validasi
        if ($this->form_validation->run() == FALSE){
            $this->edit();

        // jika lolos validasi
        } else {
            $id = $this->input->post('id');
            $data = array(
                'nama_pendidikan' => $this->input->post('nama_pendidikan')
                );
            $update = $this->pendidikan->updatePendidikan($id,$data);
            // tampilkan information message
            if ($update) set_flash('message', 'alert-success', 'Pendidikan berhasil diupdate', 'pendidikan');
            else set_flash('message', 'alert-error', 'Failed to update data!', 'pendidikan');
        }
     }

}

/* End of file pendidikan.php */
/* Location: ./application/controllers/pendidikan.php */