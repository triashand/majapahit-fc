<?php

function verify_request()
{
    $ci =& get_instance();
    $headers = $ci->input->request_headers();
    $token = $headers['Authorization'];

    try {
        $data = AUTHORIZATION::validateToken($token);
        if($data === false) {
            $response = [
                'status'    => 401,
                'message'   => 'Unauthorized Access!'
            ];
            $ci->response($response, 401);

            exit();
        } else {
            return $data;
        }
    } catch (Exception $e) {
        $response = [
            'status'    => 401,
            'message'   => 'Unauthorized Access!'
        ];
        $ci->response($response, 401);
    }
}