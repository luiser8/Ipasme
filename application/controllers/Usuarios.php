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
                $this->Auditoria->Add($auditoria = array('idusuario'=>$_SESSION['IdUsuario'], 'tabla'=> 'Usuarios', 'accion'=>'Crear un usuario', 'ip'=>isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1'));
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
                $this->Auditoria->Add($auditoria = array('idusuario'=>$_SESSION['IdUsuario'], 'tabla'=> 'Usuarios', 'accion'=>'Cambiar contraseña un usuario', 'ip'=>isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1'));
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
                $this->Auditoria->Add($auditoria = array('idusuario'=>$_SESSION['IdUsuario'], 'tabla'=> 'Usuarios', 'accion'=>'Editar un usuario', 'ip'=>isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1'));
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
            $this->Auditoria->Add($auditoria = array('idusuario'=>$_SESSION['IdUsuario'], 'tabla'=> 'Usuarios', 'accion'=>'Eliminar un usuario', 'ip'=>isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1'));
    	}
    	redirect(base_url('Usuarios'));
    }
}
