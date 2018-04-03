<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Controlador_profesor extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_profesor');
	}
	public function index()
	{
		$this->load->view('profesor_view');
	}
	public function listar_profesor()
	{
		$r = $this->model_profesor->listar_profesor();
		echo json_encode($r);
	}
	public function agregar_datos()
	{
		$id = $this->input->post('id');
		$especialidad = $this->input->post('especialidad');
		$persona_id = $this->input->post('persona_id');
		$data = array(
			'id' => $id, 
			'especialidad' => $especialidad, 
			'persona_id' => $persona_id, 
		);
		$this->model_profesor->agregar_datos($data);
	}
	public function modificar_profesor()
	{
		$id = $this->input->post('id');
		$id = $this->input->post('id');
		$especialidad = $this->input->post('especialidad');
		$persona_id = $this->input->post('persona_id');
		$data = array(
			'id' => $id, 
			'especialidad' => $especialidad, 
			'persona_id' => $persona_id, 
		);
		$this->model_profesor->modificar_profesor($id,$data);
	}
	public function buscar_profesor()
	{
		$id = $this->input->post('id');
		$r = $this->model_profesor->buscar_profesor($id);
		echo json_encode($r);
	}
	public function eliminar_datos()
	{
		$id = $this->input->post('id');
		$r = $this->model_profesor->eliminar_datos($id);
	}
}
