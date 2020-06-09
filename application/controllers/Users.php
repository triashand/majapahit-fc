<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('user_model', 'user');
        unauthorized_user();
    }

	public function index()
	{
        $data['title'] = 'Users';
		$this->templates->load('templates', 'users', $data);
    }

    public function fetch_all()
    {
        $users = $this->user->get($id = NULL);
        $arr = array('success' => FALSE, 'data' => '');
        if($users) {
            $arr = array('success' => TRUE, 'data' => $users);
        }
        echo json_encode($arr);
    }
    
    public function store()
    {   
        $this->form_validation->set_rules('nama', 'Nama User', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[users.username]|min_length[5]|max_length[20]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]');

        if ($this->form_validation->run() === FALSE)
        {
            $errors = [
                'nama'      => form_error('nama'),
                'email'     => form_error('email'),
                'username'  => form_error('username'),
                'password'  => form_error('password'),
                'passconf'  => form_error('passconf'),
            ];

            echo json_encode(array(
                'success'   => false,
                'errors'    => $errors,
                'data'      => '',
                'msg'       => 'Data tidak terinput, Periksa kembali!'
            ));
        } else {
            $data = [
                'name'    => $this->input->post('nama'),
                'email'     => $this->input->post('email'),
                'username'  => $this->input->post('username'),
                'password'  => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
            ];

            $id = $this->input->post('id');

            if($id) {
                $updated = $this->user->update($data, $id);
                echo json_encode(array(
                    'success'   => TRUE,
                    'errors'    => '',
                    'data'      => $updated,
                    'msg'       => 'Data Berhasil Diperbarui'
                ));
            } else {
                $store = $this->user->store($data);
                echo json_encode(array(
                    'success'   => TRUE,
                    'errors'    => '',
                    'data'      => $store,
                    'msg'       => 'Data Berhasil Ditambahkan'
                ));
            }
        }
    }

    public function update()
    {
        $id = $this->input->post('id');
        $result = $this->user->get($id);
        $arr = array('success' => false, 'data' => '');
        if($result) {
            $arr = array('success' => true, 'data' => $result);
        }
        echo json_encode($arr);
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $destroy = $this->user->delete($id);
        $response = array('success' => false, 'msg' => 'Gagal hapus');
        if($destroy) {
            $response = array('success' => true, 'data' => $destroy, 'msg' => 'Data berhasil dihapus');
        }
        echo json_encode($response);
    }

    public function check()
    {
        $this->templates->load('templates', 'sample');
    }
}
