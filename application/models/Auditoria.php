<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auditoria extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function Add($auditoria)
    {
        $this->db->insert('auditoria', $auditoria);
    }
    
    public function All()
    {
        $query = $this->db->query('SELECT auditoria.*, usuarios.* 
                                    FROM auditoria
                                        INNER JOIN usuarios ON auditoria.idusuario = usuarios.idusuario');
        return $query->result_array();
    }

    public function Find($id)
    {
        $query = $this->db->where('idauditoria', $id)->get('auditoria');
        return $query->row_array();
    }
    
    public function Delete($id)
    {
        $this->db->where('idauditoria', $id);
        $this->db->delete('auditoria');
    }
}
