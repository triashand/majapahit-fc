<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    public function get($id = NULL)
    {
        if ($id != NULL) {
            $query = $this->db->get_where('users', array('u_id' => $id))->row();
        } else {
            $query = $this->db->get('users')->result();
        }
        return $query;
    }

    public function get_by_username($data)
    {
        $query = $this->db->get_where('users', array('username' => $data['username']))->row();
        return $query;
    }

    public function store($data)
    {
        $this->db->insert('users', $data);
        return $this->db->affected_rows();
    }

    public function update($data, $id)
    {
        $this->db->update('users', $data, array('c_id' => $id));
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        $this->db->delete('users', array('c_id' => $id));
        return $this->db->affected_rows();
    }
}
