<?php 
/**
* 
*/
class Controlador_grupos extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Model_grupos");
	}
	public function listar_top_grupos()
	{
		$id = $this->session->persona_id;
		$rol = $this->session->rol;

		$r = $this->Model_grupos->lista_top_grupo($rol);
		echo json_encode($r);
	}
}