<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PendaftaranModel extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function insert($data){
        return $this->db->insert('pendaftaran', $data);
    }

    public function update($data, $id){
        return $this->db->update('pendaftaran', $data, ['id' => $id]);
    }

    public function delete($id){
        return $this->db->delete('pendaftaran', ['id' => $id]);
    }

    public function getAll(){
        return $this->db->get('pendaftaran')->result_array();
    }

    public function getById($id){
        return $this->db->get_where('pendaftaran', ['id' => $id])->row_array();
    }


    public function getMahasiswafromevent($id){
        $this->db->select('mahasiswa.*');
        $this->db->from('pendaftaran');
        $this->db->join('mahasiswa', 'pendaftaran.mahasiswa_id = mahasiswa.id');
        $this->db->join('event', 'pendaftaran.event_id = event.id');
        return $this->db->get()->result_array();
    }
}