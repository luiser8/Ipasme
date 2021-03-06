<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empresa extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function Add($empresa)
    {
        $this->db->insert('empresas', $empresa);
    }
    
    public function All()
    {
        $query = $this->db->get('empresas');
        return $query->result_array();
    }

    function Exists($empresa)
    {
        $is_unique;
        $query = $this->db->where('nombre', $empresa)->get('empresas');
        if($query->num_rows() > 0){
            return $is_unique = false;
        }else{
            return $is_unique = true;
        }
        return $is_unique;       
    }

    public function Find($id)
    {
        $query = $this->db->where('idempresa', $id)->get('empresas');
        return $query->row_array();
    }
    
    public function Update($empresa)
    {
        $id = $empresa['idempresa'];
        $this->db->where('idempresa', $id);
        unset($empresa['idempresa']);
        $this->db->update('empresas', $empresa);
    }
    
    public function Delete($id)
    {
        $this->db->where('idempresa', $id);
        $this->db->delete('empresas');
    }
}
