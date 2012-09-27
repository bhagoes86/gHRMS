<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jenis_cuti extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->check_isvalidated();
	    $this->load->model('jenis_cuti_model', 'jenis_cuti');
	}

	public function check_isvalidated()
    {
        if (!$this->session->userdata('validated')) {
            redirect('login');
        }
    }

	public function index($offset = 0)
	{
		$view = 'jenis_cuti/index';
		//tentukan jumlah perpage boz
        $perpage = 5;
         //load dulu dong library paginationnya
        $this->load->library('pagination');

        $pencarian = $this->input->get('pencarian');
        $jenis_cuti = $this->jenis_cuti->listJenis_cuti(array('perpage' => $perpage, 'offset' => $offset), $pencarian);
        
        if (!$pencarian) {
        	$total_rows = $this->jenis_cuti->jumlahJenis_cuti();
        } else {
        	$total_rows = $jenis_cuti['count'];
        }
		
        //untuk konfigurasi pagination pake ini
        $config = array(
            'base_url' => base_url() . 'index.php/jenis_cuti/index/',
            'total_rows' => $total_rows,
            'per_page' => $perpage,
        );

        //inisialisasi pagination & config di atas
        $this->pagination->initialize($config);

		$data = array(
			'jenis_cuti' => $jenis_cuti['result'],
			'jumlah' => $jenis_cuti['count']
			);
		gview($view, $data);
	}

	public function edit()
	{
		// initialize view
		$view = 'jenis_cuti/edit';
		$this->load->helper('form');
	 	$id = $this->input->post('id');
	 	if (!empty($id)) 
	 		$kode = $id;
	 	else 
	 		$kode = $this->security->xss_clean($this->uri->segment(3));
	 	$result = $this->jenis_cuti->getJenis_cuti($kode);	
	 	// print_r($result);exit;
	 	if ($result == null) 
	 		redirect('jenis_cuti');
	 	else 
	 		$data['data_jenis_cuti'] = $result;  	
	 	gview($view, $data);
	 }

	 public function tambah() {
	 	// initialize view
		$view = 'jenis_cuti/edit';
		$data['jenis_cuti'] = '';
		gview($view, $data);
	 }
	 
	 public function delete() //untuk menghapus data cd
	 {   
	 	$id = $this->security->xss_clean($this->uri->segment(3));
	 	$result = $this->jenis_cuti->getJenis_cuti($id);
	 	if ($result == null) {
	 		redirect('jenis_cuti');
	 	} else { 
	 		$delete = $this->jenis_cuti->delete_data($id);
	 		if ($delete) set_flash('message', 'alert-success', 'Jenis cuti berhasil dihapus', 'jenis_cuti');
	 		else set_flash('message', 'alert-error', 'Failed to delete data!', 'jenis_cuti');
	 	}
	 }
	 
	 public function create() //untuk menambah data cd
	 {
	  	// setting konfigurasi form validation
	 	$this->form_validation->set_error_delimiters('<div id="error">', '</div>');
	 	$this->form_validation->set_rules('nama_cuti', 'nama_cuti', 'trim|required|xss_clean');

	  	// jika tidak lolos validasi
	 	if ($this->form_validation->run() == FALSE){
	 		$this->index();

	  // jika lolos validasi
	 	} else {
	 		$data = array(
	 			'nama_cuti' => $this->input->post('nama_cuti'), 
	 			'jumlah_hari' => $this->input->post('jumlah_hari')  
	 			);
	 		$create = $this->jenis_cuti->newJenis_cuti($data);
	   		// tampilkan information message
	 		if ($create) set_flash('message', 'alert-success', 'Jenis cuti berhasil ditambah', 'jenis_cuti');
	 		else set_flash('message', 'alert-error', 'Failed to create data!', 'jenis_cuti');
	 	}
	 }
	 
	 public function update() //untuk meng-update data cd
	 {
	  	// setting konfigurasi form validation
	 	$this->form_validation->set_error_delimiters('<div id="error">', '</div>');
	 	$this->form_validation->set_rules('nama_cuti', 'nama_cuti', 'trim|required|xss_clean');
	 

	  	// jika tidak lolos validasi
	 	if ($this->form_validation->run() == FALSE){
	 		$this->edit();

	  	// jika lolos validasi
	 	} else {
	 		$id = $this->input->post('id');
	 		$data = array(
	 			'nama_cuti' => $this->input->post('nama_cuti'),
	 			'jumlah_hari' => $this->input->post('jumlah_hari')  
	 			);
	 		$update = $this->jenis_cuti->updateJenis_cuti($id,$data);
	   		// tampilkan information message
	 		if ($update) set_flash('message', 'alert-success', 'Jenis cuti berhasil diupdate', 'jenis_cuti');
	 		else set_flash('message', 'alert-error', 'Failed to update data!', 'jenis_cuti');
	 	}
	 }

}

/* End of file jenis_cuti.php */
/* Location: ./application/controllers/jenis_cuti.php */