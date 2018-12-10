<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Familiar extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function Exists($familiar)
    {
        $is_unique;
        $query = $this->db->where('cedula', $familiar)->get('familiares');
        if($query->num_rows() > 0){
            return $is_unique = false;
        }else{
            return $is_unique = true;
        }
        return $is_unique;       
    }

    function Add($familiar)
    {
        $this->db->insert('familiares', $familiar);
    }
    
    public function All()
    {
        $query = $this->db->query('SELECT familiares.*, pacientes.idpaciente
                                    FROM familiares
                                        INNER JOIN pacientes ON familiares.idpaciente = pacientes.idpaciente');
        return $query->result_array();
    }

    public function Find($id)
    {
        $query = $this->db->query('SELECT familiares.*, pacientes.idpaciente
                                    FROM familiares
                                        INNER JOIN pacientes ON familiares.idpaciente = pacientes.idpaciente
                                            WHERE familiares.idpaciente='.$id);
        return $query->result_array();
    }
    
    public function Update($familiar)
    {
        $id = $familiar['idfamiliar'];
        $this->db->where('idfamiliar', $id);
        unset($familiar['idfamiliar']);
        $this->db->update('familiares', $familiar);
    }
    
    public function Delete($id)
    {
        $this->db->where('idfamiliar', $id);
        $this->db->delete('familiares');
    }
}
