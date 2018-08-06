<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Controlador_profesor extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_usuario');
		$this->load->model('model_persona');
		$this->load->model('model_profesor');
		$this->load->library('form_validation');	
	}
	public function index()
	{
		$this->load->view('profesor_view');
	}
	public function listar_profesor()
	{
		$r = $this->model_profesor->listar_profesor();
		echo json_encode($r);
	}
	public function listar_profesor_baja()
	{
		$r = $this->model_profesor->listar_profesor_baja();
		echo json_encode($r);
	}
	public function agregar_datos()
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

		$especialidad = $this->input->post('especialidad');

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
		$this->form_validation->set_rules('especialidad', 'Especialidad', 'required');
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
					'rol' => 2,
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
					'especialidad' => $especialidad,
					'persona_id' => $id_persona,
				);
				$this->model_profesor->agregar_datos($data);
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
	public function modificar_profesor()
	{
		$id = $this->input->post('id_persona');
		$consulta = $this->model_persona->IDProffPersonaUser($id);
		foreach ($consulta as $row) {
			$id_usuario = $row->id_usuario;
			$id_persona = $row->id_persona;
			$id_profesor = $row->id_profesor;
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

		$especialidad = $this->input->post('especialidad');

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
		$this->form_validation->set_rules('especialidad', 'Especialidad', 'required');
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
							'rol' => 2,
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
							'rol' => 2,
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

				$especialidad = $this->input->post('especialidad');
				$data = array(
					'especialidad' => $especialidad,
				);
				$this->model_profesor->modificar_profesor($id_profesor,$data);
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
		////////////////////////////////////

	}
	public function buscar_profesor()
	{
		$id = $this->input->post('id');
		$r = $this->model_profesor->buscar_profesor($id);
		echo json_encode($r);
	}
	public function eliminar_datos()
	{
		$id = $this->input->post('id_persona');
		$consulta = $this->model_persona->IDProffPersonaUser($id);
		foreach ($consulta as $row) {
			$id_usuario = $row->id_usuario;
		}
		$usuario = array('estado' => 0 );
		$r = $this->model_usuario->modificar_usuario($id_usuario,$usuario);
		echo json_encode($r);
		//$r = $this->model_profesor->eliminar_datos($id);
	}
	public function activar_datos()
	{
		$id = $this->input->post('id_persona');
		$consulta = $this->model_persona->IDProffPersonaUser($id);
		foreach ($consulta as $row) {
			$id_usuario = $row->id_usuario;
		}
		$usuario = array('estado' => 1 );
		$r = $this->model_usuario->modificar_usuario($id_usuario,$usuario);
		echo json_encode($r);
		//$r = $this->model_profesor->eliminar_datos($id);
	}
	public function reporte_profesor_pdf_nomina()
	{
		$idd = $this->input->get("id");
		$id = base64_decode($idd);
    	$this->load->library('pdf');

    	$this->load->library('edate');
    	$fecha_actual = date("Y-m-d");
    	$f = $this->edate->obtenerFecha($fecha_actual);

    $r2 = $this->model_profesor->listar_profesor();

		$this->pdf = new Pdf();

		$this->pdf->AddPage();

		$this->pdf->AliasNbPages();

		$this->pdf->SetTitle("Reporte");
		//$this->pdf->SetMargins(25,20,2);
		$this->pdf->SetLeftMargin(20);
		$this->pdf->SetRightMargin(20);
		$this->pdf->SetRightMargin(15);
		//$this->pdf->SetFillColor(28,33,121,1);
		$this->pdf->SetFillColor(4,123,248,1);
		
		
		//-----------------------------------------------------
		
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Ln(20);
		$this->pdf->cell(25);
		$this->pdf->Cell(120,10,'NOMINA DE PROFESORES',0,0,'C');
		$this->pdf->SetFont('Arial','B',9);
		$this->pdf->Ln(10);
		// Se define el formato de fuente: Arial, negritas, tamaño 9
		

		$this->pdf->SetFont('Arial','B',9);
		$this->pdf->Cell(40,6,'FECHA:',0,0);

		$this->pdf->SetFont('Arial', '', 7);
		$this->pdf->Cell(45,6,$f,0,0);

		$this->pdf->SetFont('Arial','B',9);
		$this->pdf->Cell(45,6,'UNIDAD EDUCATIVA:',0,0);

		$this->pdf->SetFont('Arial', '', 7);
		$this->pdf->Cell(45,6,'Maria Auxiliadora',0,1);

		$this->pdf->SetFont('Arial','B',9);
		$this->pdf->Cell(40,6,'PROFESORES REGISTRADOS:',0,0);

		$this->pdf->SetFont('Arial', '', 7);
		$this->pdf->Cell(45,6,' ',0,0);

		$this->pdf->SetFont('Arial','B',9);
		$this->pdf->Cell(45,6,'FIRMA/SELLO:',0,0);

		$this->pdf->Cell(45,6,' ',0,0);

		$this->pdf->Ln(10);

		$this->pdf->SetFont('Arial', '', 7);



		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->Cell(5,8,'#',0,0,'C','1');
	  	$this->pdf->Cell(45,8,'NOMBRES',0,0,'C','1');
	  	$this->pdf->Cell(30,8,'APELLIDO PATERNO',0,0,'C','1');
	  	$this->pdf->Cell(30,8,'APELLIDO MATERNO',0,0,'C','1');
	  	$this->pdf->Cell(20,8,'CI',0,0,'C','1');
	  	$this->pdf->Cell(20,8,'SEXO',0,0,'C','1');
		$this->pdf->Cell(25,8,'ESPECIALIDAD',0,0,'C','1');
	  	$this->pdf->Ln(8);

	  	$this->pdf->SetFont('Arial', '', 9);
	  // La variable $x se utiliza para mostrar un número consecutivo
	  $x = 1;
	  $this->pdf->SetTextColor(0,0,0);
		foreach ($r2 as $row) {

		      if ($x%2==0) {
		      	$this->pdf->SetFillColor(242,242,242,1);
		      	$this->pdf->Cell(5,8,$x++,'',0,'L',1);
		      $this->pdf->Cell(45,8,$row->nombres,'',0,'L',1);
		      $this->pdf->Cell(30,8,$row->a_paterno,'',0,'L',1);
		      $this->pdf->Cell(30,8,$row->a_materno,'',0,'L',1);
		      $this->pdf->Cell(20,8,$row->ci." ".$row->exp,'',0,'L',1);
		      $this->pdf->Cell(20,8,$row->sexo,'',0,'L',1);
			  $this->pdf->Cell(25,8,$row->especialidad,'',0,'L',1);
      //Se agrega un salto de linea
      		  $this->pdf->Ln(8);
		      }else{
		      	
		      	$this->pdf->Cell(5,8,$x++,'',0,'L',0);
		      $this->pdf->Cell(45,8,$row->nombres,'',0,'L',0);
		      $this->pdf->Cell(30,8,$row->a_paterno,'',0,'L',0);
		      $this->pdf->Cell(30,8,$row->a_materno,'',0,'L',0);
		      $this->pdf->Cell(20,8,$row->ci." ".$row->exp,'',0,'L',0);
		      $this->pdf->Cell(20,8,$row->sexo,'',0,'L',0);
			  $this->pdf->Cell(25,8,$row->especialidad,'',0,'L',0);
      //Se agrega un salto de linea
      		  $this->pdf->Ln(8);
		      }

		      

		}
	  	$this->pdf->Ln(7);
		$this->pdf->Output("REPORTE PROFESOR.pdf", 'I');
	}
	public function reporte_profesor_pdf_planilla()
	{
		$idd = $this->input->get("id");
		$id = base64_decode($idd);
    	$this->load->library('pdf');


    	$this->load->library('edate');

    	$fecha_actual = date("Y-m-d");
    	$f = $this->edate->obtenerFecha($fecha_actual);


    $r2 = $this->model_profesor->listar_profesor();

		$this->pdf = new Pdf();

		$this->pdf->AddPage();

		$this->pdf->AliasNbPages();

		$this->pdf->SetTitle("Reporte");
		//$this->pdf->SetMargins(25,20,2);
		$this->pdf->SetLeftMargin(20);
		$this->pdf->SetRightMargin(20);
		$this->pdf->SetRightMargin(15);
		//$this->pdf->SetFillColor(28,33,121,1);
		$this->pdf->SetFillColor(4,123,248,1);
		
		
		//-----------------------------------------------------
		
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Ln(20);
		$this->pdf->cell(25);
		$this->pdf->Cell(120,10,'PLANILLA PROFESORES',0,0,'C');
		$this->pdf->SetFont('Arial','B',9);
		$this->pdf->Ln(10);
		// Se define el formato de fuente: Arial, negritas, tamaño 9
		

		$this->pdf->SetFont('Arial','B',9);
		$this->pdf->Cell(40,6,'FECHA:',0,0);

		$this->pdf->SetFont('Arial', '', 7);
		$this->pdf->Cell(45,6,$f,0,0);

		$this->pdf->SetFont('Arial','B',9);
		$this->pdf->Cell(45,6,'UNIDAD EDUCATIVA:',0,0);

		$this->pdf->SetFont('Arial', '', 7);
		$this->pdf->Cell(45,6,'Maria Auxiliadora',0,1);

		$this->pdf->SetFont('Arial','B',9);
		$this->pdf->Cell(40,6,'PROFESORES REGISTRADOS:',0,0);

		$this->pdf->SetFont('Arial', '', 7);
		$this->pdf->Cell(45,6,' ',0,0);

		$this->pdf->SetFont('Arial','B',9);
		$this->pdf->Cell(45,6,'FIRMA/SELLO:',0,0);

		$this->pdf->Cell(45,6,' ',0,0);

		$this->pdf->Ln(10);

		$this->pdf->SetFont('Arial', '', 7);



		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->Cell(5,8,'#',0,0,'C','1');
	  	$this->pdf->Cell(40,8,'NOMBRES',0,0,'C','1');
	  	$this->pdf->Cell(30,8,'APELLIDO PATERNO',0,0,'C','1');
	  	$this->pdf->Cell(30,8,'APELLIDO MATERNO',0,0,'C','1');
		$this->pdf->Cell(25,8,'ESPECIALIDAD',0,0,'C','1');
		$this->pdf->Cell(45,8,'OBSERVACION',0,0,'C','1');
	  	$this->pdf->Ln(8);

	  	$this->pdf->SetFont('Arial', '', 9);
	  // La variable $x se utiliza para mostrar un número consecutivo
	  $x = 1;
	  $this->pdf->SetTextColor(0,0,0);
		foreach ($r2 as $row) {

		      if ($x%2==0) {
		      	$this->pdf->SetFillColor(242,242,242,1);
		      	$this->pdf->Cell(5,8,$x++,'',0,'L',1);
		      $this->pdf->Cell(40,8,$row->nombres,'',0,'L',1);
		      $this->pdf->Cell(30,8,$row->a_paterno,'',0,'L',1);
		      $this->pdf->Cell(30,8,$row->a_materno,'',0,'L',1);
			  $this->pdf->Cell(25,8,$row->especialidad,'',0,'L',1);
			  $this->pdf->Cell(45,8,' ','',0,'L',1);
      //Se agrega un salto de linea
      		  $this->pdf->Ln(8);
		      }else{
		      	
		      	$this->pdf->Cell(5,8,$x++,'',0,'L',0);
		      $this->pdf->Cell(40,8,$row->nombres,'',0,'L',0);
		      $this->pdf->Cell(30,8,$row->a_paterno,'',0,'L',0);
		      $this->pdf->Cell(30,8,$row->a_materno,'',0,'L',0);
			  $this->pdf->Cell(25,8,$row->especialidad,'',0,'L',0);
			  $this->pdf->Cell(45,8,' ','',0,'L',0);
      //Se agrega un salto de linea
      		  $this->pdf->Ln(8);
		      }

		      

		}
	  	$this->pdf->Ln(7);
		$this->pdf->Output("REPORTE PROFESOR.pdf", 'I');
	}
}

