<?php

class Checker {
	protected $ci;

	public function __construct() {
		$this->ci =& get_instance();
	}

	public function user_login() {
		$this->ci->load->model('user_model', 'user');
		$userid = $this->ci->session->userdata('user_id');
		$user_data = $this->ci->user->get($userid)->row();
		return $user_data;
	}
}