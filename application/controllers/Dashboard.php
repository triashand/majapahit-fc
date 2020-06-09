<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		unauthorized_user();
		$this->load->model(array(
			'gift_model',
			'transaction_model',
			'customer_model',
			'user_model'
		));
	}

	public function index()
	{
		$data = [
			'transactions'  => $this->transaction_model->get($id = null),
			'gifts'			=> $this->gift_model->get($id = null),
			'customers'		=> $this->customer_model->get($id = null),
			'users'			=> $this->user_model->get($id = null)
		];
		$this->templates->load('templates', 'dashboard', $data);
	}
}
