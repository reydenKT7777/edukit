<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controlador_usuario extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('model_usuario');
  }

	public function listar_persona()
	{
		$r = $this->model_persona->listar_persona();
		echo json_encode($r);
	}
	public function agregar_datos()
	{
		$usuario = $this->input->post('usuario');
    $passwod = $this->input->post('password');
		$data = array(
			'usuario' => $usuario,
      'password' => $passwod
		);
		$this->model_persona->agregar_datos($data);
	}
	public function modificar_persona()
	{
		$id = $this->input->post('id');
		$id = $this->input->post('id');
		$a_paterno = $this->input->post('a_paterno');
		$a_materno = $this->input->post('a_materno');
		$nombres = $this->input->post('nombres');
		$ci = $this->input->post('ci');
		$exp = $this->input->post('exp');
		$sexo = $this->input->post('sexo');
		$telf = $this->input->post('telf');
		$telf_opc = $this->input->post('telf_opc');
		$direccion = $this->input->post('direccion');
		$f_nacimiento = $this->input->post('f_nacimiento');
		$estado = $this->input->post('estado');
		$usuario_id = $this->input->post('usuario_id');
		$data = array(
			'id' => $id,
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
			'estado' => $estado,
			'usuario_id' => $usuario_id,
		);
		$this->model_persona->modificar_persona($id,$data);
	}
	public function buscar_persona()
	{
		$id = $this->input->post('id');
		$r = $this->model_persona->buscar_persona($id);
		echo json_encode($r);
	}
	public function eliminar_datos()
	{
		$id = $this->input->post('id');
		$r = $this->model_persona->eliminar_datos($id);
	}

}
