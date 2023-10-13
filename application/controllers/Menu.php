<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->PAGE_PRETITLE = "Menu";
    }

    function index()
    {
        $this->data['user_menu'] = $this->db->order_by('index')->get('user_menu')->result();
        $this->PAGE_TITLE = "Manajemen Menu";
        $this->view("menu/index");
    }

    function add()
    {
        if ($this->input->method() == "post") {
            $this->_update();
        }
        $this->data['form_menu'] = [
            'input' => [
                'id' => 'menu',
                'name' => 'menu',
                'class' => 'form-control',
                "required" => "required"
            ],
            'label' => [
                'text' => 'Menu',
                'attr' => ['class' => 'form-label'],
            ],
        ];
        $this->data['form_icon'] = [
            'input' => [
                'id' => 'icon',
                'name' => 'icon',
                'class' => 'form-control',
                "required" => "required"
            ],
            'label' => [
                'text' => 'Icon',
                'attr' => ['class' => 'form-label'],
            ],
        ];
        $this->data['form_index'] = [
            'input' => [
                'id' => 'index',
                'name' => 'index',
                'class' => 'form-control',
                "type" => "number",
                "required" => "required"
            ],
            'label' => [
                'text' => 'index',
                'attr' => ['class' => 'form-label'],
            ],
        ];

        $this->load->helper('form');
        $this->PAGE_TITLE = "Tambah Menu";
        $this->view("menu/form");
    }

    function edit($id = null)
    {
        if (!$id) {
            show_error("Error");
        }

        if ($this->input->method() == "post") {
            $this->_update();
        }

        $menu = $this->db->get_where('user_menu', ['id' => $id])->row();

        if (!$menu) {
            show_error("Error");
        }

        $this->data['form_menu'] = [
            'input' => [
                'id' => 'menu',
                'name' => 'menu',
                'value' => $menu->menu,
                'class' => 'form-control',
            ],
            'label' => [
                'text' => 'Menu',
                'attr' => ['class' => 'form-label'],
            ],
        ];
        $this->data['form_icon'] = [
            'input' => [
                'id' => 'icon',
                'name' => 'icon',
                'value' => $menu->icon,
                'class' => 'form-control',
            ],
            'label' => [
                'text' => 'Icon',
                'attr' => ['class' => 'form-label'],
            ],
        ];
        $this->data['form_index'] = [
            'input' => [
                'id' => 'index',
                'name' => 'index',
                'value' => $menu->index,
                'class' => 'form-control',
            ],
            'label' => [
                'text' => 'Index',
                'attr' => ['class' => 'form-label'],
            ],
        ];

        $this->load->helper('form');
        $this->data['user_menu'] = $menu;
        $this->PAGE_TITLE = "Edit Menu";
        $this->view("menu/form");
    }

    function delete($id = null)
    {
        if (!$id) {
            show_error("Error");
        }

        $this->db->delete('user_menu', ['id' => $id]);
        $this->session->set_flashdata('message', flashdata("Data berhasil dihapus."));
        redirect('menu');
    }

    private function _update()
    {
        $id             = $this->input->post('id', true);
        $data['menu']   = $this->input->post('menu', true);
        $data['icon']   = $this->input->post('icon', true);
        $data['index']   = $this->input->post('index', true);

        if ($id) $this->db->update('user_menu', $data, ['id' => $id]);
        else {
            $this->db->insert('user_menu', $data);
            $id = $this->db->insert_id();
            $this->db->insert('user_access_menu', ['role_id' => 1, 'menu_id' => $id]);
        }
        $this->session->set_flashdata('message', flashdata("Data berhasil diubah."));
        redirect('menu');
    }

    function submenu()
    {
        $this->db->where('id !=', null);
        $this->data['user_menu'] = $this->db->get('v_submenu')->result();
        $this->PAGE_TITLE = "Manajemen Sub Menu";
        $this->view("menu/submenu");
    }

    function add_submenu()
    {
        if ($this->input->method() == "post") {
            $this->_update_submenu();
        }
        $this->data['form_title'] = [
            'input' => [
                'id' => 'title',
                'name' => 'title',
                'class' => 'form-control',
                "required" => "required"
            ],
            'label' => [
                'text' => 'Judul',
                'attr' => ['class' => 'form-label'],
            ],
        ];
        $this->data['form_url'] = [
            'input' => [
                'id' => 'url',
                'name' => 'url',
                'class' => 'form-control',
                "required" => "required"
            ],
            'label' => [
                'text' => 'URL',
                'attr' => ['class' => 'form-label'],
            ],
        ];
        $this->data['s'] = [
            'form_attr' => [
                'checked' => true,
                'name' => 'isactive',
                'id' => 'isactive',
                'class' => 'form-check-input',
                'value' => 1,
            ],
            'label_attr' => ['class' => 'form-check-label',]
        ];

        $menu = $this->db->get('user_menu')->result();
        foreach ($menu as $m) {
            $this->data['select_menu'][$m->id] = $m->menu;
        }

        $this->load->helper('form');
        $this->PAGE_TITLE = "Tambah Sub Menu";
        $this->view("menu/form_submenu");
    }

    function edit_submenu($id = null)
    {
        if (!$id) {
            show_error("Error");
        }

        if ($this->input->method() == "post") {
            $this->_update_submenu();
        }

        $submenu = $this->db->get_where('user_sub_menu', ['id' => $id])->row();

        if (!$submenu) {
            show_error("Error");
        }
        $this->data['form_title'] = [
            'input' => [
                'id' => 'title',
                'name' => 'title',
                'class' => 'form-control',
                "value" => $submenu->title
            ],
            'label' => [
                'text' => 'Judul',
                'attr' => ['class' => 'form-label'],
            ],
        ];
        $this->data['form_url'] = [
            'input' => [
                'id' => 'url',
                'name' => 'url',
                'class' => 'form-control',
                "value" => $submenu->url
            ],
            'label' => [
                'text' => 'URL',
                'attr' => ['class' => 'form-label'],
            ],
        ];
        $this->data['s'] = [
            'form_attr' => [
                'checked' => (bool) $submenu->is_active,
                'name' => 'isactive',
                'id' => 'isactive',
                'class' => 'form-check-input',
                'value' => 1,
            ],
            'label_attr' => ['class' => 'form-check-label',]
        ];

        $menu = $this->db->get('user_menu')->result();
        foreach ($menu as $m) {
            $this->data['select_menu'][$m->id] = $m->menu;
        }

        $this->load->helper('form');
        $this->data['user_menu'] = $submenu;
        $this->PAGE_TITLE = "Edit Sub Menu";
        $this->view("menu/form_submenu");
    }

    function delete_submenu($id = null)
    {
        if (!$id) {
            show_error("Error");
        }

        $this->db->delete('user_sub_menu', ['id' => $id]);
        $this->session->set_flashdata('message', flashdata("Data berhasil dihapus."));
        redirect('menu/submenu');
    }

    private function _update_submenu()
    {
        $id                 = $this->input->post('id', true);
        $data['menu_id']    = $this->input->post('menu', true);
        $data['title']      = $this->input->post('title', true);
        $data['url']        = $this->input->post('url', true);
        $data['is_active']  = $this->input->post('isactive', true) ?? 0;

        if ($id) $this->db->update('user_sub_menu', $data, ['id' => $id]);
        else $this->db->insert('user_sub_menu', $data);
        $this->session->set_flashdata('message', flashdata("Data berhasil diubah."));
        redirect('menu/submenu');
    }
}
