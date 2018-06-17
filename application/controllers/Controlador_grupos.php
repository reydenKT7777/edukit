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
		$r = $this->Model_grupos->lista_top_grupo();
		echo json_encode($r);
	}
	public function contenido_grupo()
	{
		
	}
}