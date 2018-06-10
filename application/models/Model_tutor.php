<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_tutor extends CI_Model {
	public function listar_tutor()
	{
		$query = $this->db->get('tutor');
		return $query->result();
	}
	public function agregar_datos($data)
	{
		$this->db->set($data);
		$this->db->insert('tutor');
	}
	public function modificar_tutor($id,$data)
	{
		$this->db->where('id', $id);
		$this->db->update('tutor', $data);
	}
	public function buscar_tutor($ci)
	{
		$query = $this->db->query("SELECT p.nombres,p.a_paterno,p.a_materno,tu.parentesco,us.foto_perfil,p.ci,tu.id as tutor_id,p.exp
									FROM tutor tu, persona p,usuario us
									WHERE tu.persona_id = p.id and p.ci = $ci and us.id = p.usuario_id");
		return $query->row();
	}
	public function eliminar_datos($id)
	{
		$this->db->delete('tutor', array('id' => $id));
	}
}
