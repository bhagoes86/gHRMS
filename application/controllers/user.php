<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	    $this->load->model('user_model', 'user');
	}

	public function index($offset = 0)
	{
		$view = 'user/index';
		//tentukan jumlah perpage boz
        $perpage = 5;
         //load dulu dong library paginationnya
        $this->load->library('pagination');

        //untuk konfigurasi pagination pake ini
        $config = array(
            'base_url' => base_url() . 'index.php/user/index/',
            'total_rows' => $this->user->jumlahUser(),
            'per_page' => $perpage,
        );

        //inisialisasi pagination & config di atas
        $this->pagination->initialize($config);

		$user = $this->user->listUser(array('perpage' => $perpage, 'offset' => $offset));
		$data = array(
			'user' => $user,
			'jumlah' => $this->user->jumlahUser()
			);
		gview($view, $data);
	}

	public function edit()
	{
		// initialize view
		$view = 'user/edit';
		$this->load->helper('form');
	 	$id = $this->input->post('id');
	 	if (!empty($id)) 
	 		$kode = $id;
	 	else 
	 		$kode = $this->security->xss_clean($this->uri->segment(3));
	 	$result = $this->user->getUser($kode);	
	 	// print_r($result);exit;
	 	if ($result == null) 
	 		redirect('username,password,roles_id');
	 	else 
	 		$data['data_user'] = $result;  	
	 	gview($view, $data);
	 }

	 public function tambah() {
	 	// initialize view
		$view = 'user/edit';
		$data['user'] = '';
		gview($view, $data);
	 }
	 
	 function delete() //untuk menghapus data cd
	 {   
	 	$id = $this->security->xss_clean($this->uri->segment(3));
	 	$result = $this->user->getUser($id);
	 	if ($result == null) {
	 		redirect('username,password,roles_id');
	 	} else { 
	 		$delete = $this->user->delete_data($id);
	 		if ($delete) set_flash('message', 'alert-success', 'Users deleted', 'user');
	 		else set_flash('message', 'alert-error', 'Failed to delete data!', 'user');
	 	}
	 }
	 
	 function create() //untuk menambah data cd
	 {
	  	// setting konfigurasi form validation
	 	$this->form_validation->set_error_delimiters('<div id="error">', '</div>');
	 	$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
	 	$this->form_validation->set_rules('password', 'password', 'trim|xss_clean');
	 	$this->form_validation->set_rules('roles_id', 'roles_id', 'trim|xss_clean');

	  	// jika tidak lolos validasi
	 	if ($this->form_validation->run() == FALSE){
	 		$this->index();

	  // jika lolos validasi
	 	} else {
	 		$data = array(
	 			'username' => $this->input->post('username'),
	 			'password' => $this->input->post('password'),
	 			'roles_id' => $this->input->post('roles_id'),  
	 			);
	 		$create = $this->user->newUser($data);
	   		// tampilkan information message
	 		if ($create) set_flash('message', 'alert-success', 'Users created', 'user');
	 		else set_flash('message', 'alert-error', 'Failed to create data!', 'user');
	 	}
	 }
	 
	 function update() //untuk meng-update data cd
	 {
	  	// setting konfigurasi form validation
	 	$this->form_validation->set_error_delimiters('<div id="error">', '</div>');
	 	$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
	 	$this->form_validation->set_rules('password', 'password', 'trim|xss_clean');
	 	$this->form_validation->set_rules('roles_id', 'roles_id', 'trim|xss_clean');

	  	// jika tidak lolos validasi
	 	if ($this->form_validation->run() == FALSE){
	 		$this->edit();

	  	// jika lolos validasi
	 	} else {
	 		$id = $this->input->post('id');
	 		$data = array(
	 			'username' => $this->input->post('username'),
	 			'password' => $this->input->post('password'),
	 			'roles_id' => $this->input->post('roles_id'),  
	 			);
	 		$update = $this->user->updateuser($id,$data);
	   		// tampilkan information message
	 		if ($update) set_flash('message', 'alert-success', 'Users updated', 'agama');
	 		else set_flash('message', 'alert-error', 'Failed to update data!', 'agama');
	 	}
	 }

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */