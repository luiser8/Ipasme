<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Examenes extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Auditoria');
        $this->load->model('EstudioPaciente');
        $this->load->model('Paciente');
        $this->load->model('Estudio');
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
		$estudiopaciente = $this->EstudioPaciente->All();
		$paciente = $this->Paciente->All();
		$estudios = $this->Estudio->All();
		$medicos = $this->Medico->All();
		$this->load->view('Examenes/index', ['Examenes' => $estudiopaciente,
												'Pacientes' => $paciente,
													'Estudios' => $estudios,
														'Medicos' => $medicos]);
	}

	public function create()
    {
        if(!empty($_POST)){
        	if(in_array($_FILES["imagen"]["type"], $mime_types = array('png' => 'image/png','jpe' => 'image/jpeg','jpeg' => 'image/jpeg','jpg' => 'image/jpeg'))){
				$imagen_name = $_POST['idpaciente'].'_'.$_POST['fecha'].'_'.rand();
				$ubicacion = './assets/examenes/'.$imagen_name.'_'.basename($_FILES['imagen']['name']);
        		move_uploaded_file($_FILES['imagen']['tmp_name'], $ubicacion);

        		$_POST['imagen'] = "{$imagen_name}_{$_FILES['imagen']['name']}";
        		$this->EstudioPaciente->Add($_POST);
            	$this->Auditoria->Add($auditoria = array('idusuario'=>$_SESSION['IdUsuario'], 'tabla'=> 'EstudioPaciente', 'accion'=>'Crear un estudio paciente', 'ip'=>isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1'));
            	redirect(base_url('Examenes'));
        	}
        	redirect(base_url('Examenes'));
        }
        redirect(base_url('Examenes'));
    }

	public function details($id)
	{
		$estudiopaciente = $this->EstudioPaciente->Find($id);
		$this->load->view('Examenes/detalles', ['detalleExamen' => $estudiopaciente]);
	}

    public function editar()
    {
    	if(!empty($_POST)){
            $this->EstudioPaciente->Update($_POST);
            $this->Auditoria->Add($auditoria = array('idusuario'=>$_SESSION['IdUsuario'], 'tabla'=> 'EstudioPaciente', 'accion'=>'Editar un estudio paciente', 'ip'=>isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1'));
            redirect(base_url('Examenes'));
        }
    }

    public function eliminar()
    {
    	if(!empty($_POST)){
    		$this->EstudioPaciente->Delete($_POST['idestudiopac']);
            $this->Auditoria->Add($auditoria = array('idusuario'=>$_SESSION['IdUsuario'], 'tabla'=> 'EstudioPaciente', 'accion'=>'Eliminar un estudio paciente', 'ip'=>isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1'));
    	}
    	redirect(base_url('Examenes'));
    }
}
