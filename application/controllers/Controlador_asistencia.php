<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Controlador_asistencia extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//$this->load->model('model_asistencia');
		$this->load->model('model_curso');
		$this->load->model('model_estudiante');
	}
	public function index()
	{
		
	}
	
	public function listar_cursos()
	{
		$r = $this->model_curso->listar_curso_por_estado();

		echo json_encode($r);
	}

	public function listar_asistencia_estudiantes_curso(){
		
		$id = $this->input->get('id');

		$data=array();

		$r = $this->model_estudiante->buscar_asistencia_estudiantes_curso($id);
		$ainicial=1;
		$obs="";
		foreach ($r as $row) {
			$data[] = array(
						'foto_perfil'=>$row->foto_perfil,
						'nombre_completo' =>$row->nombre_completo,
						'tipo_asistencia' =>$ainicial,
						'observacion' =>$obs
					);
		}
		echo json_encode($data);
	}
}
