<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
    }
    public function index()
    {

        if (isset($this->session->userdata['user'])) {
            redirect('welcome');
        }

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['email'] = [
                'id' => 'email',
                'name' => 'email',
                'type' => 'email',
                'class' => 'form-control',
                'placeholder' => 'your@mail.com'
            ];

            $data['password'] = [
                'id' => 'password',
                'name' => 'password',
                'type' => 'password',
                'class' => 'form-control',
            ];

            $this->load->view('auth/login', $data);
        } else {
            // validasinya success
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email', true);
        $password = $this->input->post('password', true);

        $user = $this->db->get_where('v_user_role', ['email' => $email])->row_array();

        // jika usernya ada
        if ($user) {
            // jika usernya aktif
            if ($user['is_active'] == 1) {
                // cek password
                if (password_verify($password, $user['password'])) {
                    $data['user'] = [
                        'id' => $user['id'],
                        'full_name' => $user['full_name'],
                        'email' => $user['email'],
                        'role_name' => $user['role_name'],
                        'role_description' => $user['role_description'],
                    ];
                    $this->session->set_userdata($data);
                    redirect('welcome');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This email has not been activated!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered!</div>');
            redirect('auth');
        }
    }

    function logout()
    {
        $this->session->unset_userdata('user');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Logout berhasil</div>');
        redirect('auth');
    }
}
