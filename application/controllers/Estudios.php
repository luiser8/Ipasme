<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estudios extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Estudio');

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
            redirect(base_url('Estudios'));
        }
    }

    public function eliminar()
    {
    	if(!empty($_POST)){
    		$this->Estudio->Delete($_POST['idestudio']);
    	}
    	redirect(base_url('Estudios'));
    }
}
