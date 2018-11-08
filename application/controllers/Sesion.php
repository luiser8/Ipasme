<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sesion extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Usuario');

       	/*if($this->verify_admin_level()){
            redirect(base_url('Sesion'));
		}*/
    }

	public function index()
	{
		$this->load->view('Sesion/index');
	}

	public function login()
	{
		if($_POST)
		{
			$usuario = $this->Usuario->Check($_POST);
			if($usuario){
				$usuario_data = array(
					'IdUsuario'=>$usuario['idusuario'],
					'Nombres'=>$usuario['nombres'],
					'Apellidos'=>$usuario['apellidos'],
					'Nivel'=>$usuario['idnivel'],
					'Logueado' => TRUE
				);
				$this->session->set_userdata($usuario_data);
            	redirect(base_url('Principal'));
			}else{
				$this->load->view('Sesion/index', ['Error'=>'Error! usuario o contraseña invalido. Vuelve a intentar']);
			}				
        }
	}

	public function logout() 
	{
      $usuario_data = array(
         'Logueado' => FALSE
      );
      $this->session->set_userdata($usuario_data);
      $this->session->sess_destroy();
      redirect(base_url('Sesion'));
   }

   private function verify_admin_level(){
        return $this->session->userdata("Logueado");
    }
}
