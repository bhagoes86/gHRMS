<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Karyawan_tunjangan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('karyawan_tunjangan_model', 'karyawan_tunjangan');
    }

    public function index($offset = 0)
    {
        $view = 'karyawan_tunjangan/index';
        //tentukan jumlah perpage boz
        $perpage = 5;
         //load dulu dong library paginationnya
        $this->load->library('pagination');

        $pencarian = $this->input->get('pencarian');
        $karyawan_tunjangan = $this->karyawan_tunjangan->listKaryawan_tunjangan(array('perpage' => $perpage, 'offset' => $offset), $pencarian);
        
        if (!$pencarian) {
            $total_rows = $this->karyawan_tunjangan->jumlahKaryawan_tunjangan();
        } else {
            $total_rows = $karyawan_tunjangan['count'];
        }

        //untuk konfigurasi pagination pake ini
        $config = array(
            'base_url' => base_url() . 'index.php/karyawan_tunjangan/index/',
            'total_rows' => $total_rows,
            'per_page' => $perpage,
        );

        //inisialisasi pagination & config di atas
        $this->pagination->initialize($config);

       // var_dump($karyawan_tunjangan);
       // exit;
        
        $data = array(
            'karyawan_tunjangan' => $karyawan_tunjangan ['result'],
            'jumlah' => $karyawan_tunjangan ['count']
            );
        gview($view, $data);
    }

    public function submit()
    {
        $result =  $this->input->post();
        $tgl_update =  $result['status_id'];
        foreach ($result['status_id'] as $va => $k) {

            $this->karyawan_tunjangan->update_Karyawan_tunjangan($status_id, $va, $k);
        }
        redirect('karyawan_tunjangan');
        // var_dump($this->input->post());

    }

    public function edit()
    {
        // initialize view
        $view = 'karyawan_tunjangan/edit';
        $this->load->helper('form');
        $id = $this->input->post('id');
        if (!empty($id)) 
            $kode = $id;
        else 
            $kode = $this->security->xss_clean($this->uri->segment(3));
        $result = $this->karyawan_tunjangan->getKaryawan_tunjangan($kode);  
        // print_r($result);exit;
        if ($result == null) 
            redirect('karyawan_tunjangan');
        else 
            $data['data_karyawan_tunjangan'] = $result;     
        gview($view, $data);
     }

     public function tambah() {
        // initialize view
        $view = 'karyawan_tunjangan/tambah';
        $data['karyawan_tunjangan'] = '';
        gview($view, $data);
     }
     
     function delete() //untuk menghapus data cd
     {   
        $id = $this->security->xss_clean($this->uri->segment(3));
        $result = $this->karyawan_tunjangan->getKaryawan_tunjangan($id);
        if ($result == null) {
            redirect('karyawan_tunjangan');
        } else { 
            $delete = $this->karyawan_tunjangan->delete_data($id);
            if ($delete) set_flash('message', 'alert-success', 'Presensi deleted', 'karyawan_tunjangan');
            else set_flash('message', 'alert-error', 'Failed to delete data!', 'karyawan_tunjangan');
        }
     }
     
     function create() //untuk menambah data cd
     {
        // setting konfigurasi form validation
        $this->form_validation->set_error_delimiters('<div id="error">', '</div>');
        $this->form_validation->set_rules('karyawan_tunjangan','karyawan_tunjangan', 'trim|required|xss_clean');

        // jika tidak lolos validasi
        if ($this->form_validation->run() == FALSE){
            $this->index();

      // jika lolos validasi
        } else {
            $data = array(
                'status_id' => $this->input->post('status_id'),
                'nama_depan'=> $this->input->post('nama_depan'),
                'nama_belakang'=> $this->input->post('nama_belakang')

                );
            $create = $this->karyawan_tunjangan->newKaryawan_tunjangan($data);
            // tampilkan information message
            if ($create) set_flash('message', 'alert-success', 'Presensi created', 'karyawan_tunjangan');
            else set_flash('message', 'alert-error', 'Failed to create data!', 'karyawan_tunjangan');
        }
     }
     
     function update() //untuk meng-update data cd
     {
        // setting konfigurasi form validation
        $this->form_validation->set_error_delimiters('<div id="error">', '</div>');
        $this->form_validation->set_rules('karyawan_tunjangan','karyawan_tunjangan', 'trim|required|xss_clean');
        // jika tidak lolos validasi
        if ($this->form_validation->run() == FALSE){
            $this->edit();

        // jika lolos validasi
        } else {
            $id = $this->input->post('id');
            $data = array(
                'status_id' => $this->input->post('status_id'),
                'nama_depan'=> $this->input->post('nama_depan'),
                'nama_belakang'=> $this->input->post('nama_belakang'),

                );
            $update = $this->karyawan_tunjangan->update_Karyawan_tunjangan($id,$data);
            // tampilkan information message
            if ($update) set_flash('message', 'alert-success', ' Presensi updated', 'karyawan_tunjangan');
            else set_flash('message', 'alert-error', 'Failed to update data!', 'karyawan_tunjangan');
        }
     }

}

/* End of file karyawan_tunjangan.php */
/* Location: ./application/controllers/karyawan_tunjangan.php */