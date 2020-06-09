<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('transaction_model', 'transaction');
        $this->load->model('customer_model', 'customer');
        unauthorized_user();
    }

	public function index()
	{
        $data = [
            'title' => 'Transaction',
            'invoice'   => $this->transaction->invoice_no(),
            'customers' => $this->customer->get($id = NULL),
            'products'  => $this->transaction->get_products()
        ];
		$this->templates->load('templates', 'transactions', $data);
    }

    public function fetch_all()
    {
        $transactions = $this->transaction->get();
        $arr = array('success' => FALSE, 'data' => '');
        if($transactions) {
            $arr = array('success' => TRUE, 'data' => $transactions);
        }
        echo json_encode($arr);
    }

    public function store()
    {   
        $this->form_validation->set_rules('invoice', 'invoice', 'required');
        $this->form_validation->set_rules('cust_id', 'Customer', 'required|numeric');
        $this->form_validation->set_rules('prod_id', 'Product', 'required|numeric');

        if ($this->form_validation->run() === FALSE)
        {
            $errors = [
                'invoice'      => form_error('invoice'),
                'cust_id'     => form_error('cust_id'),
                'prod_id'  => form_error('prod_id'),
            ];

            echo json_encode(array(
                'success'   => false,
                'errors'    => $errors,
                'data'      => '',
                'msg'       => 'Data tidak terinput, Periksa kembali!'
            ));
        } else {
            $data = [
                'invoice'   => $this->input->post('invoice'),
                'cust_id'   => $this->input->post('cust_id'),
                'prod_id'   => $this->input->post('prod_id'),
            ];

            $id = $this->input->post('id');

            if($id) {
                $updated = $this->transaction->update($data, $id);
                echo json_encode(array(
                    'success'   => TRUE,
                    'errors'    => '',
                    'data'      => $updated,
                    'msg'       => 'Data Berhasil Diperbarui'
                ));
            } else {
                $store = $this->transaction->store($data);
                $this->customer->update_points($data);
                echo json_encode(array(
                    'success'   => TRUE,
                    'errors'    => '',
                    'data'      => $store,
                    'msg'       => 'Data Berhasil Ditambahkan'
                ));
            }
        }
    }

    public function delete()
    {
        $id = $this->input->post('id');
        // $destroy = $this->transaction->delete($id);
        $response = array('success' => false, 'msg' => 'Gagal hapus');
        if($destroy) {
            $response = array('success' => true, 'data' => $destroy, 'msg' => 'Data berhasil dihapus');
        }
        echo json_encode($response);
    }
}
