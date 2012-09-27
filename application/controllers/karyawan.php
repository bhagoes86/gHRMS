<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Karyawan extends CI_Controller {

	function __construct() {
		parent::__construct();
        $this->load->model('karyawan_model', 'karyawan');
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
    	$view = 'karyawan/index';
        //tentukan jumlah perpage boz
        $perpage = 15;
         //load dulu dong library paginationnya
        $this->load->library('pagination');

        $pencarian = $this->input->get('pencarian');
        $karyawan = $this->karyawan->listKaryawan(array('perpage' => $perpage, 'offset' => $offset), $pencarian);
        
        if (!$pencarian) {
            $total_rows = $this->karyawan->jumlahKaryawan();
        } else {
            $total_rows = $karyawan['count'];
        }

        //untuk konfigurasi pagination pake ini
        $config = array(
            'base_url' => base_url() . 'index.php/karyawan/index/',
            'total_rows' => $total_rows,
            'per_page' => $perpage,
        );

        //inisialisasi pagination & config di atas
        $this->pagination->initialize($config);

       // var_dump($karyawan);
       // exit;
        
        $data = array(
            'karyawan' => $karyawan['result'],
            'jumlah' => $karyawan['count']
            );
        gview($view, $data);
    }

    public function print_karyawan()
    {
        $karyawan = $this->karyawan->listKaryawan();
        $data = array(
            'karyawan' => $karyawan['result']
            );
        $this->load->view('karyawan/print_karyawan', $data);
    }

    public function edit()
    {
        // initialize view
        $view = 'karyawan/edit';
        $this->load->helper('form');
        $id = $this->input->post('id');
        if (!empty($id)) 
            $kode = $id;
        else 
            $kode = $this->security->xss_clean($this->uri->segment(3));
        $result = $this->karyawan->getKaryawan($kode);  
        // print_r($result);exit;
        if ($result == null) 
            redirect('karyawan');
        else 
            $data['data_karyawan'] = $result;     
        gview($view, $data);
     }

     public function tambah() {
        // initialize view
        $view = 'karyawan/edit';
        $data['karyawan'] = '';
        gview($view, $data);
     }
     
     function delete() //untuk menghapus data cd
     {   
        $id = $this->security->xss_clean($this->uri->segment(3));
        $result = $this->karyawan->getKaryawan($id);
        if ($result == null) {
            redirect('karyawan');
        } else { 
            $delete = $this->karyawan->delete_data($id);
            if ($delete) set_flash('message', 'alert-success', 'Karyawan berhasil didelete', 'karyawan');
            else set_flash('message', 'alert-error', 'Failed to delete data!', 'karyawan');
        }
     }
     
     function create() //untuk menambah data cd
     {
        // setting konfigurasi form validation
        $this->form_validation->set_error_delimiters('<div id="error">', '</div>');
        $this->form_validation->set_rules('nik','NIK', 'trim|required|xss_clean');
        $this->form_validation->set_rules('nama_depan','Nama Depan', 'trim|required|xss_clean');

        // jika tidak lolos validasi
        if ($this->form_validation->run() == FALSE){
            $this->index();

      // jika lolos validasi
        } else {
            $data = array(
                'nik' => $this->input->post('nik'),
                'nama_depan' => $this->input->post('nama_depan'),
                'nama_belakang' => $this->input->post('nama_belakang'),
                'npwp' => $this->input->post('npwp'),
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'sex' => $this->input->post('sex'),
                'no_telp' => $this->input->post('no_telp'),
                'email' => $this->input->post('email'),
                'alamat' => $this->input->post('alamat'),
                'departemen_id' => $this->input->post('departemen_id'),
                'jabatan_id' => $this->input->post('jabatan_id'),
                'pendidikan_id' => $this->input->post('pendidikan_id'),
                'agama_id' => $this->input->post('agama_id'),
                'status_id' => $this->input->post('status_id'),
                'gol_darah' => $this->input->post('gol_darah'),
                'no_rekening' => $this->input->post('no_rekening'),
                'status_nikah' => $this->input->post('status_nikah'),
                'gapok' => $this->input->post('gapok'),
                'join_date' => $this->input->post('join_date'),
                );
            $create = $this->karyawan->newKaryawan($data);
            // tampilkan information message
            if ($create) set_flash('message', 'alert-success', 'Karyawan berhasil ditambah', 'karyawan');
            else set_flash('message', 'alert-error', 'Failed to create data!', 'karyawan');
        }
     }
     
     function update() //untuk meng-update data cd
     {
        // setting konfigurasi form validation
        $this->form_validation->set_error_delimiters('<div id="error">', '</div>');
        $this->form_validation->set_rules('nama_depan','Nama Depan', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('gapok','Gaji Pokok', 'trim|required|xss_clean');
        // jika tidak lolos validasi
        if ($this->form_validation->run() == FALSE){
            $this->edit();

        // jika lolos validasi
        } else {
            $id = $this->input->post('id');
            $data = array(
                'nik' => $this->input->post('nik'),
                'nama_depan' => $this->input->post('nama_depan'),
                'nama_belakang' => $this->input->post('nama_belakang'),
                'npwp' => $this->input->post('npwp'),
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'sex' => $this->input->post('sex'),
                'no_telp' => $this->input->post('no_telp'),
                'email' => $this->input->post('email'),
                'alamat' => $this->input->post('alamat'),
                'departemen_id' => $this->input->post('departemen_id'),
                'jabatan_id' => $this->input->post('jabatan_id'),
                'pendidikan_id' => $this->input->post('pendidikan_id'),
                'agama_id' => $this->input->post('agama_id'),
                'status_id' => $this->input->post('status_id'),
                'gol_darah' => $this->input->post('gol_darah'),
                'no_rekening' => $this->input->post('no_rekening'),
                'status_nikah' => $this->input->post('status_nikah'),
                'gapok' => $this->input->post('gapok'),
                'join_date' => $this->input->post('join_date'),
                );
            $update = $this->karyawan->updateKaryawan($id,$data);
            // tampilkan information message
            if ($update) set_flash('message', 'alert-success', 'Karyawan berhasil diupdate', 'karyawan');
            else set_flash('message', 'alert-error', 'Failed to update data!', 'karyawan');
        }
     }

}

/* End of file karyawan.php */
/* Location: ./application/controllers/karyawan.php */					