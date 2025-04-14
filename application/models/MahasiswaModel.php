<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MahasiswaModel extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function getByEmail($email){
        return $this->db->get_where('mahasiswa', ['email' => $email])->row_array();
    }


    public function insert($data){
        return $this->db->insert('mahasiswa', $data);
    }

    public function update($data, $id){
        return $this->db->update('mahasiswa', $data, ['id' => $id]);
    }

    public function delete($id){
        return $this->db->delete('mahasiswa', ['id' => $id]);
    }

    public function getAll(){
        return $this->db->get('mahasiswa')->result_array();
    }

    public function getById($id){
        return $this->db->get_where('mahasiswa', ['id' => $id])->row_array();
    }


}