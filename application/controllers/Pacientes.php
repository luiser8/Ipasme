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
        $this->load->model('TipoPaciente');
        $this->load->model('Auditoria');

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
        $tipopaciente = $this->TipoPaciente->All();
		$this->load->view('Pacientes/index', ['Pacientes' => $pacientes, 'Empresas' => $empresa, 'TiposDePacientes' => $tipopaciente]);
	}

	public function create()
    {
        if(!empty($_POST)){
            $now = new Datetime();
            $nac = new Datetime($_POST['fechaNacimiento']);
            $edad = $now->diff($nac);
            $_POST['edad'] = $edad->y;

            if($this->Paciente->Exists($_POST['cedula'])){
            	$this->Paciente->Add($_POST);
                $this->Auditoria->Add($auditoria = array('idusuario'=>$_SESSION['IdUsuario'], 'tabla'=> 'Pacientes', 'accion'=>'Crear un paciente', 'ip'=>isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1'));
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
                $this->Auditoria->Add($auditoria = array('idusuario'=>$_SESSION['IdUsuario'], 'tabla'=> 'Pacientes', 'accion'=>'Editar un paciente', 'ip'=>isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1'));
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
            $this->Auditoria->Add($auditoria = array('idusuario'=>$_SESSION['IdUsuario'], 'tabla'=> 'Pacientes', 'accion'=>'Elimnar un paciente', 'ip'=>isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1'));
    	}
    	redirect(base_url('Pacientes'));
    }
}
