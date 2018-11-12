<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EstudioPaciente extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function Add($estudiopaciente)
    {
        $this->db->insert('estudiopaciente', $estudiopaciente);
    }
    
    public function All()
    {
        $query = $this->db->query('SELECT estudiopaciente.*, pacientes.*, estudios.nombre AS estudio, CONCAT(medicos.nombres," ", medicos.apellidos) AS medico
                                    FROM estudiopaciente
                                        INNER JOIN pacientes ON estudiopaciente.idpaciente = pacientes.idpaciente
                                        INNER JOIN estudios ON estudiopaciente.idestudio = estudios.idestudio
                                        INNER JOIN medicos ON estudiopaciente.idmedico = medicos.idmedico');
        return $query->result_array();
    }

    function Exists($estudiopaciente)
    {
        $is_unique;
        $query = $this->db->where('idestudiopac', $estudiopaciente)->get('estudiopaciente');
        if($query->num_rows() > 0){
            return $is_unique = false;
        }else{
            return $is_unique = true;
        }
        return $is_unique;       
    }

    public function Find($id)
    {
        $query = $this->db->query('SELECT estudiopaciente.*, pacientes.*, estudios.nombre AS estudio, CONCAT(medicos.nombres," ", medicos.apellidos) AS medico
                                                                    FROM estudiopaciente
                                                                        INNER JOIN pacientes ON estudiopaciente.idpaciente = pacientes.idpaciente
                                                                        INNER JOIN estudios ON estudiopaciente.idestudio = estudios.idestudio
                                                                        INNER JOIN medicos ON estudiopaciente.idmedico = medicos.idmedico
                                                                            WHERE estudiopaciente.idestudiopac='.$id);
        return $query->row_array();
    }
    
    public function Update($estudiopaciente)
    {
        $id = $estudiopaciente['idestudiopac'];
        $this->db->where('idestudiopac', $id);
        unset($estudiopaciente['idestudiopac']);
        $this->db->update('estudiopaciente', $estudiopaciente);
    }
    
    public function Delete($id)
    {
        $this->db->where('idestudiopac', $id);
        $this->db->delete('estudiopaciente');
    }
}
