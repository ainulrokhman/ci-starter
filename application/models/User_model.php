<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    protected $USER;
    function __construct()
    {
        parent::__construct();
        $this->USER = (object) $this->session->userdata('user');
    }
    function insert($data)
    {
        $this->db->insert('user', $data);
        return $this->db->insert_id();
    }
    function getRole()
    {
        if ($this->USER->role_name != 'admin') $this->db->where_not_in('id', [1,7]);
        return $this->db->get('role')->result();
    }
    function get_all()
    {
        if($this->USER->role_name != 'admin') $this->db->where_not_in('role_id', 1);
        $this->db->order_by('role_id', 'asc');
        $db = $this->db->get('v_user_role');
        return $db->result();
    }

    function get_where($where)
    {
        $db = $this->db->get_where('v_user_role', $where);
        return $db;
    }

    function delete($id)
    {
        $this->db->delete('user', ['id' => $id]);
    }

    function update($data, $id, $id_role)
    {
        $this->db->update('user', $data, ['id' => $id]);
        $this->update_role($id, $id_role);
    }

    function update_role($id, $id_role)
    {
        $this->db->delete('user_role', ['id_user' => $id]);
        $this->db->insert('user_role', ["id_role" => $id_role, 'id_user' => $id]);
    }
}
