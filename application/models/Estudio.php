<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estudio extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function Add($estudio)
    {
        $this->db->insert('estudios', $estudio);
    }
    
    public function All()
    {
        $query = $this->db->get('estudios');
        return $query->result_array();
    }

    function Exists($estudio)
    {
        $is_unique;
        $query = $this->db->where('nombre', $estudio)->get('estudios');
        if($query->num_rows() > 0){
            return $is_unique = false;
        }else{
            return $is_unique = true;
        }
        return $is_unique;       
    }

    public function Find($id)
    {
        $query = $this->db->where('idestudio', $id)->get('estudios');
        return $query->row_array();
    }
    
    public function Update($estudio)
    {
        $id = $estudio['idestudio'];
        $this->db->where('idestudio', $id);
        unset($estudio['idestudio']);
        $this->db->update('estudios', $estudio);
    }
    
    public function Delete($id)
    {
        $this->db->where('idestudio', $id);
        $this->db->delete('estudios');
    }
}
