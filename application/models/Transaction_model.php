<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction_model extends CI_Model {
    public function get()
    {
        $query = $this->db->select("transactions.t_id, transactions.invoice, customers.c_name, products.p_name")
                            ->from("transactions")
                            ->join("customers", "transactions.cust_id=customers.c_id")
                            ->join("products", "transactions.prod_id=products.p_id")
                            ->get()->result();
        return $query;
    }

    public function store($data)
    {
        $this->db->insert('transactions', $data);
        return $this->db->affected_rows();
    }

    public function update($data, $id)
    {
        $this->db->update('transactions', $data, array('t_id' => $id));
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        $this->db->delete('transactions', array('t_id' => $id));
        return $this->db->affected_rows();
    }

    public function invoice_no()
    {
        $sql = "SELECT MAX(MID(invoice,10,4)) AS invoice_number
        FROM transactions
        WHERE MID(invoice,4,6) = DATE_FORMAT(CURDATE(), '%y%m%d')";
        $query = $this->db->query($sql);

        if($query->num_rows() > 0) {
            $row = $query->row();
            $n = ((int)$row->invoice_number + 1);
            $no = sprintf("%'.04d", $n);
        } else {
            $no = '0001';
        }
        date_default_timezone_set('Asia/Jakarta');
        $invoice = "MC-".date('ymd').$no;

        return $invoice;
    }

    public function get_products()
    {
        $query = $this->db->get('products')->result();
        return $query;
    }
}
