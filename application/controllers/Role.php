<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Role extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->PAGE_PRETITLE = "Jabatan";
    }

    function index()
    {
        $this->data['role'] = $this->db->where_not_in('id', [1])->get('role')->result();
        $this->PAGE_TITLE = "Manajemen Jabatan";
        $this->view("role/index");
    }

    function add()
    {
        if ($this->input->method() == "post") {
            $this->_update();
        }

        $this->data['form_name'] = [
            'input' => [
                'id' => 'name',
                'name' => 'name',
                'class' => 'form-control',
            ],
            'label' => [
                'text' => 'Name',
                'attr' => ['class' => 'form-label'],
            ],
        ];
        $this->data['form_description'] = [
            'input' => [
                'id' => 'description',
                'name' => 'description',
                'class' => 'form-control',
            ],
            'label' => [
                'text' => 'Description',
                'attr' => ['class' => 'form-label'],
            ],
        ];

        $this->load->helper('form');
        $this->PAGE_TITLE = "Tambah Menu";
        $this->view("role/form");
    }

    function edit($id = null)
    {
        if (!$id || $id == 1) {
            show_error("Error");
        }

        if ($this->input->method() == "post") {
            $this->_update();
        }

        $role = $this->db->get_where('role', ['id' => $id])->row();

        if (!$role) {
            show_error("Error");
        }

        $this->data['form_name'] = [
            'input' => [
                'id' => 'name',
                'name' => 'name',
                'value' => $role->name,
                'class' => 'form-control',
            ],
            'label' => [
                'text' => 'Name',
                'attr' => ['class' => 'form-label'],
            ],
        ];
        $this->data['form_description'] = [
            'input' => [
                'id' => 'description',
                'name' => 'description',
                'value' => $role->description,
                'class' => 'form-control',
            ],
            'label' => [
                'text' => 'Description',
                'attr' => ['class' => 'form-label'],
            ],
        ];

        $this->data['access_menu'] = $this->db->group_by('menu_id')->get('v_submenu')->result();

        $this->load->helper('form');
        $this->data['role'] = $role;
        $this->PAGE_TITLE = "Edit Menu";
        $this->view("role/form");
    }

    function delete($id = null)
    {
        if (!$id) {
            show_error("Error");
        }

        $this->db->delete('role', ['id' => $id]);
        $this->session->set_flashdata('message', flashdata("Data berhasil dihapus."));
        redirect('role');
    }

    private function _update()
    {
        $id             = $this->input->post('id', true);
        $data['name']   = $this->input->post('name', true);
        $data['description']   = $this->input->post('description', true);

        if ($id) {
            $this->db->update('role', $data, ['id' => $id]);
            $menu = $this->input->post('menu', true);

            $this->db->where('role_id', $id);
            $this->db->delete('user_access_menu');
            foreach ($menu as $m_id) {
                $row = $this->db->get_where('user_access_menu', ['role_id' => $id, "menu_id" => $m_id])->row();
                if (!$row) {
                    $this->db->insert('user_access_menu', ['role_id' => $id, "menu_id" => $m_id]);
                }
            }
        } else $this->db->insert('role', $data);
        $this->session->set_flashdata('message', flashdata("Data berhasil diubah."));
        redirect('role');
    }
}
