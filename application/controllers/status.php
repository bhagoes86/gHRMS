<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class  status extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('status_model', 'status');
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
        $view = 'status/index';
        //tentukan jumlah perpage boz
        $perpage = 15;
         //load dulu dong library paginationnya
        $this->load->library('pagination');

        $pencarian = $this->input->get('pencarian');
        $status = $this->status->listStatus(array('perpage' => $perpage, 'offset' => $offset), $pencarian);
        
        if (!$pencarian) {
            $total_rows = $this->status->jumlahStatus();
        } else {
            $total_rows = $status['count'];
        }

        //untuk konfigurasi pagination pake ini
        $config = array(
            'base_url' => base_url() . 'index.php/status/index/',
            'total_rows' => $total_rows,
            'per_page' => $perpage,
        );

        //inisialisasi pagination & config di atas
        $this->pagination->initialize($config);

       // var_dump($status);
       // exit;
        
        $data = array(
            'status' => $status['result'],
            'jumlah' => $status['count']
            );
        gview($view, $data);
    }


    public function edit()
    {
        // initialize view
        $view = 'status/edit';
        $this->load->helper('form');
        $id = $this->input->post('id');
        if (!empty($id)) 
            $kode = $id;
        else 
            $kode = $this->security->xss_clean($this->uri->segment(3));
        $result = $this->status->getStatus($kode);  
        // print_r($result);exit;
        if ($result == null) 
            redirect('status');
        else 
            $data['data_status'] = $result;     
        gview($view, $data);
     }

     public function tambah() {
        // initialize view
        $view = 'status/edit';
        $data['status'] = '';
        gview($view, $data);
     }
     
     function delete() //untuk menghapus data cd
     {   
        $id = $this->security->xss_clean($this->uri->segment(3));
        $result = $this->status->getStatus($id);
        if ($result == null) {
            redirect('status');
        } else { 
            $delete = $this->status->delete_data($id);
            if ($delete) set_flash('message', 'alert-success', 'Status berhasil didelete', 'status');
            else set_flash('message', 'alert-error', 'Failed to delete data!', 'status');
        }
     }
     
     function create() //untuk menambah data cd
     {
        // setting konfigurasi form validation
        $this->form_validation->set_error_delimiters('<div id="error">', '</div>');
        $this->form_validation->set_rules('status','status', 'trim|required|xss_clean');

        // jika tidak lolos validasi
        if ($this->form_validation->run() == FALSE){
            $this->index();

      // jika lolos validasi
        } else {
            $data = array(
                'nama_status' => $this->input->post('status')
                );
            $create = $this->status->newStatus($data);
            // tampilkan information message
            if ($create) set_flash('message', 'alert-success', 'Status berhasil ditambah', 'status');
            else set_flash('message', 'alert-error', 'Failed to create data!', 'status');
        }
     }
     
     function update() //untuk meng-update data cd
     {
        // setting konfigurasi form validation
        $this->form_validation->set_error_delimiters('<div id="error">', '</div>');
        $this->form_validation->set_rules('status','status', 'trim|required|xss_clean');
        // jika tidak lolos validasi
        if ($this->form_validation->run() == FALSE){
            $this->edit();

        // jika lolos validasi
        } else {
            $id = $this->input->post('id');
            $data = array(
                'nama_status' => $this->input->post('status')
                );
            $update = $this->status->updateStatus($id,$data);
            // tampilkan information message
            if ($update) set_flash('message', 'alert-success', 'Status berhasil diupdate', 'status');
            else set_flash('message', 'alert-error', 'Failed to update data!', 'status');
        }
     }

}

/* End of file status.php */
/* Location: ./application/controllers/status.php */