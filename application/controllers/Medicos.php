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
		$especialidad = $this->Especialidad->All();
		$medicos = $this->Medico->All();
		$this->load->view('Medicos/index', ['Medicos' => $medicos, 'Especialidades' => $especialidad]);
	}

	public function create()
    {
        if(!empty($_POST)){
            if($this->Medico->Exists($_POST['cedula'])){
            	$this->Medico->Add($_POST);
                $this->Auditoria->Add($auditoria = array('idusuario'=>$_SESSION['IdUsuario'], 'tabla'=> 'Medicos', 'accion'=>'Crear un medico', 'ip'=>isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1'));
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
                $this->Auditoria->Add($auditoria = array('idusuario'=>$_SESSION['IdUsuario'], 'tabla'=> 'Medicos', 'accion'=>'Editar un medico', 'ip'=>isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1'));
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
            $this->Auditoria->Add($auditoria = array('idusuario'=>$_SESSION['IdUsuario'], 'tabla'=> 'Medicos', 'accion'=>'Eliminar un medico', 'ip'=>isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1'));
    	}
    	redirect(base_url('Medicos'));
    }
}
