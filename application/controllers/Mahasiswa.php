<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('MahasiswaModel');
        $this->load->library('session');
    }

    public function registerPage(){
        $this->load->view('user/register');
    }

    public function register(){
        $data = [
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password')
        ];

        if($this->MahasiswaModel->getByEmail($data['email'])){
            $this->session->set_flashdata('error', 'email is already registered');
            redirect('user/registerPage');
        } else {
            $inserted = $this->MahasiswaModel->insert($data);
        }

        if ($inserted) {
            $this->session->set_flashdata('success', 'Register success');

        } else {
            $this->session->set_flashdata('error', 'Register failed');
        }
        
        redirect('user/loginPage');
    }

    public function loginPage(){

        $this->load->view('mahasiswa/login');
    }

    public function login(){
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->MahasiswaModel->getByEmail($email);
        
        if ($user) {
            if ($password == $user['password']) {
                $this->session->set_userdata('user', $user);
                $this->session->set_flashdata('success', 'Login success');
                redirect('event/masukIndex');
            } else {
                $this->session->set_flashdata('error', 'Password is wrong');
                redirect('user/loginPage');
            }
        } else {
            $this->session->set_flashdata('error', 'Email is not registered');
            redirect('user/loginPage');
        }   
    }

    public function logout(){
        $this->session->unset_userdata('user');
        $this->session->set_flashdata('success', 'Logout success');
        redirect('welcome');
    }
}