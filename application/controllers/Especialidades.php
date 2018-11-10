<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Especialidades extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Especialidad');
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
		$this->load->view('Especialidades/index', ['Especialidades' => $especialidad]);
	}

	public function create()
    {
        if(!empty($_POST)){
            if($this->Especialidad->Exists($_POST['nombre'])){
            	$this->Especialidad->Add($_POST);
                $this->Auditoria->Add($auditoria = array('idusuario'=>$_SESSION['IdUsuario'], 'tabla'=> 'Especialidades', 'accion'=>'Crear una especialidad', 'ip'=>isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1'));
            }else{
            	$this->load->view('Especialidades/index', ['Error' => 'Registro repetido']);
            }
            redirect(base_url('Especialidades'));
        }
    }

    public function editar()
    {
    	if(!empty($_POST)){
            $this->Especialidad->Update($_POST);
            $this->Auditoria->Add($auditoria = array('idusuario'=>$_SESSION['IdUsuario'], 'tabla'=> 'Especialidades', 'accion'=>'Editar una especialidad', 'ip'=>isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1'));
            redirect(base_url('Especialidades'));
        }
    }

    public function eliminar()
    {
    	if(!empty($_POST)){
    		$this->Especialidad->Delete($_POST['idespecialidad']);
            $this->Auditoria->Add($auditoria = array('idusuario'=>$_SESSION['IdUsuario'], 'tabla'=> 'Especialidades', 'accion'=>'Eliminar una especialidad', 'ip'=>isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1'));
    	}
    	redirect(base_url('Especialidades'));
    }
}
