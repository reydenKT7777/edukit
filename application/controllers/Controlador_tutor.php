<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Controlador_tutor extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_tutor');
	}
	public function index()
	{
		$this->load->view('tutor_view');
	}
	public function listar_tutor()
	{
		$r = $this->model_tutor->listar_tutor();
		echo json_encode($r);
	}
	public function agregar_datos()
	{
		$id = $this->input->post('id');
		$parentesco = $this->input->post('parentesco');
		$persona_id = $this->input->post('persona_id');
		$data = array(
			'id' => $id, 
			'parentesco' => $parentesco, 
			'persona_id' => $persona_id, 
		);
		$this->model_tutor->agregar_datos($data);
	}
	public function modificar_tutor()
	{
		$id = $this->input->post('id');
		$id = $this->input->post('id');
		$parentesco = $this->input->post('parentesco');
		$persona_id = $this->input->post('persona_id');
		$data = array(
			'id' => $id, 
			'parentesco' => $parentesco, 
			'persona_id' => $persona_id, 
		);
		$this->model_tutor->modificar_tutor($id,$data);
	}
	public function buscar_tutor()
	{
		$id = $this->input->post('id');
		$r = $this->model_tutor->buscar_tutor($id);
		echo json_encode($r);
	}
	public function eliminar_datos()
	{
		$id = $this->input->post('id');
		$r = $this->model_tutor->eliminar_datos($id);
	}
}
