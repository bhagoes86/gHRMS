<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cuti extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->check_isvalidated();
	    $this->load->model('cuti_model', 'cuti');
	}
	public function check_isvalidated()
    {
        if (!$this->session->userdata('validated')) {
            redirect('login');
        }
    }


	public function index($offset = 0)
	{
		$this->load->helper('oknot');
		$view = 'cuti/index';
		//tentukan jumlah perpage boz
        $perpage = 15;
         //load dulu dong library paginationnya
        $this->load->library('pagination');

        $pencarian = $this->input->get('pencarian');
        $cuti = $this->cuti->listCuti(array('perpage' => $perpage, 'offset' => $offset), $pencarian);
        
        if (!$pencarian) {
        	$total_rows = $this->cuti->jumlahCuti();
        } else {
        	$total_rows = $cuti['count'];
        }
		
        //untuk konfigurasi pagination pake ini
        $config = array(
            'base_url' => base_url() . 'index.php/cuti/index/',
            'total_rows' => $total_rows,
            'per_page' => $perpage,
        );

        //inisialisasi pagination & config di atas
        $this->pagination->initialize($config);

		$data = array(
			'cuti' => $cuti['result'],
			'jumlah' => $cuti['count']
			);
		gview($view, $data);
	}

	public function edit()
	{
		// initialize view
		$view = 'cuti/edit';
		$this->load->helper('form');
	 	$id = $this->input->post('id');
	 	if (!empty($id)) 
	 		$kode = $id;
	 	else 
	 		$kode = $this->security->xss_clean($this->uri->segment(3));
	 	$result = $this->cuti->getCuti($kode);	
	 	// print_r($result);exit;
	 	if ($result == null) 
	 		redirect('cuti');
	 	else 
	 		$data['data_cuti'] = $result;  	
	 	gview($view, $data);
	 }

	 public function tambah() {
	 	// initialize view
		$view = 'cuti/edit';
		$data['cuti'] = '';
		gview($view, $data);
	 }
	 
	 public function delete() //untuk menghapus data cd
	 {   
	 	$id = $this->security->xss_clean($this->uri->segment(3));
	 	$result = $this->cuti->getCuti($id);
	 	if ($result == null) {
	 		redirect('cuti');
	 	} else { 
	 		$delete = $this->cuti->delete_data($id);
	 		if ($delete) set_flash('message', 'alert-success', 'Permohonan Cuti berhasil dihapus', 'cuti');
	 		else set_flash('message', 'alert-error', 'Failed to delete data!', 'cuti');
	 	}
	 }
	 
	 public function create() //untuk menambah data cd
	 {
	  	// setting konfigurasi form validation
	 	$this->form_validation->set_error_delimiters('<div id="error">', '</div>');
	 	$this->form_validation->set_rules('nik', 'nik', 'trim|required|xss_clean');
	 	$this->form_validation->set_rules('tgl_mulai', 'Tanggal Mulai', 'trim|xss_clean');
	 	$this->form_validation->set_rules('tgl_akhir', 'Tanggal Akhir', 'trim|xss_clean');

	  	// jika tidak lolos validasi
	 	if ($this->form_validation->run() == FALSE){
	 		$this->index();

	  // jika lolos validasi
	 	} else {
	 		$status_pengajuan = $this->input->post('status_pengajuan');
	 		$data = array(
	 			'nik' => $this->input->post('nik'),
	 			'tgl_mulai' => $this->input->post('tanggal_mulai'),  
	 			'tgl_akhir' => $this->input->post('tanggal_akhir'),  
	 			'lama_cuti' => ((strtotime($this->input->post('tanggal_akhir')) - strtotime($this->input->post('tanggal_mulai'))) / (60 * 60 * 24)),
	 			'jenis_cuti_id' => $this->input->post('jenis_cuti_id'),
	 			'alasan' => $this->input->post('alasan'),
	 			'status_pengajuan' => (isset($status_pengajuan)) ? 1 : 0

	 			);
	 		$create = $this->cuti->newCuti($data);
	   		// tampilkan information message
	 		if ($create) set_flash('message', 'alert-success', 'Permohonan Cuti berhasil disimpan', 'cuti');
	 		else set_flash('message', 'alert-error', 'Failed to create data!', 'cuti');
	 	}
	 }
	 
	 public function update() //untuk meng-update data cd
	 {
	  	// setting konfigurasi form validation
	 	$this->form_validation->set_error_delimiters('<div id="error">', '</div>');
	 	$this->form_validation->set_rules('nik', 'nik', 'trim|required|xss_clean');
	 	$this->form_validation->set_rules('tgl_mulai', 'Tanggal Mulai', 'trim|xss_clean');
	 	$this->form_validation->set_rules('tgl_akhir', 'Tanggal Akhir', 'trim|xss_clean');


	  	// jika tidak lolos validasi
	 	if ($this->form_validation->run() == FALSE){
	 		$this->edit();

	  	// jika lolos validasi
	 	} else {
	 		$id = $this->input->post('kd_pcuti');
	 		$status_pengajuan = $this->input->post('status_pengajuan');
	 		// echo $status_pengajuan;	
	 		$data = array(
	 			'nik' => $this->input->post('nik'),
	 			'tgl_mulai' => $this->input->post('tanggal_mulai'),  
	 			'tgl_akhir' => $this->input->post('tanggal_akhir'),  
	 			'lama_cuti' => ((strtotime($this->input->post('tanggal_akhir')) - strtotime($this->input->post('tanggal_mulai'))) / (60 * 60 * 24)),
	 			'jenis_cuti_id' => $this->input->post('jenis_cuti_id'),
	 			'alasan' => $this->input->post('alasan'),
	 			'status_pengajuan' => ($status_pengajuan == 'on') ? 1 : 0	

	 			);
	 		// echo '<pre>';
	 		// echo var_dump($data);
	 		// echo '</pre>';
	 		// exit;
	 		$update = $this->cuti->updateCuti($id,$data);
	   		// tampilkan information message
	 		if ($update) set_flash('message', 'alert-success', 'Permohonan Cuti berhasil diupdate', 'cuti');
	 		else set_flash('message', 'alert-error', 'Failed to update data!', 'cuti');
	 	}
	 }

	 public function karyawan_info()
	 {
	 	$nik = $this->input->get('nik');

	 	$this->load->model('karyawan_model', 'karyawan');
	 	$result = $this->karyawan->getKaryawanByNik($nik);
	 	echo json_encode($result);
	 	exit;
	 }

}

/* End of file cuti.php */
/* Location: ./application/controllers/cuti.php */