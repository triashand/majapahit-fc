<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

class Transactions extends RestController {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(['jwt','authorization','verify']);
        $this->load->model([
            'transaction_model' => 'transaction',
            'customer_model'     => 'customer'
        ]);
        verify_request();
    }

    public function index_get()
    {
        $data = [
            'products'   => $this->transaction->get_products(),
            'customers'  => $this->customer->get($id = null),
            'invoice'    => $this->transaction->invoice_no()
        ];

        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response([
                'status'    => false,
                'message'   => 'Data Not Found'
            ], 404);
        }
    }

    public function order_get()
    {
        $status = parent::HTTP_OK;
        $response = [
            'status'    => $status,
            'order'     => $this->transaction->get($id =null)
        ];

        $this->response($response, 200);
    }

    public function store_post()
    {
        $invoice = $this->transaction->invoice_no();
        $data = [
            'invoice'   => $invoice,
            'cust_id'   => $this->post('cust_id'),
            'prod_id'   => $this->post('prod_id')
        ];

        // var_dump($data); exit();
        // if($data) {
        //     $store = $this->transaction->store($data);
        //     $this->customer->update_points($data);
        //     $this->response([
        //         'status'    => true,
        //         'message'   => 'Data Transaksi Berhasil Diinput!'
        //     ], 200);
        // } else {
        //     $this->response([
        //         'status'    => false,
        //         'message'   => 'Data Gagal Diinput!'
        //     ], 404);
        // }
    }
}
