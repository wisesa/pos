<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {
    
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Kategorim', 'kategori');
	}

	public function index()
	{
        $data['kategori'] = $this->kategori->getList();

		$this->load->view('template-front/header');
		$this->load->view('kategori/list', $data);
		$this->load->view('template-front/footer');
	}

	public function add()
	{
		$this->load->view('template-front/header');
		$this->load->view('kategori/add');
		$this->load->view('template-front/footer');
	}

	public function add_process()
	{
		$values = $this->input->post(NULL, TRUE);
        // echo "<pre>";
        // print_r($values);
        // echo "</pre>";
        // die;

		$there_is_empty_input = false;
		$empty_input = '';
		if(!isset($values['nama'])){
			$there_is_empty_input=true;
			$empty_input='nama';
		}

		if($there_is_empty_input==true){
			$this->session->set_flashdata('type', 'error');
			$this->session->set_flashdata('title', 'Tambah Kategori');
			$this->session->set_flashdata('message', ucwords($empty_input).' tidak boleh kosong');
			redirect(base_url() . 'kategori', 'refresh');
		}

		$input = array(
			'id' => NULL,
			'nama' =>  $values['nama']
		);

		$insert =  $this->kategori->add($input);
		if ($insert) {
			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('title', 'Tambah Kategori');
			$this->session->set_flashdata('message', 'Kategori berhasil ditambah');
		} else {
			$this->session->set_flashdata('type', 'error');
			$this->session->set_flashdata('title', 'Tambah Kategori');
			$this->session->set_flashdata('message', 'Terjadi masalah, mohon coba kembali');
		}
		redirect(base_url() . 'kategori', 'refresh');
	}

    public function edit($id)
	{
        $data['id'] = $id;
        $data['kategori'] = $this->kategori->getListById($id)[0];

		$this->load->view('template-front/header', $data);
		$this->load->view('kategori/edit', $data);
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
		}

		if($there_is_empty_input==true){
			$this->session->set_flashdata('type', 'error');
			$this->session->set_flashdata('title', 'Ubah Kategori');
			$this->session->set_flashdata('message', ucwords($empty_input).' tidak boleh kosong');
			redirect(base_url() . 'kategori/edit'.$id, 'refresh');
		}

		$input = array(
			'nama' =>  $values['nama']
		);

		try {
			$this->kategori->edit($input, $id);

			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('title', 'Ubah Kategori');
			$this->session->set_flashdata('message', 'Kategori berhasil diubah');
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('title', 'Ubah Kategori');
			$this->session->set_flashdata('message', 'Terjadi masalah, mohon coba kembali');
		}
		redirect(base_url() . 'kategori', 'refresh');
	}
}
