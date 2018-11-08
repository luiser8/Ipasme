<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
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
        $usuario = $this->Usuario->Find($_SESSION['IdUsuario']);
        $this->load->view('Perfil/index', ['Usuario' => $usuario]);
    }
}