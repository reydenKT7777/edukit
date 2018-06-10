<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Controlador_disciplina_docente extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_disciplina_docente');
		$this->load->library('form_validation');
	}
	public function index()
	{
		$this->load->view('disciplina_docente_view');
	}
	public function listar_disciplina_docente()
	{
		$this->load->library('edate');

		$r = $this->model_disciplina_docente->listar_disciplina_docente();
		$data = array();
		$index = 0;
		foreach ($r as $row) {
			$data[] = array('foto_perfil' =>$row->foto_perfil ,
							'a_paterno' => $row->a_paterno,
							'a_materno' => $row->a_materno,
							'nombres' => $row->nombres,
							'descripcion' => $row->descripcion,
							'fecha' =>$this->edate->obtenerFecha($row->fecha)
							 );
		}
		echo json_encode($data);
	}
	
	public function agregar_datos()
	{
		//$fecha = $this->input->post('fecha');
		$descripcion = $this->input->post('descripcion');
		//$estado = $this->input->post('estado');
		$profesor_id = $this->input->post('profesor_id');
		//$administracion_id = $this->input->post('administracion_id');
		//$this->form_validation->set_rules('fecha', 'Fecha', 'required');
		$this->form_validation->set_rules('descripcion', 'Descripcion', 'required');
		$this->form_validation->set_rules('profesor_id', 'Profesor', 'required');
		$verifica = false;
		if($this->form_validation->run() == TRUE)
		{
			$data = array(
				'fecha' => date("Y-m-d"), 
				'descripcion' => $descripcion, 
				'estado' => 1, 
				'profesor_id' => $profesor_id, 
				'administracion_id' => $this->session->id_administracion
			);
			$this->model_disciplina_docente->agregar_datos($data);
			$verifica = true;
		}
		else{
			$verifica = false;
		}
		$errores = validation_errors();
		$er = array();
		$index = 0;
		$Err = "";
		$campos = "";
		$listaEr = explode("<p>The", $errores);
		for ($i=1; $i < count($listaEr); $i++) {
			$Err = $listaEr[$i];
			$aux = explode(" ", $Err);
			$s = $aux[1];
			$campos = $campos." ".$s;
		}
		if (validation_errors()) {
			$data = array( $verifica , "Verifica los campos ,".$campos);
		}
		else {
			$data = array( $verifica , "");
		}
		echo json_encode($data);

	}
	public function modificar_disciplina_docente()
	{
		$id = $this->input->post('id');
		$fecha = $this->input->post('fecha');
		$descripcion = $this->input->post('descripcion');
		$estado = $this->input->post('estado');
		$profesor_id = $this->input->post('profesor_id');
		//$administracion_id = $this->input->post('administracion_id');
		$data = array(
			'fecha' => $fecha, 
			'descripcion' => $descripcion, 
			'estado' => $estado, 
			'profesor_id' => $profesor_id, 
			//'administracion_id' => $administracion_id, 
		);
		$this->model_disciplina_docente->modificar_disciplina_docente($id,$data);
	}
	public function buscar_disciplina_docente()
	{
		$id = $this->input->post('id');
		$r = $this->model_disciplina_docente->buscar_disciplina_docente($id);
		echo json_encode($r);
	}
	public function eliminar_datos()
	{
		$id = $this->input->post('id');
		$r = $this->model_disciplina_docente->eliminar_datos($id);
	}
}
