<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medico extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function Add($medico)
    {
        $this->db->insert('medicos', $medico);
    }
    
    public function All()
    {
        $query = $this->db->query('SELECT medicos.*, especialidades.* 
                                    FROM medicos
                                        INNER JOIN especialidades ON medicos.idespecialidad = especialidades.idespecialidad');
        return $query->result_array();
    }

    function Exists($medico)
    {
        $is_unique;
        $query = $this->db->where('cedula', $medico)->get('medicos');
        if($query->num_rows() > 0){
            return $is_unique = false;
        }else{
            return $is_unique = true;
        }
        return $is_unique;       
    }

    public function Find($id)
    {
        $query = $this->db->where('idmedico', $id)->get('medicos');
        return $query->row_array();
    }
    
    public function Update($medico)
    {
        $id = $medico['idmedico'];
        $this->db->where('idmedico', $id);
        unset($medico['idmedico']);
        $this->db->update('medicos', $medico);
    }
    
    public function Delete($id)
    {
        $this->db->where('idmedico', $id);
        $this->db->delete('medicos');
    }
}
