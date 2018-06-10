<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Controlador_administracion extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_administracion');
		$this->load->model('model_usuario');
		$this->load->model('model_persona');
		$this->load->library('form_validation');
	}
	public function listar_administracion()
	{
		$r = $this->model_administracion->listar_administracion();
		echo json_encode($r);
	}
	public function listar_administracion_baja()
	{
		$r = $this->model_administracion->listar_administracion_baja();
		echo json_encode($r);
	}
	public function agregar_datos()
	{
		$usr = $this->input->post('usuario');
		if($this->Model_administracion->buscar_administracionV2($usr) == 0)
		{
			$user = $this->input->post('usuario');
			$pass = $this->input->post('password');
			$correo = $this->input->post('correo');
			$foto = $this->input->post('foto');
			$sexo = $this->input->post('sexo');

			$a_paterno = $this->input->post('a_paterno');
			$a_materno = $this->input->post('a_materno');
			$nombres = $this->input->post('nombres');
			$ci = $this->input->post('ci');
			$exp = $this->input->post('exp');

			$telf = $this->input->post('telefono');
			$telf_opc = $this->input->post('telefono_op');
			$direccion = $this->input->post('direccion');
			$f_nacimiento = $this->input->post('fecha');

			$cargo = $this->input->post('cargo');

			$this->form_validation->set_rules('usuario', 'Usuario', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('correo', 'Correo', 'required');
			$this->form_validation->set_rules('sexo', 'Sexo', 'required');
			$this->form_validation->set_rules('a_paterno', 'Paterno', 'required');
			$this->form_validation->set_rules('a_paterno', 'Materno', 'required');
			$this->form_validation->set_rules('nombres', 'Nombres', 'required');
			$this->form_validation->set_rules('ci', 'CI', 'required|numeric');
			$this->form_validation->set_rules('exp', 'Expedido', 'required');
			$this->form_validation->set_rules('telefono', 'Telefono', 'required');
			$this->form_validation->set_rules('direccion', 'Dirección', 'required');
			$this->form_validation->set_rules('fecha', 'Fecha', 'required');
			$this->form_validation->set_rules('cargo', 'Cargo', 'required');
			$verifica = false;
			//$validaUser = $this->model_usuario->valida($usuario);
			if($this->form_validation->run() == TRUE)
			{
					if ($sexo == "M") {
						$nombreFoto = "assets/images/avatar/hombre.png";
					}
					if ($sexo == "F") {
						$nombreFoto = "assets/images/avatar/mujer.png";
					}
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
						'nombre_usuario' => $user,
						'contrasena' => sha1($pass),
						'f_modificacion' => date('Y-m-d'),
						'activacion_cuenta' => 1,
						'correo_electronico' => $correo,
						'foto_perfil' => $nombreFoto,
						'sesion' => 0,
						'rol' => 1,
						'estado' =>1
					 );
					$id_usuario = $this->model_usuario->agregar_datos($usuario);
					$dataPersona = array(
						'a_paterno' => $a_paterno,
						'a_materno' => $a_materno,
						'nombres' => $nombres,
						'ci' => $ci,
						'exp' => $exp,
						'sexo' => $sexo,
						'telf' => $telf,
						'telf_opc' => $telf_opc,
						'direccion' => $direccion,
						'f_nacimiento' => $f_nacimiento,
						'estado' => 1,
						'usuario_id' => $id_usuario,
					);
					$id_persona = $this->model_persona->agregar_datos($dataPersona);
					$data = array(
						'cargo' => $cargo,
						'persona_id' => $id_persona,
					);
					$this->model_administracion->agregar_datos($data);
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
		else {
			$data = array( $verifica , "El nombre de usuario ya existe, porfavor intente con otro usuario");
			echo json_encode($data);
		}
	}
	public function modificar_administracion()
	{
		$id = $this->input->post('id_persona');
		$consulta = $this->model_persona->IDadminfPersonaUser($id);
		foreach ($consulta as $row) {
			$id_usuario = $row->id_usuario;
			$id_persona = $row->id_persona;
			$id_admin = $row->id_admin;
			$foto_perfil = $row->foto_perfil;
		}
		////////////////////////////////////
		$user = $this->input->post('usuario');

		$correo = $this->input->post('correo');
		$foto = $this->input->post('foto');
		$sexo = $this->input->post('sexo');

		$a_paterno = $this->input->post('a_paterno');
		$a_materno = $this->input->post('a_materno');
		$nombres = $this->input->post('nombres');
		$ci = $this->input->post('ci');
		$exp = $this->input->post('exp');

		$telf = $this->input->post('telefono');
		$telf_opc = $this->input->post('telefono_op');
		$direccion = $this->input->post('direccion');
		$f_nacimiento = $this->input->post('fecha');

		$cargo = $this->input->post('cargo');

		$this->form_validation->set_rules('usuario', 'Usuario', 'required');
		//$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('correo', 'Correo', 'required');
		$this->form_validation->set_rules('sexo', 'Sexo', 'required');
		$this->form_validation->set_rules('a_paterno', 'Paterno', 'required');
		$this->form_validation->set_rules('a_paterno', 'Materno', 'required');
		$this->form_validation->set_rules('nombres', 'Nombres', 'required');
		$this->form_validation->set_rules('ci', 'CI', 'required|numeric');
		$this->form_validation->set_rules('exp', 'Expedido', 'required');
		$this->form_validation->set_rules('telefono', 'Telefono', 'required');
		$this->form_validation->set_rules('direccion', 'Dirección', 'required');
		$this->form_validation->set_rules('fecha', 'Fecha', 'required');
		$this->form_validation->set_rules('cargo', 'cargo', 'required');
		////////////////////////////////////
		$verifica = false;
		if($this->form_validation->run() == TRUE)
		{
				$nombreFoto = $foto_perfil;
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
					if ($_POST["password"] != "") {
						$pass = $this->input->post('password');
						$usuario = array(
							'nombre_usuario' => $user,
							'contrasena' => sha1($pass),
							'f_modificacion' => date('Y-m-d'),
							'activacion_cuenta' => 1,
							'correo_electronico' => $correo,
							'foto_perfil' => $nombreFoto,
							'sesion' => 0,
							'rol' => 1,
							'estado' =>1
						 );
					}else{
						$usuario = array(
							'nombre_usuario' => $user,
							//'contrasena' => sha1($pass),
							'f_modificacion' => date('Y-m-d'),
							'activacion_cuenta' => 1,
							'correo_electronico' => $correo,
							'foto_perfil' => $nombreFoto,
							'sesion' => 0,
							'rol' => 1,
							'estado' =>1
						 );
					}

				$this->model_usuario->modificar_usuario($id_usuario,$usuario);
				$dataPersona = array(
					'a_paterno' => $a_paterno,
					'a_materno' => $a_materno,
					'nombres' => $nombres,
					'ci' => $ci,
					'exp' => $exp,
					'sexo' => $sexo,
					'telf' => $telf,
					'telf_opc' => $telf_opc,
					'direccion' => $direccion,
					'f_nacimiento' => $f_nacimiento,
					'estado' => 1,
					//'usuario_id' => $id_usuario,
				);
				$this->model_persona->modificar_persona($id_persona,$dataPersona);

				$cargo = $this->input->post('cargo');
				$data = array(
					'cargo' => $cargo,
				);
				$this->model_administracion->modificar_administracion($id_admin,$data);
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
		if (validation_errors()) {
			$data = array( $verifica , "Verifica los campos ,".$campos);
		}
		else {
			$data = array( $verifica , "");
		}
		echo json_encode($data);
	}
	public function buscar_administracion()
	{
		$id = $this->input->post('id');
		$r = $this->model_administracion->buscar_administracion($id);
		echo json_encode($r);
	}
	public function eliminar_datos()
	{
		$id = $this->input->post('id_persona');
		$consulta = $this->model_persona->IDadminfPersonaUser($id);
		foreach ($consulta as $row) {
			$id_usuario = $row->id_usuario;
		}
		$usuario = array('estado' => 0 );
		$r = $this->model_usuario->modificar_usuario($id_usuario,$usuario);
		echo json_encode($r);
	}
	public function activar_datos()
	{
		$id = $this->input->post('id_persona');
		$consulta = $this->model_persona->IDadminfPersonaUser($id);
		foreach ($consulta as $row) {
			$id_usuario = $row->id_usuario;
		}
		$usuario = array('estado' => 1 );
		$r = $this->model_usuario->modificar_usuario($id_usuario,$usuario);
		echo json_encode($r);
	}
}
