<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembelian extends CI_Controller {
    
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Pembelianm', 'pembelian');
		$this->load->model('Produkm', 'produk');
		$this->load->model('Kategorim', 'kategori');
		$this->load->model('Userm', 'user');
	}

	public function index($id_produk='')
	{
		if(isset($_SESSION['user_type'])){
			if( (($_SESSION['user_type'])<>'administrator') && (($_SESSION['user_type'])<>'petugas') ){
				redirect(base_url() . 'auth', 'refresh');
			}
		}else{
			redirect(base_url() . 'auth', 'refresh');
		}

		$data['pembelian'] = $this->pembelian->getList($id_produk);

		$this->load->view('template-front/header');
		$this->load->view('pembelian/list', $data);
		$this->load->view('template-front/footer');
	}

	public function list_per_produk()
	{
		if(isset($_SESSION['user_type'])){
			if( (($_SESSION['user_type'])<>'administrator') ){
				redirect(base_url() . 'auth', 'refresh');
			}
		}else{
			redirect(base_url() . 'auth', 'refresh');
		}

		$data['pembelian'] = $this->pembelian->getListPerProduk();

		$this->load->view('template-front/header');
		$this->load->view('pembelian/list-per-produk', $data);
		$this->load->view('template-front/footer');
	}

	public function add()
	{
		$data['produk'] = $this->produk->getList('1');
		$data['supplier'] = $this->user->getList('supplier');

		$this->load->view('template-front/header');
		$this->load->view('pembelian/add', $data);
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
		if(!isset($values['id_supplier'])){
			$there_is_empty_input=true;
			$empty_input='Supplier';
		}elseif(!isset($values['id_produk'])){
			$there_is_empty_input=true;
			$empty_input='Produk';
		}

		if($there_is_empty_input==true){
			$this->session->set_flashdata('type', 'error');
			$this->session->set_flashdata('title', 'Tambah Produk');
			$this->session->set_flashdata('message', ucwords($empty_input).' tidak boleh kosong');
			redirect(base_url() . 'pembelian/add', 'refresh');
		}

		$input_master = array(
			'id' => $id,
			'id_supplier' =>  $values['id_supplier'],
			'created_on' => date("Y-m-d H:i:s"),
			'batal' => 0
		);

		$input_detail = array(
			'id_pembelian' => $id,
			'id_produk' =>  $values['id_produk'],
			'harga' => $values['harga'],
			'jumlah' => 1
		);

		$insert =  $this->pembelian->commit($input_master, $input_detail);

		if ($insert) {
			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('title', 'Tambah Pembelian');
			$this->session->set_flashdata('message', 'Pembelian berhasil ditambah');
		} else {
			$this->session->set_flashdata('type', 'error');
			$this->session->set_flashdata('title', 'Tambah Pembelian');
			$this->session->set_flashdata('message', 'Terjadi kesalahan, mohon coba lagi');
		}
		redirect(base_url() . 'pembelian', 'refresh');
	}

    public function cancel($id)
	{
		if(isset($_SESSION['user_type'])){
			if( (($_SESSION['user_type'])<>'administrator') && (($_SESSION['user_type'])<>'petugas') ){
				redirect(base_url() . 'auth', 'refresh');
			}
		}else{
			redirect(base_url() . 'auth', 'refresh');
		}
		
		$input = array(
			'batal' => 1
		);

		try {
			$this->pembelian->edit($input, $id);

			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('title', 'Batalkan Pembelian');
			$this->session->set_flashdata('message', 'Pembelian berhasil dibatalkan');
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('title', 'Batalkan Pembelian');
			$this->session->set_flashdata('message', 'Terjadi masalah, mohon coba kembali');
		}
		redirect(base_url() . 'pembelian', 'refresh');
	}

    private function _generate_unique_id()
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $id = strtoupper(substr(str_shuffle(sha1(rand() . time()) . $chars), 0, 12));

        $codeExist = $this->pembelian->checkExist($id);

        if ($codeExist) {
            $this->_generate_unique_id();
        }

        return $id;
    }
}
