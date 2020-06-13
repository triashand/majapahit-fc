<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

class Auth extends RestController {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(['jwt', 'authorization', 'verify']);
		$this->load->model('user_model', 'user');
    }
    
    public function login_post()
    {
        $user_input = [
            'username'  => $this->post('username'),
            'password'  => $this->post('password')
        ];

        $user = $this->user->get_by_username($user_input);

        if ($user) {
            $pass_verify = password_verify($user_input['password'], $user->password);
            if($pass_verify === true) {
                $token = AUTHORIZATION::generateToken(['username' => $user_input['username']]);
                $status = 200;

                $response = [
                    'status'    => $status,
                    'token'     => $token
                ];

                $this->response($response, $status);
            } else {
                $this->response([
                    'message'   => 'Invalid password!'
                ], parent::HTTP_NOT_FOUND);
            }
        } else {
            $this->response([
                'message'   => 'Invalid username or password!'
            ], parent::HTTP_NOT_FOUND);
        }
    }

    public function get_me_data_post()
    {
        $data = verify_request();
        $status = parent::HTTP_OK;
        $response = [
            'status'    => $status,
            'data'      => $data
        ];
        $this->response($response, $status);
    }
}
