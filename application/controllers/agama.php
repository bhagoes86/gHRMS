<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agama extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('agama_model', 'agama');
	}


	public function index($offset = 0)
	{
		$view = 'agama/index';
		//tentukan jumlah perpage boz
        $perpage = 15;
         //load dulu dong library paginationnya
        $this->load->library('pagination');

        $pencarian = $this->input->get('pencarian');
        $agama = $this->agama->listAgama(array('perpage' => $perpage, 'offset' => $offset), $pencarian);
        
        if (!$pencarian) {
        	$total_rows = $this->agama->jumlahAgama();
        } else {
        	$total_rows = $agama['count'];
        }
		
        //untuk konfigurasi pagination pake ini
        $config = array(
            'base_url' => base_url() . 'index.php/agama/index/',
            'total_rows' => $total_rows,
            'per_page' => $perpage,
        );

        //inisialisasi pagination & config di atas
        $this->pagination->initialize($config);

		$data = array(
			'agama' => $agama['result'],
			'jumlah' => $agama['count']
			);
		gview($view, $data);
	}

	public function edit()
	{
		// initialize view
		$view = 'agama/edit';
		$this->load->helper('form');
	 	$id = $this->input->post('id');
	 	if (!empty($id)) 
	 		$kode = $id;
	 	else 
	 		$kode = $this->security->xss_clean($this->uri->segment(3));
	 	$result = $this->agama->getAgama($kode);	
	 	// print_r($result);exit;
	 	if ($result == null) 
	 		redirect('agama');
	 	else 
	 		$data['data_agama'] = $result;  	
	 	gview($view, $data);
	 }

	 public function tambah() {
	 	// initialize view
		$view = 'agama/edit';
		$data['agama'] = '';
		gview($view, $data);
	 }
	 
	 public function delete() //untuk menghapus data cd
	 {   
	 	$id = $this->security->xss_clean($this->uri->segment(3));
	 	$result = $this->agama->getAgama($id);
	 	if ($result == null) {
	 		redirect('agama');
	 	} else { 
	 		$delete = $this->agama->delete_data($id);
	 		if ($delete) set_flash('message', 'alert-success', 'Religions deleted', 'agama');
	 		else set_flash('message', 'alert-error', 'Failed to delete data!', 'agama');
	 	}
	 }
	 
	 public function create() //untuk menambah data cd
	 {
	  	// setting konfigurasi form validation
	 	$this->form_validation->set_error_delimiters('<div id="error">', '</div>');
	 	$this->form_validation->set_rules('agama', 'Agama', 'trim|required|xss_clean');
	 	$this->form_validation->set_rules('keterangan', 'Category', 'trim|xss_clean');

	  	// jika tidak lolos validasi
	 	if ($this->form_validation->run() == FALSE){
	 		$this->index();

	  // jika lolos validasi
	 	} else {
	 		$data = array(
	 			'agama' => $this->input->post('agama'),
	 			'keterangan' => $this->input->post('keterangan')  
	 			);
	 		$create = $this->agama->newAgama($data);
	   		// tampilkan information message
	 		if ($create) set_flash('message', 'alert-success', 'Religions created', 'agama');
	 		else set_flash('message', 'alert-error', 'Failed to create data!', 'agama');
	 	}
	 }
	 
	 public function update() //untuk meng-update data cd
	 {
	  	// setting konfigurasi form validation
	 	$this->form_validation->set_error_delimiters('<div id="error">', '</div>');
	 	$this->form_validation->set_rules('agama', 'Agama', 'trim|required|xss_clean');
	 	$this->form_validation->set_rules('keterangan', 'Category', 'trim|xss_clean');

	  	// jika tidak lolos validasi
	 	if ($this->form_validation->run() == FALSE){
	 		$this->edit();

	  	// jika lolos validasi
	 	} else {
	 		$id = $this->input->post('id');
	 		$data = array(
	 			'agama' => $this->input->post('agama'),
	 			'keterangan' => $this->input->post('keterangan')
	 			);
	 		$update = $this->agama->updateAgama($id,$data);
	   		// tampilkan information message
	 		if ($update) set_flash('message', 'alert-success', 'Religions updated', 'agama');
	 		else set_flash('message', 'alert-error', 'Failed to update data!', 'agama');
	 	}
	 }

}

/* End of file agama.php */
/* Location: ./application/controllers/agama.php */