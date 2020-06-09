<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('checker');
		$this->load->model('user_model');
	}

	public function index()
	{
		authorized_user();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if($this->form_validation->run() === FALSE) {
			$this->load->view('login');
		} else {
			$this->_login();
		}
	}

	private function _login()
	{
		$data = [
			'username'	=> $this->input->post('username'),
			'password'	=> $this->input->post('password')
		];

		$user = $this->user_model->get_by_username($data);
		if($user) {
			$passverify = password_verify($data['password'], $user->password);
			if($passverify === TRUE) {
				$params = array(
					'user_id' => $user->u_id,
					'username' => $user->username
				);
				$this->session->set_userdata($params);
				redirect('dashboard');
			} else {
				$this->session->set_flashdata('errors', 'Password Salah, Coba lagi Ndan!');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('errors', 'Username Salah, Coba lagi Ndan!');
			redirect('auth');
		}
	}

	public function logout()
	{
		$params = array(
			'user_id',
			'username'
		);
		$this->session->unset_userdata($params);
		redirect('auth');
	}
}
