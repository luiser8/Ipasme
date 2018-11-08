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

    public function Find($id)
    {
        $query = $this->db->where('Id', $id)->get('empresas');
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
