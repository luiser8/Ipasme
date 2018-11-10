<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auditorias extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
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
		$auditoria = $this->Auditoria->All();
		$this->load->view('Auditorias/index', ['Auditorias' => $auditoria]);
	}

    public function eliminar()
    {
    	if(!empty($_POST)){
    		$this->Auditoria->Delete($_POST['idauditoria']);
            $this->Auditoria->Add($auditoria = array('idusuario'=>$_SESSION['IdUsuario'], 'tabla'=> 'Auditoria', 'accion'=>'Eliminar una auditoria', 'ip'=>isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1'));
    	}
    	redirect(base_url('Auditorias'));
    }
}
