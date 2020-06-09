<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gift_model extends CI_Model {
    public function get($id = NULL)
    {
        if ($id != NULL) {
            $query = $this->db->get_where('gifts', array('g_id' => $id))->row();
        } else {
            $query = $this->db->get('gifts')->result();
        }
        return $query;
    }

    public function store($data)
    {
        $this->db->insert('gifts', $data);
        return $this->db->affected_rows();
    }

    public function update($data, $id)
    {
        $this->db->update('gifts', $data, array('g_id' => $id));
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        $this->db->delete('gifts', array('g_id' => $id));
        return $this->db->affected_rows();
    }

    public function count()
    {
        
    }
}
