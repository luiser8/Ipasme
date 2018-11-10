<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TipoPaciente extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function Add($tipopaciente)
    {
        $this->db->insert('tipopaciente', $tipopaciente);
    }
    
    public function All()
    {
        $query = $this->db->get('tipopaciente');
        return $query->result_array();
    }

    function Exists($tipopaciente)
    {
        $is_unique;
        $query = $this->db->where('nombre', $tipopaciente)->get('tipopaciente');
        if($query->num_rows() > 0){
            return $is_unique = false;
        }else{
            return $is_unique = true;
        }
        return $is_unique;       
    }

    public function Find($id)
    {
        $query = $this->db->where('idtipopaciente', $id)->get('tipopaciente');
        return $query->row_array();
    }
    
    public function Update($tipopaciente)
    {
        $id = $tipopaciente['idtipopaciente'];
        $this->db->where('idtipopaciente', $id);
        unset($tipopaciente['idtipopaciente']);
        $this->db->update('tipopaciente', $tipopaciente);
    }
    
    public function Delete($id)
    {
        $this->db->where('idtipopaciente', $id);
        $this->db->delete('tipopaciente');
    }
}
