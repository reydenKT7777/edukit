<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Controlador_asistencia extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//$this->load->model('model_asistencia');
		$this->load->model('model_curso');
		$this->load->model('model_estudiante');
		$this->load->model('model_asistencia');
		
	}
	public function index()
	{
		
	}
	
	public function listar_cursos()
	{
		$r = $this->model_curso->listar_curso_por_estado();
		
		foreach ($r as $row) {

			$data[] = array(
						'id' =>$row->id,
						'grado' =>$row->grado,
						'nivel' =>$row->nivel,
						'paralelo' => $row->paralelo
					);

		}
		echo json_encode($data);
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
						'tipo_asistencia' =>$row->tipo_asistencia,
						'asistencia_id' => $row->asistencia_id,
						'estudiante_id' => $row->estudiante_id,
						'curso_id' => $row->curso_id,
						'observacion' => $row->observacion
					);
		}
		echo json_encode($data);
	}
	public function asistencias_retrasos()
	{
		$id_estudiante = $this->input->get("id");
		$asistencia = $this->input->get("tipo_asistencia");
		if ($this->model_asistencia->buscar_asistencias(date("y-m-d")) == 0) {
			$lista_estudiantes = $this->model_asistencia->lista_es(date("Y"));
			foreach ($lista_estudiantes as $row) {
				$asistencia = array('fecha' => date("Y-m-d"),
									'tipo_asistencia' => '1',
									'observacion' => '',
									'estudiante_id' => $row->estudiante_id,
									'estado' => 0,
									'id_responsable' =>$this->session->persona_id,
									'rol_responsable' => $this->session->rol,
									'curso_id' => $row->curso_id
									);
				$this->model_asistencia->agregar_datos($asistencia);
			}
			$data = array(true);
			echo json_encode($data);
		}
		else{
			$data = array(false);
			echo json_encode($data);
		}

	}
	public function mis_registros_asistencia()
	{
		$very = true;
		if ($this->model_asistencia->lista_es_prof(date("Y-m-d")) == 0) {
			$very = false;
		}
		$data = array($very);
		echo json_encode($data);
	}
	public function guardar_asistencia()
	{
		$json_msg=file_get_contents('php://input');
		$post=json_decode($json_msg);
		for ($i=0; $i <count($post) ; $i++) { 
			$data = array(
							'tipo_asistencia' => $post[$i]->tipo_asistencia,
							'observacion' => $post[$i]->observacion,
							'estado' => 1
						 );
			$this->model_asistencia->modificar_asistencia($post[$i]->asistencia_id,$data);
		}
		$res = array(true);
		echo json_encode($res);
	}
	public function guardar_asistencia_individual()
	{
		$json_msg=file_get_contents('php://input');
		$post=json_decode($json_msg);
		$data = array(
						'tipo_asistencia' => $post->tipo_asistencia,
						'observacion' => $post->observacion,
						'estado' => 1
					 );
		$this->model_asistencia->modificar_asistencia($post->asistencia_id,$data);
		$mensaje = array(true);
		echo json_encode($mensaje);
	}
	public function asistencia_individual()
	{
		$id_estudiante = $this->input->get("id_estudiante");
		if ($this->model_asistencia->buscar_asistencias(date("y-m-d")) == 0) {
			$lista_estudiantes = $this->model_asistencia->lista_es(date("Y"));
			foreach ($lista_estudiantes as $row) {
				$asistencia = array('fecha' => date("Y-m-d"),
									'tipo_asistencia' => '1',
									'observacion' => '',
									'estudiante_id' => $row->estudiante_id,
									'estado' => 0,
									'id_responsable' =>$this->session->persona_id,
									'rol_responsable' => $this->session->rol,
									'curso_id' => $row->curso_id
									);
				$this->model_asistencia->agregar_datos($asistencia);
			}
			$r = $this->model_asistencia->buscar_asistencia_estudiante($id_estudiante);
			$data = array($r);
			echo json_encode($data);
		}
		else{
			$r = $this->model_asistencia->buscar_asistencia_estudiante($id_estudiante);
			$data = array($r);
			echo json_encode($data);
		}
	}
}
