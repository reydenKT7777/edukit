<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Controlador_estudiante extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_estudiante');
	}
	public function index()
	{
		$this->load->view('estudiante_view');
	}
	public function listar_estudiante()
	{
		$r = $this->model_estudiante->listar_estudiante();
		echo json_encode($r);
	}
	public function agregar_datos()
	{
		$id = $this->input->post('id');
		$persona_id = $this->input->post('persona_id');
		$tutor_id = $this->input->post('tutor_id');
		$data = array(
			'id' => $id, 
			'persona_id' => $persona_id, 
			'tutor_id' => $tutor_id, 
		);
		$this->model_estudiante->agregar_datos($data);
	}
	public function modificar_estudiante()
	{
		$id = $this->input->post('id');
		$id = $this->input->post('id');
		$persona_id = $this->input->post('persona_id');
		$tutor_id = $this->input->post('tutor_id');
		$data = array(
			'id' => $id, 
			'persona_id' => $persona_id, 
			'tutor_id' => $tutor_id, 
		);
		$this->model_estudiante->modificar_estudiante($id,$data);
	}
	public function buscar_estudiante()
	{
		$id = $this->input->post('id');
		$r = $this->model_estudiante->buscar_estudiante($id);
		echo json_encode($r);
	}
	public function eliminar_datos()
	{
		$id = $this->input->post('id');
		$r = $this->model_estudiante->eliminar_datos($id);
	}
}
