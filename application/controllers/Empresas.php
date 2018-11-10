<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empresas extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Empresa');
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
		$empresa = $this->Empresa->All();
		$this->load->view('Empresas/index', ['Empresas' => $empresa]);
	}

	public function create()
    {
        if(!empty($_POST)){
            if($this->Empresa->Exists($_POST['nombre'])){
            	$this->Empresa->Add($_POST);
                $this->Auditoria->Add($auditoria = array('idusuario'=>$_SESSION['IdUsuario'], 'tabla'=> 'Empresas', 'accion'=>'Crear una empresa', 'ip'=>isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1'));
            }else{
            	$this->load->view('Empresas/index', ['Error' => 'Registro repetido']);
            }
            redirect(base_url('Empresas'));
        }
    }

    public function editar()
    {
    	if(!empty($_POST)){
            $this->Empresa->Update($_POST);
            $this->Auditoria->Add($auditoria = array('idusuario'=>$_SESSION['IdUsuario'], 'tabla'=> 'Empresas', 'accion'=>'Editar una empresa', 'ip'=>isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1'));
            redirect(base_url('Empresas'));
        }
    }

    public function eliminar()
    {
    	if(!empty($_POST)){
    		$this->Empresa->Delete($_POST['idempresa']);
            $this->Auditoria->Add($auditoria = array('idusuario'=>$_SESSION['IdUsuario'], 'tabla'=> 'Empresas', 'accion'=>'Eliminar una empresa', 'ip'=>isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1'));
    	}
    	redirect(base_url('Empresas'));
    }
}
