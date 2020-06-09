<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gifts extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('gift_model', 'gift');
        unauthorized_user();
    }

	public function index()
	{
        $data['title'] = 'Hadiah';
		$this->templates->load('templates', 'hadiah', $data);
    }

    public function fetch_all()
    {
        $gifts = $this->gift->get($id = NULL);
        $arr = array('success' => FALSE, 'data' => '');
        if($gifts) {
            $arr = array('success' => TRUE, 'data' => $gifts);
        }
        echo json_encode($arr);
    }
    
    public function store()
    {   
        $this->form_validation->set_rules('nama', 'Nama Hadiah', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
        $this->form_validation->set_rules('point', 'Point', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $errors = [
                'nama'      => form_error('nama'),
                'deskripsi' => form_error('deskripsi'),
                'point'     => form_error('point'),
            ];

            echo json_encode(array(
                'success'   => false,
                'errors'    => $errors,
                'data'      => '',
                'msg'       => 'Data tidak terinput, Periksa kembali!'
            ));
        } else {
            $data = [
                'g_name'            => $this->input->post('nama'),
                'deskripsi'         => $this->input->post('deskripsi'),
                'exchange_value'    =>$this->input->post('point')
            ];

            $id = $this->input->post('id');

            if($id) {
                $updated = $this->gift->update($data, $id);
                echo json_encode(array(
                    'success'   => TRUE,
                    'errors'    => '',
                    'data'      => $updated,
                    'msg'       => 'Data Berhasil Diperbarui'
                ));
            } else {
                $store = $this->gift->store($data);
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
        $result = $this->gift->get($id);
        $arr = array('success' => false, 'data' => '');
        if($result) {
            $arr = array('success' => true, 'data' => $result);
        }
        echo json_encode($arr);
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $destroy = $this->gift->delete($id);
        $response = array('success' => false, 'msg' => 'Gagal hapus');
        if($destroy) {
            $response = array('success' => true, 'data' => $destroy, 'msg' => 'Data berhasil dihapus');
        }
        echo json_encode($response);
    }
}
