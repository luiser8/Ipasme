<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Niveles');
        $this->load->model('Usuario');

		if(!$this->verify_admin_level()){
            redirect(base_url('Sesion'));
        }
	}

	private function verify_admin_level(){
        return $this->session->userdata("Logueado");
    }

	public function index()
	{
		$niveles = $this->Niveles->All();
		$usuarios = $this->Usuario->All();
		$this->load->view('Usuarios/index', ['Usuarios' => $usuarios, 'Niveles' => $niveles]);
	}

	public function create()
    {
        if(!empty($_POST)){
            if($this->Usuario->Exists($_POST['cedula'])){
                $_POST['clave'] = md5($_POST['clave']);
            	$this->Usuario->Add($_POST);
            }else{
            	$this->load->view('Usuarios/index', ['Error' => 'Registro repetido']);
            }
            redirect(base_url('Usuarios'));
        }
    }

    public function cambiarclave()
    {
    	if(!empty($_POST)){
            if($this->Usuario->Exists($_POST['idusuario'])){
                $_POST['clave'] = md5($_POST['clave']);
            	$this->Usuario->Update($_POST);
            }else{
            	$this->load->view('Usuarios/index', ['Error' => 'Registro repetido']);
            }
            redirect(base_url('Usuarios'));
        }
    }

    public function editar()
    {
    	if(!empty($_POST)){
            if(!$this->Usuario->Exists($_POST['cedula'])){
            	$this->Usuario->Update($_POST);
            }else{
            	$this->load->view('Usuarios/index', ['Error' => 'Registro repetido']);
            }
            redirect(base_url('Usuarios'));
        }
    }

    public function eliminar()
    {
    	if(!empty($_POST)){
    		$this->Usuario->Delete($_POST['idusuario']);
    	}
    	redirect(base_url('Usuarios'));
    }
}
