<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Familiares extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Familiar');
        $this->load->model('Paciente');
        $this->load->model('Auditoria');

		if(!$this->verify_admin_level()){
            redirect(base_url('Sesion'));
        }
	}

	private function verify_admin_level(){
        return $this->session->userdata("Logueado");
    }

	public function index($idpaciente)
	{
		$familiar = $this->Familiar->Find($idpaciente);
		$this->load->view('Familiares/index', ['Familiar' => $familiar]);
	}

	public function create()
    {
        if(!empty($_POST)){
            $now = new Datetime();
            $nac = new Datetime($_POST['fechaNacimiento']);
            $edad = $now->diff($nac);
            $_POST['edad'] = $edad->y;

            if($this->Familiar->Exists($_POST['cedula'])){
            	$this->Familiar->Add($_POST);
                $this->Auditoria->Add($auditoria = array('idusuario'=>$_SESSION['IdUsuario'], 'tabla'=> 'Familiares', 'accion'=>'Crear un familiar', 'ip'=>isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1'));
            }else{
            	$this->load->view('Familiar/index', ['Error' => 'Registro repetido']);
            }
            redirect(base_url("Familiares/{$_POST['idpaciente']}"));
        }
    }

    public function editar()
    {
    	if(!empty($_POST)){
            if(!$this->Familiar->Exists($_POST['cedula'])){
            	$this->Familiar->Update($_POST);
                $this->Auditoria->Add($auditoria = array('idusuario'=>$_SESSION['IdUsuario'], 'tabla'=> 'Familiares', 'accion'=>'Editar un familiar', 'ip'=>isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1'));
            }else{
            	$this->load->view('Familiares/index', ['Error' => 'Registro repetido']);
            }
            redirect(base_url("Familiares/{$_POST['idpaciente']}"));
        }
    }

    public function eliminar()
    {
    	if(!empty($_POST)){
    		$this->Familiar->Delete($_POST['idfamiliar']);
            $this->Auditoria->Add($auditoria = array('idusuario'=>$_SESSION['IdUsuario'], 'tabla'=> 'Familiares', 'accion'=>'Elimnar un familiar', 'ip'=>isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1'));
    	}
    	redirect(base_url("Familiares/{$_POST['idpaciente']}"));
    }
}
