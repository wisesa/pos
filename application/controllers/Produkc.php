<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produkc extends CI_Controller {
    
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Produkm', 'produk');
		$this->load->model('Kategorim', 'kategori');
	}

	public function index()
	{
		if(!isset($_SESSION['user_type'])){
			$data['produk'] = $this->produk->getList('1');
		}else{
			$data['produk'] = $this->produk->getList();
		}

		$this->load->view('template-front/header');
		$this->load->view('produk/list', $data);
		$this->load->view('template-front/footer');
	}

	public function add()
	{
		if(isset($_SESSION['user_type'])){
			if( (($_SESSION['user_type'])<>'administrator') && (($_SESSION['user_type'])<>'petugas') ){
				redirect(base_url() . 'auth', 'refresh');
			}
		}else{
			redirect(base_url() . 'auth', 'refresh');
		}

		$data['kategori'] = $this->kategori->getList();

		$this->load->view('template-front/header');
		$this->load->view('produk/add', $data);
		$this->load->view('template-front/footer');
	}

	public function add_process()
	{
		$values = $this->input->post(NULL, TRUE);
		$id = $this->_generate_unique_id();
        // echo "<pre>";
        // print_r($values);
        // echo "</pre>";
        // die;

		$there_is_empty_input = false;
		$empty_input = '';
		if(!isset($values['nama'])){
			$there_is_empty_input=true;
			$empty_input='nama';
		}elseif(!isset($values['harga_beli'])){
			$there_is_empty_input=true;
			$empty_input='harga_beli';
		}elseif(!isset($values['harga_jual'])){
			$there_is_empty_input=true;
			$empty_input='harga_jual';
		}elseif(!isset($values['deskripsi'])){
			$there_is_empty_input=true;
			$empty_input='deskripsi';
		}elseif(!isset($values['id_kategori'])){
			$there_is_empty_input=true;
			$empty_input='kategori';
		}elseif(!isset($values['gambar'])){
			$there_is_empty_input=true;
			$empty_input='gambar';
		}

		if($there_is_empty_input==true){
			$this->session->set_flashdata('type', 'error');
			$this->session->set_flashdata('title', 'Tambah Produk');
			$this->session->set_flashdata('message', ucwords($empty_input).' tidak boleh kosong');
			redirect(base_url() . 'kategori', 'refresh');
		}

		$input = array(
			'id' => $id,
			'nama' =>  $values['nama'],
			'harga_beli' => $values['harga_beli'],
			'harga_jual' => $values['harga_jual'],
			'deskripsi' => $values['deskripsi'],
			'id_kategori' => $values['id_kategori'],
			'gambar' => $values['gambar'],
			'aktif' => 1
		);

		$insert =  $this->produk->add($input);

		if ($insert) {
			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('title', 'Tambah Produk');
			$this->session->set_flashdata('message', 'Produk berhasil ditambah');
		} else {
			$this->session->set_flashdata('type', 'error');
			$this->session->set_flashdata('title', 'Add School');
			$this->session->set_flashdata('message', 'Terjadi kesalahan, mohon coba lagi');
			redirect(base_url() . 'produkc/add', 'refresh');
		}
		redirect(base_url() . 'produkc', 'refresh');
	}

	public function edit($id)
	{
		if(isset($_SESSION['user_type'])){
			if( (($_SESSION['user_type'])<>'administrator') && (($_SESSION['user_type'])<>'petugas') ){
				redirect(base_url() . 'auth', 'refresh');
			}
		}else{
			redirect(base_url() . 'auth', 'refresh');
		}

        $data['id'] = $id;
		$data['kategori'] = $this->kategori->getList();
        $data['produk'] = $this->produk->getListById($id)[0];
        // echo "<pre>";
        // print_r($data['produk']);
        // echo "</pre>";
        // die;

		$this->load->view('template-front/header', $data);
		$this->load->view('produk/edit', $data);
		$this->load->view('template-front/footer', $data);
	}

    public function edit_process()
	{
		$values = $this->input->post(NULL, TRUE);
		$id = $values['id'];
        // echo "<pre>";
        // print_r($values);
        // echo "</pre>";
        // die;

		$there_is_empty_input = false;
		$empty_input = '';
		if(!isset($values['nama'])){
			$there_is_empty_input=true;
			$empty_input='nama';
		}elseif(!isset($values['harga_beli'])){
			$there_is_empty_input=true;
			$empty_input='harga_beli';
		}elseif(!isset($values['harga_jual'])){
			$there_is_empty_input=true;
			$empty_input='harga_jual';
		}elseif(!isset($values['deskripsi'])){
			$there_is_empty_input=true;
			$empty_input='deskripsi';
		}elseif(!isset($values['id_kategori'])){
			$there_is_empty_input=true;
			$empty_input='kategori';
		}elseif(!isset($values['gambar'])){
			$there_is_empty_input=true;
			$empty_input='gambar';
		}

		if($there_is_empty_input==true){
			$this->session->set_flashdata('type', 'error');
			$this->session->set_flashdata('title', 'Ubah '.ucwords($values['type']));
			$this->session->set_flashdata('message', ucwords($empty_input).' tidak boleh kosong');
			redirect(base_url() . 'kategori', 'refresh');
		}

		$input = array(
			'id' => $id,
			'nama' =>  $values['nama'],
			'harga_beli' => $values['harga_beli'],
			'harga_jual' => $values['harga_jual'],
			'deskripsi' => $values['deskripsi'],
			'id_kategori' => $values['id_kategori'],
			'aktif' => 1
		);
        if($values['gambar']<>''){
            $input['gambar'] = $values['gambar'];
			unlink(FCPATH.'produk/'.$values['gambar_old']);
		}

		try {
			$this->produk->edit($input, $id);

			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('title', 'Ubah Produk');
			$this->session->set_flashdata('message', 'Produk berhasil diubah');
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('title', 'Ubah Produk');
			$this->session->set_flashdata('message', 'Terjadi masalah, mohon coba kembali');
			redirect(base_url() . 'produkc/edit', 'refresh');
		}
		redirect(base_url() . 'produkc', 'refresh');
	}

    public function activate($id)
	{
		if(isset($_SESSION['user_type'])){
			if( (($_SESSION['user_type'])<>'administrator') && (($_SESSION['user_type'])<>'petugas') ){
				redirect(base_url() . 'auth', 'refresh');
			}
		}else{
			redirect(base_url() . 'auth', 'refresh');
		}

		try {
			$input = array('aktif'=>1);
			$this->produk->edit($input, $id);

			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('title', 'Ubah Produk');
			$this->session->set_flashdata('message', 'Produk berhasil diubah');
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('title', 'Ubah Produk');
			$this->session->set_flashdata('message', 'Terjadi masalah, mohon coba kembali');
		}
		redirect(base_url() . 'produkc', 'refresh');
	}

    public function deactivate($id)
	{
		if(isset($_SESSION['user_type'])){
			if( (($_SESSION['user_type'])<>'administrator') && (($_SESSION['user_type'])<>'petugas') ){
				redirect(base_url() . 'auth', 'refresh');
			}
		}else{
			redirect(base_url() . 'auth', 'refresh');
		}
		
		try {
			$input = array('aktif'=>0);
			$this->produk->edit($input, $id);

			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('title', 'Ubah Produk');
			$this->session->set_flashdata('message', 'Produk berhasil diubah');
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('title', 'Ubah Produk');
			$this->session->set_flashdata('message', 'Terjadi masalah, mohon coba kembali');
		}
		redirect(base_url() . 'produkc', 'refresh');
	}
	
    public function upload_image() {
        $this->load->library('upload');
        $json = array();
        $path = FCPATH.'produk';
		$data = $this->upload->data();
		$filename = str_replace(" ", "_", $data['file_name']);
        $initialize = $this->upload->initialize(array(
            "upload_path" => $path,
			"file_name" => $filename,
            "allowed_types" => "gif|jpg|jpeg|png",
            "remove_spaces" => TRUE
        ));
        if (!$this->upload->do_upload('upl_file')) {
            $error = array('error' => $this->upload->display_errors());
            echo $this->upload->display_errors();
            $json = 'failed';
        } else {
            $imagename = $filename;
            $json = 'success'; 
        }
        header('Content-Type: application/json');
        echo json_encode($json);            
    }  

    private function _generate_unique_id()
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $id = strtoupper(substr(str_shuffle(sha1(rand() . time()) . $chars), 0, 12));

        $codeExist = $this->produk->checkExist($id);

        if ($codeExist) {
            $this->_generate_unique_id();
        }

        return $id;
    }
}
