<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Especialidad extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function Add($especialidad)
    {
        $this->db->insert('especialidades', $especialidad);
    }
    
    public function All()
    {
        $query = $this->db->get('especialidades');
        return $query->result_array();
    }

    function Exists($especialidad)
    {
        $is_unique;
        $query = $this->db->where('nombre', $especialidad)->get('especialidades');
        if($query->num_rows() > 0){
            return $is_unique = false;
        }else{
            return $is_unique = true;
        }
        return $is_unique;       
    }

    public function Find($id)
    {
        $query = $this->db->where('idespecialidad', $id)->get('especialidades');
        return $query->row_array();
    }
    
    public function Update($especialidad)
    {
        $id = $especialidad['idespecialidad'];
        $this->db->where('idespecialidad', $id);
        unset($especialidad['idespecialidad']);
        $this->db->update('especialidades', $especialidad);
    }
    
    public function Delete($id)
    {
        $this->db->where('idespecialidad', $id);
        $this->db->delete('especialidades');
    }
}
