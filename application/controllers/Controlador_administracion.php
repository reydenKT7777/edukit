<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Controlador_administracion extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_administracion');
	}
	public function listar_administracion()
	{
		$r = $this->model_administracion->listar_administracion();
		echo json_encode($r);
	}
	public function agregar_datos()
	{
		//$id = $this->input->post('id');
		$cargo = $this->input->post('cargo');
		$persona_id = $this->input->post('persona_id');
		$data = array(
			//'id' => $id,
			'cargo' => $cargo,
			'persona_id' => $persona_id,
		);
		$this->model_administracion->agregar_datos($data);
	}
	public function modificar_administracion()
	{
		$id = $this->input->post('id');
		//$id = $this->input->post('id');
		$cargo = $this->input->post('cargo');
		$persona_id = $this->input->post('persona_id');
		$data = array(
			//'id' => $id,
			'cargo' => $cargo,
			'persona_id' => $persona_id,
		);
		$this->model_administracion->modificar_administracion($id,$data);
	}
	public function buscar_administracion()
	{
		$id = $this->input->post('id');
		$r = $this->model_administracion->buscar_administracion($id);
		echo json_encode($r);
	}
	public function eliminar_datos()
	{
		$id = $this->input->post('id');
		$r = $this->model_administracion->eliminar_datos($id);
	}
}
