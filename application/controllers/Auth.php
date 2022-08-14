<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Userm', 'user');
	}

	public function index()
	{
		$this->load->view('template-front/header');
		$this->load->view('auth/form-login');
		$this->load->view('template-front/footer');
	}

	public function process_login()
	{
		$values = $this->input->post(NULL, TRUE);
		$email = $values['email'];
		$password = $values['password'];

		$user = $this->user->authenticate($email, $password);
		if($user!=false){
			//print_r($user);
			$user = $user[0];
			$_SESSION['user_type'] = $user->type;
			$_SESSION['id'] = $user->id;
			$_SESSION['nama'] = $user->nama;
			$_SESSION['email'] = $user->email;

			if($user->type=='pelanggan')
				redirect(base_url().'penjualan/add','refresh');
			else
				redirect(base_url().'produkc','refresh');
		}else{
			$this->session->set_flashdata('type', 'error');
			$this->session->set_flashdata('title', 'Akses Masuk');
			$this->session->set_flashdata('message', 'Username atau password salah, mohon coba lagi');
			redirect(base_url().'auth','refresh');
		}
	}

	public function logout(){
		session_destroy();
		redirect(base_url().'auth','refresh');
	}
}
