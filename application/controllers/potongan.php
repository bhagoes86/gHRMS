<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class  Potongan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('potongan_model', 'potongan');
        $this->check_isvalidated();
    }

    public function check_isvalidated()
    {
        if (!$this->session->userdata('validated')) {
            redirect('login');
        }
    }

    public function index($offset = 0)
    {
        $view = 'potongan/index';
        //tentukan jumlah perpage boz
        $perpage = 15;
         //load dulu dong library paginationnya
        $this->load->library('pagination');
        $pencarian = $this->input->get('pencarian');
        $potongan = $this->potongan->listPotongan(array('perpage' => $perpage, 'offset' => $offset), $pencarian);
        
        if (!$pencarian) {
            $total_rows = $this->potongan->jumlahPotongan();
        } else {
            $total_rows = $potongan['count'];
        }

        //untuk konfigurasi pagination pake ini
        $config = array(
            'base_url' => base_url() . 'index.php/potongan/index/',
            'total_rows' => $total_rows,
            'per_page' => $perpage,
        );

        //inisialisasi pagination & config di atas
        $this->pagination->initialize($config);

        $data = array(
            'potongan' => $potongan['result'],
            'jumlah' => $potongan['count']
            );
        gview($view, $data);
    }

    public function edit()
    {
        // initialize view
        $view = 'potongan/edit';
        $this->load->helper('form');
        $id = $this->input->post('id');
        if (!empty($id)) 
            $kode = $id;
        else 
            $kode = $this->security->xss_clean($this->uri->segment(3));
        $result = $this->potongan->getPotongan($kode);  
        // print_r($result);exit;
        if ($result == null) 
            redirect('nama_potongan','jumlah','status_id');
        else 
            $data['data_potongan'] = $result;     
        gview($view, $data);
     }

     public function tambah() {
        // initialize view
        $view = 'potongan/edit';
        $data['potongan'] = '';
        gview($view, $data);
     }
     
     function delete() //untuk menghapus data cd
     {   
        $id = $this->security->xss_clean($this->uri->segment(3));
        $result = $this->potongan->getPotongan($id);
        if ($result == null) {
            redirect('nama_potongan','jumlah','status_id');
        } else { 
            $delete = $this->potongan->delete_data($id);
            if ($delete) set_flash('message', 'alert-success', 'Potongan deleted', 'potongan');
            else set_flash('message', 'alert-error', 'Failed to delete data!', 'potongan');
        }
     }
     
     function create() //untuk menambah data cd
     {
        // setting konfigurasi form validation
        $this->form_validation->set_error_delimiters('<div id="error">', '</div>');
        $this->form_validation->set_rules('nama_potongan','nama_potongan', 'trim|required|xss_clean');
        $this->form_validation->set_rules('jumlah','jumlah', 'trim|required|xss_clean');
        $this->form_validation->set_rules('status_id','status_id', 'trim|required|xss_clean');
        // jika tidak lolos validasi
        if ($this->form_validation->run() == FALSE){
            $this->index();

      // jika lolos validasi
        } else {
            $data = array(
                'nama_potongan' => $this->input->post('nama_potongan'),
                'jumlah' => $this->input->post('jumlah'),
                'status_id' => $this->input->post('status_id'),
                );
            $create = $this->potongan->newPotongan($data);
            // tampilkan information message
            if ($create) set_flash('message', 'alert-success', 'Potongan created', 'potongan');
            else set_flash('message', 'alert-error', 'Failed to create data!', 'potongan');
        }
     }
     
     function update() //untuk meng-update data cd
     {
        // setting konfigurasi form validation
        $this->form_validation->set_error_delimiters('<div id="error">', '</div>');
        $this->form_validation->set_rules('nama_potongan','nama_potongan', 'trim|required|xss_clean');
        $this->form_validation->set_rules('jumlah','jumlah', 'trim|required|xss_clean');
        $this->form_validation->set_rules('status_id','status_id', 'trim|required|xss_clean');
        // jika tidak lolos validasi
        if ($this->form_validation->run() == FALSE){
            $this->edit();

        // jika lolos validasi
        } else {
            $id = $this->input->post('id');
            $data = array(
                'nama_potongan' => $this->input->post('nama_potongan'),
                'jumlah' => $this->input->post('jumlah'),
                'status_id' => $this->input->post('status_id'),
                );
            $update = $this->potongan->updatePotongan($id,$data);
            // tampilkan information message
            if ($update) set_flash('message', 'alert-success', 'Potongan updated', 'potongan');
            else set_flash('message', 'alert-error', 'Failed to update data!', 'potongan');
        }
     }

}

/* End of file potongan.php */
/* Location: ./application/controllers/potongan.php */