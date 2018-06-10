<?php 
/**
* 
*/
class Contador extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_contador');
	}
	public function contar_profesor()
	{
		$r = $this->Model_contador->contar_profesor();
		echo json_encode(array($r[0]->total_p));
	}
}
