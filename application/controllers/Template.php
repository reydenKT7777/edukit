<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template extends CI_Controller {
	public function index()
	{
		$this->verificarSesionActiva();
		$this->load->view('login');
	}
	public function sisa()
	{
		$this->verificarSesion();
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
		//$this->verificarSesion();
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
	public function cursos()
	{
		$this->load->view('curso/cursos');
	}
	public function materias()
	{
		$this->load->view('materia/materias');
	}
	public function mis_grupos()
	{
		$this->load->view('noticias/mis_grupos');
	}
	public function perfil_grupo()
	{
		$this->load->view('noticias/perfil_grupo');
	}
	public function mensajeria()
	{
		$this->load->view('noticias/mensajeria');
	}
	public function verificarSesion()
	{
		if (!(isset($this->session->id_usuario))) {
			redirect(base_url(),'refresh');
		}
	}
	public function verificarSesionActiva()
	{
		if (isset($this->session->id_usuario)) {
			redirect(base_url().'template/sisa','refresh');
		}
	}
}
