<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pacientes extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Paciente');
        $this->load->model('Empresa');

		if(!$this->verify_admin_level()){
            redirect(base_url('Sesion'));
        }
	}

	private function verify_admin_level(){
        return $this->session->userdata("Logueado");
    }

	public function index()
	{
		$pacientes = $this->Paciente->All();
		$empresa = $this->Empresa->All();
		$this->load->view('Pacientes/index', ['Pacientes' => $pacientes, 'Empresas' => $empresa]);
	}

	public function create()
    {
        if(!empty($_POST)){
            if($this->Paciente->Exists($_POST['cedula'])){
            	$this->Paciente->Add($_POST);
            }else{
            	$this->load->view('Pacientes/index', ['Error' => 'Registro repetido']);
            }
            redirect(base_url('Pacientes'));
        }
    }

    public function editar()
    {
    	if(!empty($_POST)){
            if(!$this->Paciente->Exists($_POST['cedula'])){
            	$this->Paciente->Update($_POST);
            }else{
            	$this->load->view('Pacientes/index', ['Error' => 'Registro repetido']);
            }
            redirect(base_url('Pacientes'));
        }
    }

    public function eliminar()
    {
    	if(!empty($_POST)){
    		$this->Paciente->Delete($_POST['idpaciente']);
    	}
    	redirect(base_url('Pacientes'));
    }
}
