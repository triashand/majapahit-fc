<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('customer_model', 'customer');
    }

    public function check()
    {
        $username = $this->input->post('username');
        if($username) {
            $points = $this->customer->check_points($username);
            if($points) {
                $gifts = $this->db->get('gifts')->result();
                $data = [
                    'total point'   => $points,
                    'hadiah'        => $gifts
                ];

                header('Content-Type: application/json');
                echo json_encode(
                    array(
                        'success'   => TRUE,
                        'message'   => 'Menampilkan point dan daftar hadiah',
                        'data'      => $data
                    )
                );
            }
        } else {
            header('Content-Type: application/json');
            echo json_encode(
                array(
                    'success'   => FALSE,
                    'message'   => 'Masukkan username'
                )
            );
        }
    }
}
