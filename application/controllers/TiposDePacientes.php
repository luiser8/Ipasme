<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TiposDePacientes extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
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
		$tipoPaciente = $this->TipoPaciente->All();
		$this->load->view('TiposDePacientes/index', ['TiposDePacientes' => $tipoPaciente]);
	}

	public function create()
    {
        if(!empty($_POST)){
            if($this->TipoPaciente->Exists($_POST['nombre'])){
            	$this->TipoPaciente->Add($_POST);
                $this->Auditoria->Add($auditoria = array('idusuario'=>$_SESSION['IdUsuario'], 'tabla'=> 'TipoPaciente', 'accion'=>'Crear un tipoPaciente', 'ip'=>isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1'));
            }else{
            	$this->load->view('TiposDePacientes/index', ['Error' => 'Registro repetido']);
            }
            redirect(base_url('TiposDePacientes'));
        }
    }

    public function editar()
    {
    	if(!empty($_POST)){
            $this->TipoPaciente->Update($_POST);
            $this->Auditoria->Add($auditoria = array('idusuario'=>$_SESSION['IdUsuario'], 'tabla'=> 'TipoPaciente', 'accion'=>'Editar un tipoPaciente', 'ip'=>isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1'));
            redirect(base_url('TiposDePacientes'));
        }
    }

    public function eliminar()
    {
    	if(!empty($_POST)){
    		$this->TipoPaciente->Delete($_POST['idtipopaciente']);
            $this->Auditoria->Add($auditoria = array('idusuario'=>$_SESSION['IdUsuario'], 'tabla'=> 'TipoPaciente', 'accion'=>'Eliminar un tipoPaciente', 'ip'=>isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1'));
    	}
    	redirect(base_url('TiposDePacientes'));
    }
}
