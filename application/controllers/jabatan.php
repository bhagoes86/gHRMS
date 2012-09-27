<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class jabatan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->check_isvalidated();
        $this->load->model('jabatan_model', 'jabatan');
    }
    public function check_isvalidated()
    {
        if (!$this->session->userdata('validated')) {
            redirect('login');
        }
    }

    public function index($offset = 0)
    {
        $view = 'jabatan/index';
        //tentukan jumlah perpage boz
        $perpage = 15;
         //load dulu dong library paginationnya
        $this->load->library('pagination');

        //untuk konfigurasi pagination pake ini
        $config = array(
            'base_url' => base_url() . 'index.php/jabatan/index/',
            'total_rows' => $this->jabatan->jumlahJabatan(),
            'per_page' => $perpage,
        );

        //inisialisasi pagination & config di atas
        $this->pagination->initialize($config);

        $jabatan = $this->jabatan->listJabatan(array('perpage' => $perpage, 'offset' => $offset));
        $data = array(
            'jabatan' => $jabatan,
            'jumlah' => $this->jabatan->jumlahJabatan()
            );
        gview($view, $data);
    }

    public function edit()
    {
        // initialize view
        $view = 'jabatan/edit';
        $this->load->helper('form');
        $id = $this->input->post('id');
        if (!empty($id)) 
            $kode = $id;
        else 
            $kode = $this->security->xss_clean($this->uri->segment(3));
        $result = $this->jabatan->getJabatan($kode);  
        // print_r($result);exit;
        if ($result == null) 
            redirect('jabatan');
        else 
            $data['data_jabatan'] = $result;     
        gview($view, $data);
     }

     public function tambah() {
        // initialize view
        $view = 'jabatan/edit';
        $data['jabatan'] = '';
        gview($view, $data);
     }
     
     function delete() //untuk menghapus data cd
     {   
        $id = $this->security->xss_clean($this->uri->segment(3));
        $result = $this->jabatan->getJabatan($id);
        if ($result == null) {
            redirect('jabatan');
        } else { 
            $delete = $this->jabatan->delete_data($id);
            if ($delete) set_flash('message', 'alert-success', 'Jabatan berhasil di delete', 'jabatan');
            else set_flash('message', 'alert-error', 'Failed to delete data!', 'jabatan');
        }
     }
     
     function create() //untuk menambah data cd
     {
        // setting konfigurasi form validation
        $this->form_validation->set_error_delimiters('<div id="error">', '</div>');
        $this->form_validation->set_rules('jabatan','jabatan', 'trim|required|xss_clean');

        // jika tidak lolos validasi
        if ($this->form_validation->run() == FALSE){
            $this->index();

      // jika lolos validasi
        } else {
            $data = array(
                'nama_jabatan' => $this->input->post('jabatan'),
                'tunjangan' => $this->input->post('tunjangan')
                );
            $create = $this->jabatan->newJabatan($data);
            // tampilkan information message
            if ($create) set_flash('message', 'alert-success', 'Jabatan berhasil di tambah', 'jabatan');
            else set_flash('message', 'alert-error', 'Failed to create data!', 'jabatan');
        }
     }
     
     function update() //untuk meng-update data cd
     {
        // setting konfigurasi form validation
        $this->form_validation->set_error_delimiters('<div id="error">', '</div>');
        $this->form_validation->set_rules('jabatan','jabatan', 'trim|required|xss_clean');
        // jika tidak lolos validasi
        if ($this->form_validation->run() == FALSE){
            $this->edit();

        // jika lolos validasi
        } else {
            $id = $this->input->post('id');
            $data = array(
                'nama_jabatan' => $this->input->post('jabatan'),
                'tunjangan' => $this->input->post('tunjangan')
                );
            $update = $this->jabatan->updateJabatan($id,$data);
            // tampilkan information message
            if ($update) set_flash('message', 'alert-success', 'Jabatan berhasil di update', 'jabatan');
            else set_flash('message', 'alert-error', 'Failed to update data!', 'jabatan');
        }
     }

}

/* End of file jabatan.php */
/* Location: ./application/controllers/jabatan.php */