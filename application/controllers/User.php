<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property User_model $_user
 */
class User extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->PAGE_PRETITLE = "User";
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('User_model', '_user');
    }
    function index()
    {
        $this->data['users'] = $this->_user->get_all();
        $this->PAGE_TITLE = "Manajemen User";
        $this->view('user/index');
    }

    function add()
    {
        $this->form_validation->set_rules('password', 'Password', 'trim');
        $this->form_validation->set_rules('cpassword', 'Konfirmasi Password', 'trim|matches[password]');

        if ($this->form_validation->run() == true) {
            $this->_update();
        }

        $role = $this->_user->getRole();
        $this->data['select_role'][""] = "--- Pilih Role ---";
        foreach ($role as $r) {
            $this->data['select_role'][$r->id] = $r->description;
        }

        $this->data['form_fullname'] = [
            'input' => [
                'id' => 'fullname',
                'name' => 'fullname',
                'class' => 'form-control',
                'value' => set_value('fullname'),
                'required' => 'required'
            ],
            'label' => [
                'text' => 'Nama Lengkap',
                'attr' => ['class' => 'form-label required'],
            ],
        ];
        $this->data['form_email'] = [
            'input' => [
                'id' => 'email',
                'name' => 'email',
                'class' => 'form-control',
                'value' => set_value('email'),
                // 'type' => 'email',
                'required' => 'required'
            ],
            'label' => [
                'text' => 'Email / No HP',
                'attr' => ['class' => 'form-label required'],
            ],
        ];
        $this->data['form_password'] = [
            'input' => [
                'id' => 'password',
                'name' => 'password',
                'class' => 'form-control',
                'type' => 'password',
            ],
            'label' => [
                'text' => 'Password',
                'attr' => ['class' => 'form-label'],
            ],
        ];
        $this->data['form_cpassword'] = [
            'input' => [
                'id' => 'cpassword',
                'name' => 'cpassword',
                'class' => 'form-control',
                'type' => 'password',
            ],
            'label' => [
                'text' => 'Konfirmasi Password',
                'attr' => ['class' => 'form-label'],
            ],
        ];

        $this->PAGE_TITLE = "Tambah User";
        $this->view('user/form');
    }

    function edit($id = null)
    {
        if (!$id) {
            show_error("Error");
        }

        $this->form_validation->set_rules('password', 'Password', 'trim');
        $this->form_validation->set_rules('cpassword', 'Konfirmasi Password', 'trim|matches[password]');

        if ($this->form_validation->run() == true) {
            $this->_update();
        }

        $user = $this->_user->get_where(['id' => $id])->row();
        $role = $this->_user->getRole();
        $this->data['select_role'][""] = "--- Pilih Role ---";
        foreach ($role as $r) {
            $this->data['select_role'][$r->id] = $r->description;
        }

        $this->data['form_fullname'] = [
            'input' => [
                'id' => 'fullname',
                'name' => 'fullname',
                'class' => 'form-control',
                'value' => $user->full_name,
                'required' => 'required'
            ],
            'label' => [
                'text' => 'Nama Lengkap',
                'attr' => ['class' => 'form-label required'],
            ],
        ];
        $this->data['form_email'] = [
            'input' => [
                'id' => 'email',
                'name' => 'email',
                'class' => 'form-control',
                // 'type' => 'email',
                'value' => $user->email,
                'required' => 'required'
            ],
            'label' => [
                'text' => 'Email / No HP',
                'attr' => ['class' => 'form-label required'],
            ],
        ];
        $this->data['form_password'] = [
            'input' => [
                'id' => 'password',
                'name' => 'password',
                'class' => 'form-control',
                'type' => 'password',
            ],
            'label' => [
                'text' => 'Password <span class="form-label-description">Diisi jika ganti password</span></label>',
                'attr' => ['class' => 'form-label'],
            ],
        ];
        $this->data['form_cpassword'] = [
            'input' => [
                'id' => 'cpassword',
                'name' => 'cpassword',
                'class' => 'form-control',
                'type' => 'password',
            ],
            'label' => [
                'text' => 'Konfirmasi Password',
                'attr' => ['class' => 'form-label'],
            ],
        ];

        $this->data['user'] = $user;
        $this->PAGE_TITLE = "Edit User";
        $this->view('user/form');
    }

    function delete($id = null)
    {
        if (!$id || $id == 1) {
            show_error("Error");
        }

        $this->_user->delete($id);
        $this->session->set_flashdata('message', flashdata("User berhasil dihapus"));
        redirect('user');
    }

    private function _update()
    {
        $id = $this->input->post('id', true);
        $data['full_name'] = $this->input->post('fullname', true);
        $data['email'] = $this->input->post('email', true);
        $data['alamat'] = $this->input->post('alamat', true);
        $data['is_active'] = $this->input->post('is_active', true) ?? 1;
        $id_role = $this->input->post('role', true);
        $password = $this->input->post('password', true);

        if ($id) {
            // Update
            if ($password) {
                $data['password'] = password_hash($password, PASSWORD_DEFAULT);
            }
            $this->_user->update($data, $id, $id_role);
            $this->session->set_flashdata('message', flashdata("Data Berhasil Dirubah"));
        } else {
            if ($password) $data['password'] = password_hash($password, PASSWORD_DEFAULT);
            else           $data['password'] = password_hash(123456, PASSWORD_DEFAULT);
            $id_user = $this->_user->insert($data);
            $update = $this->_user->update_role($id_user, $id_role);
            $this->session->set_flashdata('message', flashdata("Data Berhasil Ditambahkan"));
        }
        redirect('user');
    }
}
