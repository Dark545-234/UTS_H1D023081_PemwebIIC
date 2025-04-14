<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('PendaftaranModel');
        $this->load->model('EventModel');
        $this->load->model('MahasiswaModel');
       
    }

    public function index()
    {
        $pendaftaran = $this->PendaftaranModel->joinPendaftaran();
        $this->load->view('pendaftaran/index', ['pendaftarans' => $pendaftaran]);
    }

    public function create()
    {
        $event = $this->EventModel->getAll();
        $mahasiswa = $this->MahasiswaModel->getAll();
        $this->load->view('pendaftaran/create', ['events' => $event, 'mahasiswa' => $mahasiswa, ]);
    }

    public function store()
    {
        $data = [
            'event_id' => $this->input->post('id'),
            'mahasiswa_id' => $this->input->post('mahasiswa_id'),
        ];
        $inserted = $this->PendaftaranModel->insert($data);
        if($inserted) {
            $this->session->set_flashdata('success', 'Pendaftaran berhasil ditambahkan');
        } else {
            $this->session->set_flashdata('error', 'Pendaftaran gagal ditambahkan');
        }
        redirect('pendaftaran');
    }

    public function edit($id)
    {
        $pendaftaran = $this->PendaftaranModel->getById($id);
        $event = $this->EventModel->getAll();
        $mahasiswa = $this->MahasiswaModel->getAll();
        $this->load->view('pendaftaran/edit', ['pendaftaran' => $pendaftaran, 'events' => $event, 'mahasiswas' => $mahasiswa]);
    }

    public function update()
    {
        $id = $this->input->post('id');
        $data = [
            'event_id' => $this->input->post('id_event'),
            'mahasiswa_id' => $this->input->post('mahasiswa_id'),
            'id_user' => $this->input->post('id_user')
        ];
        redirect('pendaftaran');
    }

    public function delete($id)
    {
        $deleted = $this->PendaftaranModel->delete($id);
        if($deleted) {
            $this->session->set_flashdata('success', 'Pendaftaran berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Pendaftaran gagal dihapus');
        }
        redirect('pendaftaran');
    }
}