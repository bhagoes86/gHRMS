<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Departemen extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	    $this->load->model('departemen_model', 'departemen');
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
		$view = 'departemen/index';
		//tentukan jumlah perpage boz
        $perpage = 15;
         //load dulu dong library paginationnya
        $this->load->library('pagination');

        $pencarian = $this->input->get('pencarian');
        $departemen = $this->departemen->listDepartemen(array('perpage' => $perpage, 'offset' => $offset), $pencarian);
        
        if (!$pencarian) {
        	$total_rows = $this->departemen->jumlahDepartemen();
        } else {
        	$total_rows = $departemen['count'];
        }

        //untuk konfigurasi pagination pake ini
        $config = array(
            'base_url' => base_url() . 'index.php/departemen/index/',
            'total_rows' => $total_rows,
            'per_page' => $perpage,
        );

        //inisialisasi pagination & config di atas
        $this->pagination->initialize($config);

       // var_dump($departemen);
       // exit;
		
		$data = array(
			'departemen' => $departemen['result'],
			'jumlah' => $departemen['count']
			);
		gview($view, $data);
	}

	public function edit()
	{
		// initialize view
		$view = 'departemen/edit';
		$this->load->helper('form');
	 	$id = $this->input->post('id');
	 	if (!empty($id)) 
	 		$kode = $id;
	 	else 
	 		$kode = $this->security->xss_clean($this->uri->segment(3));
	 	$result = $this->departemen->getDepartemen($kode);	
	 	// print_r($result);exit;
	 	if ($result == null) 
	 		redirect('departemen');
	 	else 
	 		$data['data_departemen'] = $result;  	
	 	gview($view, $data);
	 }

	 public function tambah() {
	 	// initialize view
		$view = 'departemen/edit';
		$data['departemen'] = '';
		gview($view, $data);
	 }
	 
	 function delete() //untuk menghapus data cd
	 {   
	 	$id = $this->security->xss_clean($this->uri->segment(3));
	 	$result = $this->departemen->getDepartemen($id);
	 	if ($result == null) {
	 		redirect('departemen');
	 	} else { 
	 		$delete = $this->departemen->delete_data($id);
	 		if ($delete) set_flash('message', 'alert-success', 'Departemen berhasil didelete', 'departemen');
	 		else set_flash('message', 'alert-error', 'Failed to delete data!', 'departemen');
	 	}
	 }
	 
	 function create() //untuk menambah data cd
	 {
	  	// setting konfigurasi form validation
	 	$this->form_validation->set_error_delimiters('<div id="error">', '</div>');
	 	$this->form_validation->set_rules('departemen','Departemen', 'trim|required|xss_clean');

	  	// jika tidak lolos validasi
	 	if ($this->form_validation->run() == FALSE){
	 		$this->index();

	  // jika lolos validasi
	 	} else {
	 		$data = array(
	 			'nama_departemen' => $this->input->post('departemen')
	 			);
	 		$create = $this->departemen->newDepartemen($data);
	   		// tampilkan information message
	 		if ($create) set_flash('message', 'alert-success', 'Departemen berhasil ditambah', 'departemen');
	 		else set_flash('message', 'alert-error', 'Failed to create data!', 'departemen');
	 	}
	 }
	 
	 function update() //untuk meng-update data cd
	 {
	  	// setting konfigurasi form validation
	 	$this->form_validation->set_error_delimiters('<div id="error">', '</div>');
	 	$this->form_validation->set_rules('departemen','departemen', 'trim|required|xss_clean');
	  	// jika tidak lolos validasi
	 	if ($this->form_validation->run() == FALSE){
	 		$this->edit();

	  	// jika lolos validasi
	 	} else {
	 		$id = $this->input->post('id');
	 		$data = array(
	 			'nama_departemen' => $this->input->post('departemen')
	 			);
	 		$update = $this->departemen->updateDepartemen($id,$data);
	   		// tampilkan information message
	 		if ($update) set_flash('message', 'alert-success', 'Departemen berhasil diupdate', 'departemen');
	 		else set_flash('message', 'alert-error', 'Failed to update data!', 'departemen');
	 	}
	 }

}

/* End of file departemen.php */
/* Location: ./application/controllers/departemen.php */