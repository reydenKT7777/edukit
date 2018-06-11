<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Controlador_prueba extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//$this->load->model('model_asistencia');
		$this->load->model('model_prueba');
		$this->load->model('model_curso');
	}
	public function index()
	{
		
	}
	
	public function porcentaje_asistencia()
	{
		$id = $this->input->get('id');
		$fecha=date("y-m-d");
		$asistente = $this->model_prueba->asistentes($id,$fecha);
		$ausente = $this->model_prueba->ausentes($id,$fecha);
		$cant = $this->model_prueba->cont_estudiantes($id,$fecha);
		
		foreach ($asistente as $row) {
			$as = $row->asistente;
		}
		foreach ($cant as $row) {
			$co = $row->estudiantes;
		}
		foreach ($ausente as $row) {
			$au = $row->ausente;
		}
		
		// $porcentaje_asistentes=($as * 100)/$co;
		// $porcentaje_ausentes=($au * 100)/$co;

		// $porcentaje = array(
		// 					'asistentes' => $porcentaje_asistentes,
		// 					'ausente' => $porcentaje_ausentes
		// 					);

		echo json_encode($co);
	}

	public function listar_cursos()
	{
		$r = $this->model_curso->listar_curso_por_estado();
		//+++++++
		
		foreach ($r as $row) {
			$id = $row->id;
			$as=0;
			$co=0;
			$fecha=date("y-m-d");
			$asistente = $this->model_prueba->asistentes($id,$fecha);
			$cant = $this->model_prueba->cont_estudiantes($id,$fecha);

			foreach ($asistente as $ro) {
				$as = $ro->asistente;
			}
			foreach ($cant as $ro) {
				$co = $ro->estudiantes;
			}
			echo json_encode($as);
			//$porcentaje_asistentes=($as * 100)/$co;

			$data[] = array(
						'curso_id' =>$id,
						'grado' =>$row->grado,
						'nivel' =>$row->nivel,
						'paralelo' => $row->paralelo
					);

		}



		 //echo json_encode($data);
	}

	
}
