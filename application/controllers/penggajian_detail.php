<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class penggajian_detail extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	    $this->load->model('penggajian_detail_model', 'penggajian_detail');
	}

	public function index($offset = 0)
	{
		$view = 'penggajian_detail/index';
		//tentukan jumlah perpage boz
        $perpage = 5;
         //load dulu dong library paginationnya
        $this->load->library('pagination');

        //untuk konfigurasi pagination pake ini
        $config = array(
            'base_url' => base_url() . 'index.php/penggajian_detail/index/',
            'total_rows' => $this->penggajian_detail->jumlahPenggajian_detail(),
            'per_page' => $perpage,
        );

        //inisialisasi pagination & config di atas
        $this->pagination->initialize($config);

		$penggajian_detail = $this->penggajian_detail->listPenggajian_detail(array('perpage' => $perpage, 'offset' => $offset));
		$data = array(
			'penggajian_detail' => $penggajian_detail,
			'jumlah' => $this->penggajian_detail->jumlahPenggajian_detail()
			);
		gview($view, $data);
	}

	public function edit()
	{
		// initialize view
		$view = 'penggajian_detail/edit';
		$this->load->helper('form');
	 	$id = $this->input->post('id');
	 	if (!empty($id)) 
	 		$kode = $id;
	 	else 
	 		$kode = $this->security->xss_clean($this->uri->segment(3));
	 	$result = $this->penggajian_detail->getPenggajian_detail($kode);	
	 	// print_r($result);exit;
	 	if ($result == null) 
	 		redirect('penggajian_detail');
	 	else 
	 		$data['data_penggajian_detail'] = $result;  	
	 	gview($view, $data);
	 }

	 public function tambah() {
	 	// initialize view
		$view = 'penggajian_detail/edit';
		$data['penggajian_detail'] = '';
		gview($view, $data);
	 }
	 
	 function delete() //untuk menghapus data cd
	 {   
	 	$id = $this->security->xss_clean($this->uri->segment(3));
	 	$result = $this->penggajian_detail->getPenggajian_detail($id);
	 	if ($result == null) {
	 		redirect('penggajian_id','total_gaji');
	 	} else { 
	 		$delete = $this->penggajian_detail->delete_data($id);
	 		if ($delete) set_flash('message', 'alert-success', 'Detail payrolls deleted', 'penggajian_detail');
	 		else set_flash('message', 'alert-error', 'Failed to delete data!', 'penggajian_detail');
	 	}
	 }
	 
	 function create() //untuk menambah data cd
	 {
	  	// setting konfigurasi form validation
	 	$this->form_validation->set_error_delimiters('<div id="error">', '</div>');
	 	$this->form_validation->set_rules('penggajian_id','Penggajian_id', 'trim|required|xss_clean');
	 	$this->form_validation->set_rules('total_gaji','Total_gaji', 'trim|required|xss_clean');

	  	// jika tidak lolos validasi
	 	if ($this->form_validation->run() == FALSE){
	 		$this->index();

	  // jika lolos validasi
	 	} else {
	 		$data = array(
	 			'penggajian_id' => $this->input->post('penggajian_id'),
	 			'total_gaji' => $this->input->post('total_gaji'),
	 			);
	 		$create = $this->penggajian_detail->newPenggajian-detail($data);
	   		// tampilkan information message
	 		if ($create) set_flash('message', 'alert-success', 'Details payrolls created', 'penggajian_detail');
	 		else set_flash('message', 'alert-error', 'Failed to create data!', 'penggajian_detail');
	 	}
	 }
	 
	 function update() //untuk meng-update data cd
	 {
	  	// setting konfigurasi form validation
	 	$this->form_validation->set_error_delimiters('<div id="error">', '</div>');
	 	$this->form_validation->set_rules('penggajian_id','Penggajian_id', 'trim|required|xss_clean');
	 	$this->form_validation->set_rules('total_gaji','Total_gaji', 'trim|required|xss_clean');
	  	// jika tidak lolos validasi
	 	if ($this->form_validation->run() == FALSE){
	 		$this->edit();

	  	// jika lolos validasi
	 	} else {
	 		$id = $this->input->post('id');
	 		$data = array(
	 			'penggajian_id' => $this->input->post('penggajian_id'),
	 			'total_gaji' => $this->input->post('total_gaji'),
	 			);
	 		$update = $this->penggajian_detail->updatePenggajian($id,$data);
	   		// tampilkan information message
	 		if ($update) set_flash('message', 'alert-success', 'Detail payrolls updated', 'penggajian_detail');
	 		else set_flash('message', 'alert-error', 'Failed to update data!', 'penggajian_detail');
	 	}
	 }

}

/* End of file penggajian_detail.php */
/* Location: ./application/controllers/penggajian_detail.php */