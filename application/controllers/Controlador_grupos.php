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
		$idd = $this->session->persona_id;
		$rol = $this->session->rol;
		if ($rol==1 or $rol==2) {
			$r = $this->Model_grupos->lista_top_grupo($rol,$idd);
		}elseif ($rol==3 or $rol==4) {
			$r = $this->Model_grupos->lista_top_grupov2($rol,$idd);
		}
		echo json_encode($r);
	}
}