<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estadisticas extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('EstudioPaciente');
        $this->load->model('Paciente');

		if(!$this->verify_admin_level()){
            redirect(base_url('Sesion'));
        }
	}

	private function verify_admin_level(){
        return $this->session->userdata("Logueado");
    }

	public function index()
	{
		$this->load->view('Estadisticas/index');
	}

    public function get()
    {
        $estudiopaciente = $this->EstudioPaciente->All();
        echo json_encode($estudiopaciente, JSON_NUMERIC_CHECK);///JSON_UNESCAPED_UNICODE JSON_NUMERIC_CHECK
    }

    public function getId($id)
    {
        $estudiopaciente = $this->EstudioPaciente->Find($id);
        echo json_encode($estudiopaciente, JSON_UNESCAPED_UNICODE);///JSON_UNESCAPED_UNICODE JSON_NUMERIC_CHECK
    }

    public function getDates($date1, $date2)
    {
        $estudiopaciente = $this->EstudioPaciente->FindDates($date1, $date2);
        echo json_encode($estudiopaciente, JSON_NUMERIC_CHECK);///JSON_UNESCAPED_UNICODE JSON_NUMERIC_CHECK
    }

    public function getGender($date1, $date2)
    {
        $estudiopaciente = $this->EstudioPaciente->FindGender($date1, $date2);
        echo json_encode($estudiopaciente, JSON_NUMERIC_CHECK);///JSON_UNESCAPED_UNICODE JSON_NUMERIC_CHECK
    }

    public function getAge($date1, $date2)
    {
        $estudiopaciente = $this->EstudioPaciente->FindAge($date1, $date2);
        echo json_encode($estudiopaciente, JSON_NUMERIC_CHECK);///JSON_UNESCAPED_UNICODE JSON_NUMERIC_CHECK
    }

    public function getType($date1, $date2)
    {
        $estudiopaciente = $this->EstudioPaciente->FindTypes($date1, $date2);
        echo json_encode($estudiopaciente, JSON_NUMERIC_CHECK);///JSON_UNESCAPED_UNICODE JSON_NUMERIC_CHECK
    }

    public function getStudio($date1, $date2)
    {
        $estudiopaciente = $this->EstudioPaciente->FindStudio($date1, $date2);
        echo json_encode($estudiopaciente, JSON_NUMERIC_CHECK);///JSON_UNESCAPED_UNICODE JSON_NUMERIC_CHECK
    }
}
