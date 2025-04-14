<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('EventModel');
        $this->load->library('session');
    }

    public function index()
    {
        $event = $this->EventModel->get_all();
        $this->load->view('index', ['events' => $event]);
    }

    public function create()
    {
        $this->load->view('event/create');
    }

    public function store()
    {
        $data = [
            'nama_event' => $this->input->post('nama_event'), 
            'tanggal' => $this->input->post('tanggal'),

        ];

        $inserted = $this->EventModel->insert($data);

        if ($inserted) {
            $this->session->set_flashdata('success', 'Event berhasil ditambahkan');
        } else {
            $this->session->set_flashdata('error', 'Event gagal ditambahkan');
        }

        redirect('event');
    }

    public function edit($id)
    {
        $data['event'] = $this->EventModel->get_by_id($id);
        $this->load->view('event/edit', $data);
    }

    public function update()
    {
        $id = $this->input->post('id');
        $data = [
            'nama' => $this->input->post('nama'),
        ];

        $updated = $this->EventModel->update($id, $data);

        if ($updated) {
            $this->session->set_flashdata('success', 'Event berhasil diubah');
        } else {
            $this->session->set_flashdata('error', 'Event gagal diubah');
        }

        redirect('event');
    }
    function masukIndex()
    {
        $event = $this->EventModel->get_all();
        $this->load->view('index', ['events' => $event]);
    }
    public function delete($id)
    {
        $deleted = $this->EventModel->delete($id);

        if ($deleted) {
            $this->session->set_flashdata('success', 'Event berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Event gagal dihapus');
        }

        redirect('event');
    }
    public function laporan()
    {
        $data['events'] = $this->EventModel->get_all();
        $this->load->view('laporan', $data);
    }

}