<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Controlador_curso extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_curso');
	}
	public function index()
	{
		$this->load->view('curso_view');
	}
	public function listar_curso()
	{
		$r = $this->model_curso->listar_curso();
		echo json_encode($r);
	}
	public function listar_curso_completo()
	{
		$r = $this->model_curso->listar_curso_completo();
		echo json_encode($r);
	}
	public function agregar_datos()
	{
		$json_msg=file_get_contents('php://input');
		$data=json_decode($json_msg);
		$grado= $data->grado;
		$nivel= $data->nivel;
		$paralelo = $data->paralelo;
		$data = array(
						'grado' => $grado,
						'nivel' => $nivel,
						'paralelo' => $paralelo,
						'estado' => 1,
					);
		$this->model_curso->agregar_datos($data);
		$verifica = true;
		$data = array($verifica);
		//return $verifica;
		//$grado = $this->input->post('grado');
		//$nivel = $this->input->post('nivel');
		//$paralelo = $this->input->post('paralelo');
		/*$this->form_validation->set_rules('grado', 'Grado', 'required');
		$this->form_validation->set_rules('nivel', 'Nivel', 'required');
		$this->form_validation->set_rules('paralelo', 'Paralelo', 'required');
		$verifica = false;
		if($this->form_validation->run() == TRUE)
		{
			$data = array(
						'grado' => $grado,
						'nivel' => $nivel,
						'paralelo' => $paralelo,
						'estado' => 1,
					);
			$this->model_curso->agregar_datos($data);
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
		}*/
		echo json_encode($data);
	}
	public function modificar_curso()
	{
		$json_msg=file_get_contents('php://input');
		$data=json_decode($json_msg);
		$id = $data->id;//$this->input->post('id');
		$grado = $data->grado;
		$id = $data->id;
		$nivel = $data->nivel;
		$paralelo = $data->paralelo;
		$estado = $data->estado;
		$dat = array(
				'estado' => $estado,
				'nivel' => $nivel,
				'paralelo' => $paralelo,
				'estado' => $estado
			);
			$this->model_curso->modificar_curso($id,$dat);
			$verifica = true;
		$resp  = array($verifica);
		/*$grado = $this->input->post('grado');
		$nivel = $this->input->post('nivel');
		$paralelo = $this->input->post('paralelo');
		$this->form_validation->set_rules('grado', 'Grado', 'required');
		$this->form_validation->set_rules('nivel', 'Nivel', 'required');
		$this->form_validation->set_rules('paralelo', 'Paralelo', 'required');
		$verifica = false;
		if($this->form_validation->run() == TRUE)
		{
			$data = array(
				'grado' => $grado,
				'nivel' => $nivel,
				'paralelo' => $paralelo,
				'estado' => $estado,
			);
			$this->model_curso->modificar_curso($id,$data);
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
		}*/
		echo json_encode($resp);
	}
	public function buscar_curso()
	{
		$id = $this->input->post('id');
		$r = $this->model_curso->buscar_curso($id);
		echo json_encode($r);
	}
	public function eliminar_datos()
	{
		$id = $this->input->post('id');
		$data = array('estado' => 0);
		$this->model_curso->modificar_curso($id,$data);
	}
	public function cursos_disponibles()
	{
		$r = $this->model_curso->listar_curso_completo();
		$data = $this->buscar_cursos($r);
		echo json_encode($data);
	}
	public function buscar_cursos($cursos)
	{
		$lista_grado = array('1','2','3','4','5','6');//ṕara añadir o quitar mas grados
		$lista_paralelos = array('A','B'/*,'C','D'*/); //Para añadir o quitar mas paralelos
		$lista_nivel = array('Secundaria'/*,'Primaria'*/); // Para añadir o quitar mas paralelos
		$veryG = false;
		$veryP = false;
		$veryN = false;
		$c = 0;
		$data = array();
			for ($i=0; $i < count($lista_nivel) ; $i++) {
				for ($j=0; $j < count($lista_grado) ; $j++) {
					for ($k=0; $k < count($lista_paralelos); $k++) {
							$data[] = array('grado' => $lista_grado[$j], 'paralelo' => $lista_paralelos[$k], 'nivel' => $lista_nivel[$i],'estado' => true);
					}
				}
			}
			$c = 0;
			for ($i=0; $i < count($data) ; $i++) {
				foreach ($cursos as $row) {
					if ($row->grado == $data[$i]['grado'] && $row->paralelo == $data[$i]['paralelo'] && $row->nivel == $data[$i]['nivel']) {
						$c++;
					}
				}
				if ($c == 0) {
				$dat[] = array('grado' => $data[$i]['grado'], 'paralelo' => $data[$i]['paralelo'],'nivel'=>$data[$i]['nivel'],'estado' => true);
				}
				$c=0;
			}
		return $dat;
	}

}
