<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EventModel extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all()
    {
        return $this->db->get('event')->result_array();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('event', ['id' => $id])->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert('event', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('event', $data);
    }

    public function delete($id)
    {
        return $this->db->delete('event', ['id' => $id]);
    }
    
}