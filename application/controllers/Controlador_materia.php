<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Controlador_materia extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_materia');
	}
	public function index()
	{
		
	}
	public function listar_materia()
	{
		$r = $this->model_materia->listar_materia();
		echo json_encode($r);
	}
	public function agregar_datos()
	{
		$nombre = $this->input->post('nombre');
		$curso_id = $this->input->post('curso_id');
		$profesor_id = $this->input->post('profesor_id');
		$data = array(
			'nombre' => $nombre, 
			'estado' => 1, 
			'curso_id' => $curso_id, 
			'profesor_id' => $profesor_id, 
		);
		$this->model_materia->agregar_datos($data);
	}
	public function modificar_materia()
	{
		$id = $this->input->post('id');
		$nombre = $this->input->post('nombre');
		$curso_id = $this->input->post('curso_id');
		$data = array(
			'nombre' => $nombre, 
			'curso_id' => $curso_id
		);
		$this->model_materia->modificar_materia($id,$data);
	}
	public function buscar_materia()
	{
		$id = $this->input->post('id');
		$r = $this->model_materia->buscar_materia($id);
		echo json_encode($r);
	}
}
