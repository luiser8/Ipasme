<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paciente extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function Exists($paciente)
    {
        $is_unique;
        $query = $this->db->where('cedula', $paciente)->get('pacientes');
        if($query->num_rows() > 0){
            return $is_unique = false;
        }else{
            return $is_unique = true;
        }
        return $is_unique;       
    }

    function Add($paciente)
    {
        $this->db->insert('pacientes', $paciente);
    }
    
    public function All()
    {
        $query = $this->db->query('SELECT pacientes.*, empresas.*, tipopaciente.nombre AS tipo
                                    FROM pacientes
                                        INNER JOIN empresas ON pacientes.idempresa = empresas.idempresa
                                        INNER JOIN tipopaciente ON pacientes.idtipopaciente = tipopaciente.idtipopaciente');
        return $query->result_array();
    }

    public function Find($id)
    {
        $query = $this->db->where('idpaciente', $id)->get('pacientes');
        return $query->row_array();
    }
    
    public function Update($paciente)
    {
        $id = $paciente['idpaciente'];
        $this->db->where('idpaciente', $id);
        unset($paciente['idpaciente']);
        $this->db->update('pacientes', $paciente);
    }
    
    public function Delete($id)
    {
        $this->db->where('idpaciente', $id);
        $this->db->delete('pacientes');
    }
}
