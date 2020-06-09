<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model {
    public function get($id = NULL)
    {
        if ($id != NULL) {
            $query = $this->db->get_where('customers', array('c_id' => $id))->row();
        } else {
            $query = $this->db->get('customers')->result();
        }
        return $query;
    }

    public function store($data)
    {
        $this->db->insert('customers', $data);
        return $this->db->affected_rows();
    }

    public function update($data, $id)
    {
        $this->db->update('customers', $data, array('c_id' => $id));
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        $this->db->delete('customers', array('c_id' => $id));
        return $this->db->affected_rows();
    }

    public function check_points($username)
    {
        $this->db->select('points')
                 ->from('customers')
                 ->where('username', $username);
        return $this->db->get()->row();
    }

    public function update_points($data)
    {
        $id  = $data['cust_id'];
        $customer = $this->db->get_where('customers', array('c_id' => $id))->row();
        $this->db->set('points', $customer->points + 5);
        $this->db->where('c_id', $id);
        $this->db->update('customers');
    }
}
