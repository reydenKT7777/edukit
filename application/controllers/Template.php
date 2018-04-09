<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('template');
	}
	public function principal()
	{
		$this->load->view('principal');
	}
	public function administracion()
	{
		$this->load->view('administracion/administradores');
	}
	public function profesor_nomina()
	{
		$this->load->view('profesor/nomina');

	}
	public function profesor_asistencia()
	{
		$this->load->view('profesor/asistencia');

	}
	public function profesor_disciplina()
	{
		$this->load->view('profesor/disciplina');

	}
	public function estudiante_nomina()
	{
		$this->load->view('estudiante/nomina');

	}
	public function estudiante_asistencia()
	{
		$this->load->view('estudiante/asistencia');

	}
	public function estudiante_disciplina()
	{
		$this->load->view('estudiante/disciplina');

	}

}
