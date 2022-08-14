<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Userm', 'user');
	}

	public function index($type)
	{
        $data['user'] = $this->user->getList($type);
        $data['type'] = $type;
        
		$this->load->view('template-front/header', $data);
		$this->load->view('user/list', $data);
		$this->load->view('template-front/footer', $data);
	}

	public function add($type)
	{
		if(isset($_SESSION['user_type'])){
			if( (($_SESSION['user_type'])<>'administrator') ){
				redirect(base_url() . 'auth', 'refresh');
			}
		}else{
			redirect(base_url() . 'auth', 'refresh');
		}

        $data['type'] = $type;

		$this->load->view('template-front/header', $data);
		$this->load->view('user/add', $data);
		$this->load->view('template-front/footer', $data);
	}

	public function add_process()
	{
		$values = $this->input->post(NULL, TRUE);
		$type = $values['type'];
        // echo "<pre>";
        // print_r($values);
        // echo "</pre>";
        // die;

		$there_is_empty_input = false;
		$empty_input = '';
		if(!isset($values['nama'])){
			$there_is_empty_input=true;
			$empty_input='nama';
		}elseif(!isset($values['email'])){
			$there_is_empty_input=true;
			$empty_input='email';
		}elseif(!isset($values['password']) && $type<>'supplier'){
			$there_is_empty_input=true;
			$empty_input='password';
		}

		if($there_is_empty_input==true){
			$this->session->set_flashdata('type', 'error');
			$this->session->set_flashdata('title', 'Tambah '.ucwords($values['type']));
			$this->session->set_flashdata('message', ucwords($empty_input).' tidak boleh kosong');
			redirect(base_url() . 'user/index/'.$type, 'refresh');
		}

		$input = array(
			'id' => NULL,
			'nama' =>  $values['nama'],
			'email' => $values['email'],
			'kontak' => $values['kontak'],
			'type' => $values['type'],
			'aktif' => 1
		);
		if(isset($values['password']))
			$input['password'] = md5($values['password']);

		$insert =  $this->user->add($input);

		if($insert<>'') {
			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('title', 'Tambah '.ucwords($type));
			$this->session->set_flashdata('message', ucwords($type).' berhasil ditambah');
		} else {
			$this->session->set_flashdata('type', 'error');
			$this->session->set_flashdata('title', 'Tambah '.ucwords($type));
			$this->session->set_flashdata('message', 'Terjadi masalah, mohon coba kembali');
		}
		redirect(base_url() . 'user/index/'.$type, 'refresh');
	}

	public function edit($id)
	{
		if(isset($_SESSION['user_type'])){
			if( (($_SESSION['user_type'])<>'administrator') ){
				redirect(base_url() . 'auth', 'refresh');
			}
		}else{
			redirect(base_url() . 'auth', 'refresh');
		}

        $data['id'] = $id;
        $data['user'] = $this->user->getListById($id)[0];

		$this->load->view('template-front/header', $data);
		$this->load->view('user/edit', $data);
		$this->load->view('template-front/footer', $data);
	}

    public function edit_process()
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
		}elseif(!isset($values['email'])){
			$there_is_empty_input=true;
			$empty_input='email';
		}elseif(!isset($values['password'])){
			$there_is_empty_input=true;
			$empty_input='password';
		}

		if($there_is_empty_input==true){
			$this->session->set_flashdata('type', 'error');
			$this->session->set_flashdata('title', 'Ubah '.ucwords($values['type']));
			$this->session->set_flashdata('message', ucwords($empty_input).' tidak boleh kosong');
			redirect(base_url() . 'kategori', 'refresh');
		}

		$id = $values['id'];
		$password = trim($values['password']);
		$type = $values['type'];

		$input = array(
			'nama' =>  $values['nama'],
			'email' => $values['email'],
			'kontak' => $values['kontak']
		);
        if($password<>'')
            $input['password'] = md5($password);

		try {
			$this->user->edit($input, $id);

			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('title', 'Ubah '.ucwords($type));
			$this->session->set_flashdata('message', ucwords($type).' berhasil diubah');
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('title', 'Ubah '.ucwords($type));
			$this->session->set_flashdata('message', 'Terjadi masalah, mohon coba kembali');
		}
		redirect(base_url() . 'user/index/'.$type, 'refresh');
	}

    public function activate($id)
	{
		if(isset($_SESSION['user_type'])){
			if( (($_SESSION['user_type'])<>'administrator') ){
				redirect(base_url() . 'auth', 'refresh');
			}
		}else{
			redirect(base_url() . 'auth', 'refresh');
		}

		try {
			$type = $this->user->getListById($id)[0]->type;
			$input = array('aktif'=>1);
			$this->user->edit($input, $id);

			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('title', 'Ubah '.ucwords($type));
			$this->session->set_flashdata('message', ucwords($type).' berhasil diaktifkan');
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('title', 'Ubah '.ucwords($type));
			$this->session->set_flashdata('message', 'Terjadi masalah, mohon coba kembali');
		}
		redirect(base_url() . 'user/index/'.$type, 'refresh');
	}

    public function deactivate($id)
	{
		if(isset($_SESSION['user_type'])){
			if( (($_SESSION['user_type'])<>'administrator') ){
				redirect(base_url() . 'auth', 'refresh');
			}
		}else{
			redirect(base_url() . 'auth', 'refresh');
		}
		
		try {
			$type = $this->user->getListById($id)[0]->type;
			$input = array('aktif'=>0);
			$this->user->edit($input, $id);

			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('title', 'Ubah '.ucwords($type));
			$this->session->set_flashdata('message', ucwords($type).' berhasil dinonaktifkan');
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('title', 'Ubah '.ucwords($type));
			$this->session->set_flashdata('message', 'Terjadi masalah, mohon coba kembali');
		}
		redirect(base_url() . 'user/index/'.$type, 'refresh');
	}

    private function _generate_unique_id()
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $reference = strtoupper(substr(str_shuffle(sha1(rand() . time()) . $chars), 0, 12));

        $codeExist = $this->parent_purchase->checkIdExists($reference);

        if ($codeExist) {
            $this->_generate_unique_id();
        }

        return $reference;
    }
}
