<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estudios extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Estudio');
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
		$estudio = $this->Estudio->All();
		$this->load->view('Estudios/index', ['Estudios' => $estudio]);
	}

	public function create()
    {
        if(!empty($_POST)){
            if($this->Estudio->Exists($_POST['nombre'])){
            	$this->Estudio->Add($_POST);
                $this->Auditoria->Add($auditoria = array('idusuario'=>$_SESSION['IdUsuario'], 'tabla'=> 'Estudios', 'accion'=>'Crear un estudio', 'ip'=>isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1'));
            }else{
            	$this->load->view('Estudios/index', ['Error' => 'Registro repetido']);
            }
            redirect(base_url('Estudios'));
        }
    }

    public function editar()
    {
    	if(!empty($_POST)){
            $this->Estudio->Update($_POST);
            $this->Auditoria->Add($auditoria = array('idusuario'=>$_SESSION['IdUsuario'], 'tabla'=> 'Estudios', 'accion'=>'Editar un estudio', 'ip'=>isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1'));
            redirect(base_url('Estudios'));
        }
    }

    public function eliminar()
    {
    	if(!empty($_POST)){
    		$this->Estudio->Delete($_POST['idestudio']);
            $this->Auditoria->Add($auditoria = array('idusuario'=>$_SESSION['IdUsuario'], 'tabla'=> 'Estudios', 'accion'=>'Eliminar un estudio', 'ip'=>isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1'));
    	}
    	redirect(base_url('Estudios'));
    }
}
