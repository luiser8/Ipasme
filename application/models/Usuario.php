<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function Add($Usuario)
    {
        $this->db->insert('usuarios', $Usuario);
    }
    
    public function All()
    {
        $query = $this->db->get('usuarios');
        return $query->result_array();
    }
    
    public function Check($usuario)
    {
        $where = array('cuenta ' => $usuario['usuario'] , 'clave ' => md5($usuario['clave']));
        $query = $this->db->where($where)->get('usuarios');;
        return $query->row_array();
    }

    public function Find($id)
    {
        $query = $this->db->where('Id', $id)->get('usuarios');
        return $query->row_array();
    }
    
    public function Update($usuario)
    {
        $id = $usuario['idusuario'];
        $this->db->where('idusuario', $id);
        unset($usuario['idusuario']);
        $this->db->update('usuarios', $usuario);
    }
    
    public function Delete($id)
    {
        $this->db->where('idusuario', $id);
        $this->db->delete('usuarios');
    }
}