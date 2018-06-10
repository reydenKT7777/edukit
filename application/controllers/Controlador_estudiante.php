<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Controlador_estudiante extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_usuario');
		$this->load->model('model_persona');
		$this->load->model('model_estudiante');
		$this->load->model('model_inscripcion');
		$this->load->library('form_validation');
	}
	public function index()
	{
		$this->load->view('estudiante_view');
	}
	public function listar_estudiante()
	{
		$r = $this->model_estudiante->listar_estudiante();
		echo json_encode($r);
	}
	public function agregar_datos()
	{
		//$user = $this->input->post('usuario');
		//$pass = $this->input->post('password');
		//$correo = $this->input->post('correo');
		$foto = $this->input->post('foto');
		//$sexo = $this->input->post('sexo');

		$a_paterno = $this->input->post('a_paterno');
		$a_materno = $this->input->post('a_materno');
		$nombres = $this->input->post('nombres');
		$ci = $this->input->post('ci');
		$exp = $this->input->post('exp');

		$telf = $this->input->post('telefono');
		$telf_opc = $this->input->post('telefono_op');
		//$direccion = $this->input->post('direccion');
		//$f_nacimiento = $this->input->post('fecha');


		//$this->form_validation->set_rules('usuario', 'Usuario', 'required');
		//$this->form_validation->set_rules('password', 'Password', 'required');
		//$this->form_validation->set_rules('correo', 'Correo', 'required');
		//$this->form_validation->set_rules('sexo', 'Sexo', 'required');
		$this->form_validation->set_rules('a_paterno', 'Paterno', 'required');
		$this->form_validation->set_rules('a_paterno', 'Materno', 'required');
		$this->form_validation->set_rules('nombres', 'Nombres', 'required');
		$this->form_validation->set_rules('ci', 'CI', 'required|numeric');
		$this->form_validation->set_rules('exp', 'Expedido', 'required');
		//$this->form_validation->set_rules('telefono', 'Telefono', 'required');
		//$this->form_validation->set_rules('direccion', 'Dirección', 'required');
		///$this->form_validation->set_rules('fecha', 'Fecha', 'required');
		$this->form_validation->set_rules('asignar_curso', 'Curso', 'required');
		$verifica = false;
		//$validaUser = $this->model_usuario->valida($usuario);
		if($this->form_validation->run() == TRUE)
		{
				/*if ($sexo == "M") {
					$nombreFoto = "assets/images/avatar/hombre.png";
				}
				if ($sexo == "F") {
					$nombreFoto = "assets/images/avatar/mujer.png";
				}*/
				$nombreFoto = "assets/images/avatar/default.png";
				if($_FILES['foto']['name'] != "")
					{
						$file = $_FILES["foto"];
						$carpetaAdjunta="assets/images/avatar/";
						// El nombre y nombre temporal del archivo que vamos para adjuntar
						$tipo = "";
						if ($file["type"] == "image/jpeg" || $file["type"] == "image/jpg") {
							$tipo = ".jpg";
						}elseif ($file["type"] == "image/png") {
							$tipo = ".png";
						}
						$nombreArchivo=date("Y").date("m").date("d").$user.$tipo;
						$nombreTemporal=$file["tmp_name"];
						//$nombreArchivo
						$rutaArchivo=$carpetaAdjunta.$nombreArchivo;
						move_uploaded_file($nombreTemporal,$rutaArchivo);
						$nombreFoto = "assets/images/avatar/".$nombreArchivo;
					}
				$usuario = array(
					'nombre_usuario' => $ci,
					'contrasena' => sha1($ci),
					'f_modificacion' => date('Y-m-d'),
					'activacion_cuenta' => 1,
					'correo_electronico' => "",
					'foto_perfil' => $nombreFoto,
					'sesion' => 0,
					'rol' => 3,
					'estado' =>1
				 );
				$id_usuario = $this->model_usuario->agregar_datos($usuario);
				$dataPersona = array(
					'a_paterno' => $a_paterno,
					'a_materno' => $a_materno,
					'nombres' => $nombres,
					'ci' => $ci,
					'exp' => $exp,
					'sexo' => "",
					'telf' => $telf,
					'telf_opc' => $telf_opc,
					'direccion' => "",
					//'f_nacimiento' => "0000-00-00",
					'estado' => 1,
					'usuario_id' => $id_usuario,
				);
				$id_persona = $this->model_persona->agregar_datos($dataPersona);

				//$persona_id = $this->input->post('persona_id');
				$tutor_id = $this->input->post('tutor_id');
				$data = array(
					//'id' => $id,
					'persona_id' => $id_persona,
					'tutor_id' => $tutor_id,
				);
				$id_estudiante = $this->model_estudiante->agregar_datos($data);
				$curso_id = $this->input->post("asignar_curso");
				$inscripcion  = array('gestion' => date("Y"), 'curso_id' => $curso_id , 'estudiante_id' => $id_estudiante);
				$this->model_inscripcion->agregar_datos($inscripcion);

				$verifica = true;
		}
		else {
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
		$data = array( $verifica , "Verifica los campos ,".$campos);
		echo json_encode($data);
	}
	public function modificar_estudiante()
	{
		$id = $this->input->post("id_estudiante");
		$foto = $this->input->post('foto');
		//$sexo = $this->input->post('sexo');

		$a_paterno = $this->input->post('a_paterno');
		$a_materno = $this->input->post('a_materno');
		$nombres = $this->input->post('nombres');
		$ci = $this->input->post('ci');
		$exp = $this->input->post('exp');

		$telf = $this->input->post('telefono');
		$telf_opc = $this->input->post('telefono_op');
		//$direccion = $this->input->post('direccion');
		//$f_nacimiento = $this->input->post('fecha');


		//$this->form_validation->set_rules('usuario', 'Usuario', 'required');
		//$this->form_validation->set_rules('password', 'Password', 'required');
		//$this->form_validation->set_rules('correo', 'Correo', 'required');
		//$this->form_validation->set_rules('sexo', 'Sexo', 'required');
		$this->form_validation->set_rules('a_paterno', 'Paterno', 'required');
		$this->form_validation->set_rules('a_paterno', 'Materno', 'required');
		$this->form_validation->set_rules('nombres', 'Nombres', 'required');
		$this->form_validation->set_rules('ci', 'CI', 'required|numeric');
		$this->form_validation->set_rules('exp', 'Expedido', 'required');
		//$this->form_validation->set_rules('telefono', 'Telefono', 'required');
		//$this->form_validation->set_rules('direccion', 'Dirección', 'required');
		///$this->form_validation->set_rules('fecha', 'Fecha', 'required');
		$this->form_validation->set_rules('asignar_curso', 'Curso', 'required');
		$verifica = false;
		//$validaUser = $this->model_usuario->valida($usuario);
		if($this->form_validation->run() == TRUE)
		{
				/*if ($sexo == "M") {
					$nombreFoto = "assets/images/avatar/hombre.png";
				}
				if ($sexo == "F") {
					$nombreFoto = "assets/images/avatar/mujer.png";
				}*/
				$nombreFoto = "assets/images/avatar/default.png";
				if($_FILES['foto']['name'] != "")
					{
						$file = $_FILES["foto"];
						$carpetaAdjunta="assets/images/avatar/";
						// El nombre y nombre temporal del archivo que vamos para adjuntar
						$tipo = "";
						if ($file["type"] == "image/jpeg" || $file["type"] == "image/jpg") {
							$tipo = ".jpg";
						}elseif ($file["type"] == "image/png") {
							$tipo = ".png";
						}
						$nombreArchivo=date("Y").date("m").date("d").$user.$tipo;
						$nombreTemporal=$file["tmp_name"];
						//$nombreArchivo
						$rutaArchivo=$carpetaAdjunta.$nombreArchivo;
						move_uploaded_file($nombreTemporal,$rutaArchivo);
						$nombreFoto = "assets/images/avatar/".$nombreArchivo;
					}
				$usuario = array(
					'nombre_usuario' => $ci,
					'contrasena' => sha1($ci),
					'f_modificacion' => date('Y-m-d'),
					'activacion_cuenta' => 1,
					'correo_electronico' => "",
					'foto_perfil' => $nombreFoto,
					'sesion' => 0,
					'rol' => 3,
					'estado' =>1
				 );
				$id_usuario = $this->model_usuario->agregar_datos($usuario);
				$dataPersona = array(
					'a_paterno' => $a_paterno,
					'a_materno' => $a_materno,
					'nombres' => $nombres,
					'ci' => $ci,
					'exp' => $exp,
					'sexo' => "",
					'telf' => $telf,
					'telf_opc' => $telf_opc,
					'direccion' => "",
					//'f_nacimiento' => "0000-00-00",
					'estado' => 1,
					'usuario_id' => $id_usuario,
				);
				$id_persona = $this->model_persona->agregar_datos($dataPersona);

				//$persona_id = $this->input->post('persona_id');
				$tutor_id = $this->input->post('tutor_id');
				$data = array(
					//'id' => $id,
					'persona_id' => $id_persona,
					'tutor_id' => $tutor_id,
				);
				$id_estudiante = $this->model_estudiante->agregar_datos($data);
				$curso_id = $this->input->post("asignar_curso");
				$inscripcion  = array('gestion' => date("Y"), 'curso_id' => $curso_id , 'estudiante_id' => $id_estudiante);
				$this->model_inscripcion->agregar_datos($inscripcion);

				$verifica = true;
		}
		else {
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
		$data = array( $verifica , "Verifica los campos ,".$campos);
		echo json_encode($data);
	}
	public function modificar_inscripcion()
	{
		$json_msg=file_get_contents('php://input');
		$datos=json_decode($json_msg);
		for ($i=0; $i < count($datos) ; $i++) {
			$id_estudiante = $datos[$i]->id_estudiante;
			$id_curso = $datos[$i]->id_curso;
			$data = array(
				'curso_id' => $id_curso
			);
			$this->model_inscripcion->modificar_inscripcion($id_estudiante,$data);
		}
		$r = true;
		$data = array($r);
		echo json_encode($data);
	}
	public function buscar_estudiantes_curso()
	{
		$id = $this->input->get('curso');
		$r = $this->model_estudiante->buscar_estudiantes_curso($id);
		echo json_encode($r);
	}
	public function eliminar_datos()
	{
		$id = $this->input->post('id');
		$r = $this->model_estudiante->eliminar_datos($id);
	}
}
