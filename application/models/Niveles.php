<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Niveles extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function All()
    {
        $query = $this->db->get('niveles');
        return $query->result_array();
    }
}