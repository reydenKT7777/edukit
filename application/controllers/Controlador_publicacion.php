<?php
/**
*
*/
class Controlador_publicacion extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_publicacion');
		$this->load->model('Model_me_gusta');
		$this->load->library('edate');
		$this->load->library('form_validation');
	}
	public function listar_publicacion()
	{
		$pag = $this->input->get("pag");
		if ($pag == "" || $pag == null) {
			$pag = 0;
		}
		$r = $this->Model_publicacion->listar_publicacion($pag);
		$data = array();
		foreach ($r as $row) {
			if ($row->meGustaPersonal == 0) {
				$meGustaPersonal = false;
			}
			else {
				$meGustaPersonal = true;
			}
			$data[]= array(
									'foto_perfil' => $row->foto_perfil,
									'nombres' => $row->nombres,
									'fecha' => $this->edate->obtenerFechaEnLetra($row->fecha),
									'contenido' => $row->contenido,
									'src_adj' => $row->src_adj,
									'formato_adj' => $row->formato_adj,
									'nombre_adj' => $row->nombre_adj,
									'tipo_adj' => $row->tipo_adj,
									'noticia_id' => $row->noticia_id,
									'persona_id' => $row->persona_id,
									'meGusta' => $row->meGusta,
									'meGustaPersonal' => $meGustaPersonal
								 );
		}
		echo json_encode($data);
	}
	public function modificaMeGusta()
	{
		$id_noticia = $this->input->get("nid");
		$resultado = $this->Model_publicacion->verificarMegustaPersonal($id_noticia);
		if ($resultado == null) {
			$data = array(
										'persona_id' => $this->session->persona_id,
										'ref_publicacion' => $id_noticia,
										'fecha' => date("Y-m-d")." ".date("h:i:s")
									);
			$this->Model_me_gusta->agregar_datos($data);
			$very = true;
		}
		else {
			$this->Model_me_gusta->eliminar_datos($resultado->id_meGusta);
			$very = false;
		}
		$dt  = array($very);
		echo json_encode($dt);
	}
	public function me_gusta_noticia()
	{
		$id_noticia = $this->input->get("nid");
		$r = $this->Model_me_gusta->me_gusta_noticia($id_noticia);
		$data = array();
		$c = 0;
		foreach ($r as $row) {
			if ($row->rol == 1) {
				$rol = "Administrador";
			}
			if ($row->rol == 2) {
				$rol = "Docente";
			}
			if ($row->rol == 3) {
				$rol = "Estudiante";
			}
			if ($row->rol == 4) {
				$rol = "Tutor";
			}
			$data[] = array(
											'nombres' => $row->nombres,
											'foto_perfil' => $row->foto_perfil,
											'rol' => $rol,
											'persona_id' => $row->persona_id
										);
			$c++;
		}
		$dt = array($data ,$c);
		echo json_encode($dt);
	}
	
	public function agregar_datos(){
		$this->load->helper('file');
		$contenido = $this->input->post('contenido');
		$this->form_validation->set_rules('contenido', 'Contenido', 'required');
		$verifica = false;

		if ($this->form_validation->run() == TRUE) {

			

			if ($_FILES['adjunto']['name'] != "") {

				$config['upload_path']   = 'assets\document\file';
                $config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx|xls|xlsx';
                $config['max_size']      = 5000;
                $this->load->library('upload', $config);
                
                if($this->upload->do_upload('file')){
                    $uploadData = $this->upload->data();
                    $uploadedFile = $uploadData['file_name'];
                    
                    $data = array(
						'contenido' => $contenido,
						'fecha' => date('Y-m-d'),
						'src_adj' => $uploadedFile,
						'estado' =>1,
						'persona-id' =>$this->session->id_administracion
				 	);
					$this->Model_publicacion->agregar_datos($data);
					$verifica = true;
                }else{
                    $verifica = false;
                }

				
			}





			
		}
		// $contenido = $this->input->post('contenido');
		


	}

}
