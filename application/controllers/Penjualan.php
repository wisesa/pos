<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {
    
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Penjualanm', 'penjualan');
		$this->load->model('Produkm', 'produk');
		$this->load->model('Kategorim', 'kategori');
		$this->load->model('Userm', 'user');
	}

	public function index()
	{
		if(isset($_SESSION['user_type'])){
			if( (($_SESSION['user_type'])<>'pelanggan') ){
				redirect(base_url() . 'auth', 'refresh');
			}
		}else{
			redirect(base_url() . 'auth', 'refresh');
		}

		$id_pelanggan=$_SESSION['id'];
		$id_produk='';
		if(isset($_GET['id_produk']))
			$id_produk=$_GET['id_produk'];

		if(isset($_SESSION['user_type'])){
			if($_SESSION['user_type']=='administrator'){
				$data['penjualan'] = $this->penjualan->getList('',$id_produk);
			}else{
				$data['penjualan'] = $this->penjualan->getList($id_pelanggan,'');
			}
		}

		$this->load->view('template-front/header');
		$this->load->view('penjualan/list', $data);
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

		$data['penjualan'] = $this->penjualan->getListPerProduk();

		$this->load->view('template-front/header');
		$this->load->view('penjualan/list-per-produk', $data);
		$this->load->view('template-front/footer');
	}

	public function add()
	{
		if(isset($_SESSION['user_type'])){
			if( (($_SESSION['user_type'])<>'pelanggan') ){
				redirect(base_url() . 'auth', 'refresh');
			}
		}else{
			redirect(base_url() . 'auth', 'refresh');
		}
		
		$data['produk'] = $this->produk->getList('1');
		$data['supplier'] = $this->user->getList('supplier');

		$this->load->view('template-front/header');
		$this->load->view('penjualan/add', $data);
		$this->load->view('template-front/footer');
	}

	public function add_process()
	{
		$values = $this->input->post(NULL, TRUE);
		$id = $this->_generate_unique_id();
        // echo "<pre>";
        // print_r($values);
        // echo "</pre>";
		// echo $_SESSION['id'];
        // die;

		$there_is_empty_input = false;
		$empty_input = '';
		if(!isset($values['id_produk'])){
			$there_is_empty_input=true;
			$empty_input='Produk';
		}

		if($there_is_empty_input==true){
			$this->session->set_flashdata('type', 'error');
			$this->session->set_flashdata('title', 'Beli Produk');
			$this->session->set_flashdata('message', ucwords($empty_input).' tidak boleh kosong');
			redirect(base_url() . 'penjualan/add', 'refresh');
		}

		$input_master = array(
			'id' => $id,
			'id_pelanggan' =>  $_SESSION['id'],
			'created_on' => date("Y-m-d H:i:s"),
		);

		$input_detail = array(
			'id_penjualan' => $id,
			'id_produk' =>  $values['id_produk'],
			'harga' => $values['harga'],
			'jumlah' => 1
		);

		$insert =  $this->penjualan->commit($input_master, $input_detail);

		if ($insert) {
			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('title', 'Beli Produk');
			$this->session->set_flashdata('message', 'Penjualan berhasil ditambah');
		} else {
			$this->session->set_flashdata('type', 'error');
			$this->session->set_flashdata('title', 'Beli Produk');
			$this->session->set_flashdata('message', 'Terjadi kesalahan, mohon coba lagi');
		}
		redirect(base_url() . 'penjualan', 'refresh');
	}

    private function _generate_unique_id()
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $id = strtoupper(substr(str_shuffle(sha1(rand() . time()) . $chars), 0, 12));

        $codeExist = $this->penjualan->checkExist($id);

        if ($codeExist) {
            $this->_generate_unique_id();
        }

        return $id;
    }
}
