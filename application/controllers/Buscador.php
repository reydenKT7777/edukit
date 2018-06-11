<?php
/**
*
*/
class Buscador extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Buscador_model');
		$this->load->model('model_tutor');
	}
	public function buscar_profesor()
	{
		$profesor = $this->input->get("textob");
		$r = $this->Buscador_model->buscar_profesor($profesor);
		echo json_encode($r);
	}
	public function buscar_tutor()
	{
		$json_msg=file_get_contents('php://input');
		$data=json_decode($json_msg);
		$ci_tutor=$data->ci;
		//$ci = json_decode($this->input->post("ci"));
		$r = $this->Buscador_model->buscar_tutor($ci_tutor);
		$t = $this->model_tutor->buscar_tutor($ci_tutor);
		if ($t != false) {
			$data = array(true,$t, $r);
		}
		else{
			$data = array(false , "");
		}
		echo json_encode($data);
	}
	public function buscar_estudiante()
	{
		$estudiante = $this->input->get("textob");
		$r = $this->Buscador_model->buscar_estudiante($estudiante);
		echo json_encode($r);
	}
}
