<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Controlador_calificacion extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_calificacion');
		$this->load->library('form_validation');
	}
	public function index()
	{

	}
	public function listar_materia()
	{
		$r = $this->model_calificacion->listar_materia();
		echo json_encode($r);
	}
	public function notas()
    {
        $id = $this->input->get('id');
        $prof = $this->session->id_profesor;

        $bloque = $this->model_calificacion->bloques($id,$prof);

        echo json_encode($bloque);
    }
	public function bloque_notas()
	{
		// $json_msg=file_get_contents('php://input');
		// $data=json_decode($json_msg);
		// $x=count($data);


		$id = $this->input->get('id');
		$prof = $this->session->id_profesor;

		$r = $this->model_calificacion->est_materia($id,$prof);

		foreach ($r as $row) {
			$id_estudiante = $row->id;
			$nombres = $row->nombres;

			$not = $this->model_calificacion->nota_est($id,$prof,$id_estudiante);
			foreach ($not as $ro) {
				$onta = $ro->ini;
			}
			$tabl= $this->model_calificacion->tabla_nota($id,$prof,$id_estudiante,$onta);
			$cont = $this->model_calificacion->contador($id,$prof);
			// $cont = $this->model_calificacion->contador($id,$prof,$id_estudiante);
			foreach ($tabl as $ro) {
				$data[] = array(
						$ro,$cont
					);
			}

		}
		echo json_encode($data);
	}
	public function notassss()
	{
		$id = $this->input->get('id');
		$prof = $this->session->id_profesor;
		$bloques = $this->model_calificacion->bloques($id,$prof);
		$notas = $this->model_calificacion->notas($id,$prof);
		$ids = $this->model_calificacion->id_estudiantes($id,$prof);
		$data = array();
		$nbloque = count($bloques);
		foreach ($bloques as $bl) {
			foreach ($ids as $est) {
				foreach ($notas as $not) {
					if ($est->id_estudiante == $not->id && $not->bloque == $bl->bloque) {
						
					}
				}
			}
		}
		echo json_encode($data);
	}


}









			// foreach ($not as $roww) {
			// 	$mo = $roww->nota;
			// 	for($i=1; $i <= $cont; $i++){
			// 		$data[] = array(
			// 			'mo_'.$i => $mo
			// 		);
			// 	}
			// }




// $data[] = array(



// 				);







// foreach ($not as $roww) {
// 				$mo = $roww->nota;
// 					for($i=1; $i <= $cont; $i++){
// 							$list = array(
// 								'mo_'.$i => $mo
// 							);

// 					}
// 				$list = array(
// 					'cont' => $cont
// 				);
// 			}
