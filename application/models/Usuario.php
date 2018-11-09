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
    
    function Exists($usuario)
    {
        $is_unique;
        $query = $this->db->where('cedula', $usuario)->get('usuarios');
        if($query->num_rows() > 0){
            return $is_unique = false;
        }else{
            return $is_unique = true;
        }
        return $is_unique;       
    }

    public function All()
    {
        $query = $this->db->query('SELECT usuarios.*, niveles.* 
                                    FROM usuarios
                                        INNER JOIN niveles ON usuarios.idnivel = niveles.idnivel
                                            WHERE usuarios.idnivel != 1');
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
        $query = $this->db->where('idusuario', $id)->query('SELECT usuarios.*, niveles.* 
                                                                FROM usuarios
                                                                    INNER JOIN niveles ON usuarios.idnivel = niveles.idnivel');
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