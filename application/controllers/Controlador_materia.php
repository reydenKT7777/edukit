<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Controlador_materia extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_materia');
		$this->load->library('form_validation');
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
		$materia = $this->input->post('materia');
		$curso = $this->input->post('curso');
		$color = $this->input->post('in_color_hex');
		// $profesor_id = $this->session->persona_id;
		$this->form_validation->set_rules('materia', 'nombre', 'required');
		$this->form_validation->set_rules('curso', 'curso', 'required');


		$verifica = false;
		if($this->model_materia->verifica_materia_rep($materia,$curso) == 0)
		{
			
			if($this->form_validation->run() == TRUE)
			{
				$data = array(
					'nombre' => $materia,
					'color_hex' => $color,
					'estado'=>1,
					'curso_id' => $curso, 
					'profesor_id' => $this->session->id_profesor 
				);
				$this->model_materia->agregar_datos($data);
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
		}else{
			$data = array( $verifica , "Existente");
		}

		
		echo json_encode($data);
	}
	public function buscar_materia()
	{
		$id = $this->input->post('id');
		$r = $this->model_materia->buscar_materia($id);
		echo json_encode($r);
	}
	public function listar_materia_prof()
	{
		$idd = $this->session->persona_id;
		$rol = $this->session->rol;
		$r = $this->model_materia->listar_materia_prof($idd);
		echo json_encode($r);
	}
	public function modificar_materia()
	{
		$id = $this->input->post('id_materia2');
		$materia = $this->input->post('materia2');
		$color = $this->input->post('color_hex2');
		$curso = $this->input->post('curso2');

		$dat = array(
				'nombre' => $materia,
				'color_hex' => $color,
				'curso_id' => $curso
			);
		$verifica = false;
		if($this->model_materia->verifica_materia_rep($materia,$curso) == 0 )
		{
			$this->model_materia->modificar_materia($id,$dat);

			$verifica = true;

			$resp  = array($verifica);

		}else{
			$resp  = array($verifica , "Existente");
		}









		




		echo json_encode($resp);
		
	}
	public function eliminar_datos()
	{

		$id = $this->input->post('id_materia');
		$data = array('estado' => 0);
		$r = $this->model_materia->modificar_materia_r($id,$data);
		echo json_encode($r);
	}




}
