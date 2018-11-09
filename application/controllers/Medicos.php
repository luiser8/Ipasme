<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medicos extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Especialidad');
        $this->load->model('Medico');

		if(!$this->verify_admin_level()){
            redirect(base_url('Sesion'));
        }
	}

	private function verify_admin_level(){
        return $this->session->userdata("Logueado");
    }

	public function index()
	{
		$especialidad = $this->Especialidad->All();
		$medicos = $this->Medico->All();
		$this->load->view('Medicos/index', ['Medicos' => $medicos, 'Especialidades' => $especialidad]);
	}

	public function create()
    {
        if(!empty($_POST)){
            if($this->Medico->Exists($_POST['cedula'])){
            	$this->Medico->Add($_POST);
            }else{
            	$this->load->view('Medicos/index', ['Error' => 'Registro repetido']);
            }
            redirect(base_url('Medicos'));
        }
    }

    public function editar()
    {
    	if(!empty($_POST)){
            if(!$this->Medico->Exists($_POST['cedula'])){
            	$this->Medico->Update($_POST);
            }else{
            	$this->load->view('Medicos/index', ['Error' => 'Registro repetido']);
            }
            redirect(base_url('Medicos'));
        }
    }

    public function eliminar()
    {
    	if(!empty($_POST)){
    		$this->Medico->Delete($_POST['idmedico']);
    	}
    	redirect(base_url('Medicos'));
    }
}
