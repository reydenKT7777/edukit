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
	
				if($_FILES['adjunto']['name'] != "")
						{
							$user = $this->session->id_usuario;
							$file = $_FILES["adjunto"];
							$carpetaAdjunta="C:/wamp64/www/1/assets/document/file/";

							if (!(file_exists($carpetaAdjunta))) {

							    $carpetaAdjunta="assets/document/file/";
							}

							// El nombre y nombre temporal del archivo que vamos para adjuntar
							$tipo = "";
							$formato =0;
							
							if ($file["type"] == "image/jpeg" || $file["type"] == "image/jpg") {
								$tipo = "jpg";
								$formato=1;
							}elseif ($file["type"] == "image/png") {
								$tipo = "png";
								$formato=1;
							}elseif ($file["type"] == "application/pdf") {
								$tipo = "pdf";
								$formato=2;
							}elseif ($file["type"] == "application/doc" || $file["type"] == "application/docx" || $file["type"] ==  "application/vnd.openxmlformats-officedocument.wordprocessingml.document") {
								$tipo = "doc";
								$formato=2;
							}elseif ($file["type"] == "application/xls" || $file["type"] == "application/xlsx" || $file["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") {
								$tipo = "xls";
								$formato=2;
							}
							$nombreArchivo=date("Y").date("m").date("d").$user.$file["name"];
							$nombreTemporal=$file["tmp_name"];
							//$nombreArchivo
							$rutaArchivo=$carpetaAdjunta.$nombreArchivo;
							move_uploaded_file($nombreTemporal,$rutaArchivo);
							$nombreFoto = "assets/document/file/".$nombreArchivo;
							$data = array(
									'contenido' => $contenido,
									'fecha' => date('Y-m-d H:i:s'),
									'src_adj' => $nombreFoto,
									'tipo_adJ'=>$formato,	
									'formato_adj'=>$tipo,
									'nombre_adj'=>$file["name"],
									'ref_visualizacion'=>"ng",	
									'estado' =>1,
									'persona_id' =>$this->session->persona_id
							 	);
							$id_publicacion = $this->Model_publicacion->agregar_datos($data);

							$r = $this->Model_publicacion->verMiPublicacion($id_publicacion);
							foreach ($r as $row) {
								$dataPublicacion = array(
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
									'meGusta' => 0,
									'meGustaPersonal' => 0
								 );
							}
							$verifica = true;
							$dataP = array($verifica,$dataPublicacion);
			                echo json_encode($dataP);
						}
						else{
							$formato=3;
							$data = array(
									'contenido' => $contenido,
									'fecha' => date('Y-m-d H:i:s'),
									//'src_adj' => $nombreFoto,
									'tipo_adJ'=>$formato,	
									//'formato_adj'=>$tipo,
									//'nombre_adj'=>$file["name"],
									'ref_visualizacion'=>"ng",	
									'estado' =>1,
									'persona_id' =>$this->session->persona_id
							 	);
							$id_publicacion = $this->Model_publicacion->agregar_datos($data);

							$r = $this->Model_publicacion->verMiPublicacion($id_publicacion);
							foreach ($r as $row) {
								$dataPublicacion = array(
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
									'meGusta' => 0,
									'meGustaPersonal' => 0
								 );
							}
							$verifica = true;
							$dataP = array($verifica,$dataPublicacion);
			                echo json_encode($dataP);
						}
				
		}
		else{
			echo json_encode($verifica);
		}		

	}

}
