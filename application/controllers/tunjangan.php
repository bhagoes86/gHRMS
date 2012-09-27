<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class  tunjangan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('tunjangan_model', 'tunjangan');
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
        $view = 'tunjangan/index';
        //tentukan jumlah perpage boz
        $perpage = 15;
         //load dulu dong library paginationnya
        $this->load->library('pagination');
        $pencarian = $this->input->get('pencarian');
        $tunjangan = $this->tunjangan->listTunjangan(array('perpage' => $perpage, 'offset' => $offset), $pencarian);
        
        if (!$pencarian) {
            $total_rows = $this->tunjangan->jumlahTunjangan();
        } else {
            $total_rows = $tunjangan['count'];
        }

        //untuk konfigurasi pagination pake ini
        $config = array(
            'base_url' => base_url() . 'index.php/tunjangan/index/',
            'total_rows' => $total_rows,
            'per_page' => $perpage,
        );

        //inisialisasi pagination & config di atas
        $this->pagination->initialize($config);

        $data = array(
            'tunjangan' => $tunjangan['result'],
            'jumlah' => $tunjangan['count']
            );
        gview($view, $data);
    }

    public function edit()
    {
        // initialize view
        $view = 'tunjangan/edit';
        $this->load->helper('form');
        $id = $this->input->post('id');
        if (!empty($id)) 
            $kode = $id;
        else 
            $kode = $this->security->xss_clean($this->uri->segment(3));
        $result = $this->tunjangan->getTunjangan($kode);  
        // print_r($result);exit;
        if ($result == null) 
            redirect('tunjangan','jumlah','status_id');
        else 
            $data['data_tunjangan'] = $result;     
        gview($view, $data);
     }

     public function tambah() {
        // initialize view
        $view = 'tunjangan/edit';
        $data['tunjangan'] = '';
        gview($view, $data);
     }
     
     function delete() //untuk menghapus data cd
     {   
        $id = $this->security->xss_clean($this->uri->segment(3));
        $result = $this->tunjangan->getTunjangan($id);
        if ($result == null) {
            redirect('tunjangan','jumlah','status_id');
        } else { 
            $delete = $this->tunjangan->delete_data($id);
            if ($delete) set_flash('message', 'alert-success', 'Tunjangan berhasil dihapus', 'tunjangan');
            else set_flash('message', 'alert-error', 'Failed to delete data!', 'tunjangan');
        }
     }
     
     function create() //untuk menambah data cd
     {
        // setting konfigurasi form validation
        $this->form_validation->set_error_delimiters('<div id="error">', '</div>');
        $this->form_validation->set_rules('tunjangan','tunjangan', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('jumlah','jumlah', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('status_id','status_id', 'trim|required|xss_clean');
        // jika tidak lolos validasi
        if ($this->form_validation->run() == FALSE){
            $this->index();

      // jika lolos validasi
        } else {
            $data = array(
                'nama_tunjangan' => $this->input->post('tunjangan'),
                'jumlah' => $this->input->post('jumlah'),
                'status_id' => $this->input->post('status_id'),
                );
            $create = $this->tunjangan->newTunjangan($data);
            // tampilkan information message
            if ($create) set_flash('message', 'alert-success', 'Tunjangan berhasil ditambah', 'tunjangan');
            else set_flash('message', 'alert-error', 'Failed to create data!', 'tunjangan');
        }
     }
     
     function update() //untuk meng-update data cd
     {
        // setting konfigurasi form validation
        $this->form_validation->set_error_delimiters('<div id="error">', '</div>');
        $this->form_validation->set_rules('tunjangan','tunjangan', 'trim|required|xss_clean');
        $this->form_validation->set_rules('jumlah','jumlah', 'trim|required|xss_clean');
        $this->form_validation->set_rules('status_id','status_id', 'trim|required|xss_clean');
        // jika tidak lolos validasi
        if ($this->form_validation->run() == FALSE){
            $this->edit();

        // jika lolos validasi
        } else {
            $id = $this->input->post('id');
            $data = array(
                'nama_tunjangan' => $this->input->post('tunjangan'),
                'jumlah' => $this->input->post('jumlah'),
                'status_id' => $this->input->post('status_id'),
                );
            $update = $this->tunjangan->updateTunjangan($id,$data);
            // tampilkan information message
            if ($update) set_flash('message', 'alert-success', 'Tunjangan berhasil diupdate', 'tunjangan');
            else set_flash('message', 'alert-error', 'Failed to update data!', 'tunjangan');
        }
     }

}

/* End of file tunjangan.php */
/* Location: ./application/controllers/tunjangan.php */