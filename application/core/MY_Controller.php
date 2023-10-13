<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class MY_Controller
 * @property base_model $base_model
 */
class MY_Controller extends CI_Controller
{
    protected $ACCESS_ROLE = null;
    protected $PAGE_PRETITLE = null;
    protected $PAGE_TITLE = null;
    protected $data = null;
    protected $USER = null;

    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user')) redirect('auth');

        $this->USER = (object) $this->session->userdata('user');
        $module = strtolower(get_called_class());
        $get_access = $this->db->like("url_menu", $module)->get_where('v_submenu', ['is_active' => 1])->row();
        if ($get_access) {
            $roles = $get_access->roles;
            $roles = explode(',', $roles);
            if (!in_array($this->USER->role_name, $roles)) show_error("{$this->USER->role_description} tidak diperbolehkan mengakses");
        }
    }

    private function _settingPage()
    {
        if (!$this->PAGE_PRETITLE) show_error('PAGE_PRETITLE Belum didefinisikan');
        if (!$this->PAGE_TITLE) show_error('PAGE_TITLE Belum didefinisikan');
        $this->data['page_pretitle'] = $this->PAGE_PRETITLE;
        $this->data['page_title'] = $this->PAGE_TITLE;
        $this->data['user_template'] = $this->USER;
    }

    private function _getMenu()
    {
        $role = $this->USER->role_name;
        $data = $this->db->like("roles", $role)->get_where('v_submenu')->result();
        $menu = array();
        $submenu = array();
        foreach ($data as $m) {
            $menu[$m->menu_id] = [
                "id" => $m->menu_id,
                "title" => $m->menu,
                "icon" => $m->icon,
                "url" => $m->url_menu,
            ];
            if ($m->id && $m->is_active != 0) $submenu[$m->menu_id][$m->id] = [
                "title" => $m->title,
                "url" => $m->url_menu .'/'. $m->url_sub_menu,
            ];
        }
        foreach ($submenu as $key => $value) {
            $menu[$key]['submenu'] = $value;
        }

        $this->data['template_menu'] = $menu;
        // echo json_encode($menu); die;
    }

    function view($path_view = null, $html = false)
    {
        $this->_settingPage();
        $this->_getMenu();

        if ($html) return $this->load->view($path_view, $this->data, $html);

        $this->load->view('template/header', $this->data);
        $this->load->view('template/sidebar');
        if ($path_view) $this->load->view($path_view);
        $this->load->view('template/footer');
    }
}
