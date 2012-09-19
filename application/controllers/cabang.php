<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cabang extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('cabang_model', 'cabang');
	}


	public function index($offset = 0)
	{
		$view = 'cabang/index';
		//tentukan jumlah perpage boz
        $perpage = 15;
         //load dulu dong library paginationnya
        $this->load->library('pagination');

        $pencarian = $this->input->get('pencarian');
        $cabang = $this->cabang->listCabang(array('perpage' => $perpage, 'offset' => $offset), $pencarian);
        
        if (!$pencarian) {
        	$total_rows = $this->cabang->jumlahCabang();
        } else {
        	$total_rows = $cabang['count'];
        }
		
        //untuk konfigurasi pagination pake ini
        $config = array(
            'base_url' => base_url() . 'index.php/cabang/index/',
            'total_rows' => $total_rows,
            'per_page' => $perpage,
        );

        //inisialisasi pagination & config di atas
        $this->pagination->initialize($config);

		$data = array(
			'cabang' => $cabang['result'],
			'jumlah' => $cabang['count']
			);
		gview($view, $data);
	}

	public function edit()
	{
		// initialize view
		$view = 'cabang/edit';
		$this->load->helper('form');
	 	$id = $this->input->post('id');
	 	if (!empty($id)) 
	 		$kode = $id;
	 	else 
	 		$kode = $this->security->xss_clean($this->uri->segment(3));
	 	$result = $this->cabang->getCabang($kode);	
	 	// print_r($result);exit;
	 	if ($result == null) 
	 		redirect('cabang');
	 	else 
	 		$data['data_cabang'] = $result;  	
	 	gview($view, $data);
	 }

	 public function tambah() {
	 	// initialize view
		$view = 'cabang/edit';
		$data['cabang'] = '';
		gview($view, $data);
	 }
	 
	 public function delete() //untuk menghapus data cd
	 {   
	 	$id = $this->security->xss_clean($this->uri->segment(3));
	 	$result = $this->cabang->getCabang($id);
	 	if ($result == null) {
	 		redirect('cabang');
	 	} else { 
	 		$delete = $this->cabang->delete_data($id);
	 		if ($delete) set_flash('message', 'alert-success', 'Cabang berhasil dihapus', 'cabang');
	 		else set_flash('message', 'alert-error', 'Failed to delete data!', 'cabang');
	 	}
	 }
	 
	 public function create() //untuk menambah data cd
	 {
	  	// setting konfigurasi form validation
	 	$this->form_validation->set_error_delimiters('<div id="error">', '</div>');
	 	$this->form_validation->set_rules('cabang', 'Cabang', 'trim|required|xss_clean');

	  	// jika tidak lolos validasi
	 	if ($this->form_validation->run() == FALSE){
	 		$this->index();

	  // jika lolos validasi
	 	} else {
	 		$data = array(
	 			'nama_cabang' => $this->input->post('cabang')  
	 			);
	 		$create = $this->cabang->newCabang($data);
	   		// tampilkan information message
	 		if ($create) set_flash('message', 'alert-success', 'Cabang berhasil ditambah', 'cabang');
	 		else set_flash('message', 'alert-error', 'Failed to create data!', 'cabang');
	 	}
	 }
	 
	 public function update() //untuk meng-update data cd
	 {
	  	// setting konfigurasi form validation
	 	$this->form_validation->set_error_delimiters('<div id="error">', '</div>');
	 	$this->form_validation->set_rules('cabang', 'Cabang', 'trim|required|xss_clean');

	  	// jika tidak lolos validasi
	 	if ($this->form_validation->run() == FALSE){
	 		$this->edit();

	  	// jika lolos validasi
	 	} else {
	 		$id = $this->input->post('id');
	 		$data = array(
	 			'nama_cabang' => $this->input->post('cabang')
	 			);
	 		$update = $this->cabang->updateCabang($id,$data);
	   		// tampilkan information message
	 		if ($update) set_flash('message', 'alert-success', 'Cabang berhasil diupdate', 'cabang');
	 		else set_flash('message', 'alert-error', 'Failed to update data!', 'cabang');
	 	}
	 }

}

/* End of file cabang.php */
/* Location: ./application/controllers/cabang.php */