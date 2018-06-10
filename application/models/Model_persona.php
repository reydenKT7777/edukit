<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_persona extends CI_Model {
	public function listar_persona()
	{
		$query = $this->db->get('persona');
		return $query->result();
	}
	public function agregar_datos($data)
	{
		$this->db->set($data);
		$this->db->insert('persona');
		return $this->db->insert_id();
	}
	public function modificar_persona($id,$data)
	{
		$this->db->where('id', $id);
		$this->db->update('persona', $data);
	}
	public function buscar_persona($id)
	{
		$query = $this->db->select('*')
                ->where('id', $id)
                ->get('persona');
		return $query->result();
	}
	public function eliminar_datos($id)
	{
		$this->db->delete('persona', array('id' => $id));
	}
	public function IDProffPersonaUser($id_persona)
	{
		$r = $this->db->query("SELECT u.id as id_usuario, p.id as id_persona ,u.foto_perfil, pr.id as id_profesor FROM usuario u
													INNER JOIN persona p on p.usuario_id = u.id
													INNER JOIN profesor pr on pr.persona_id = p.id
													WHERE p.id = $id_persona");
		return $r->result();
	}
	public function IDadminfPersonaUser($id_persona)
	{
		$r = $this->db->query("SELECT u.id as id_usuario, p.id as id_persona ,u.foto_perfil, adm.id as id_admin FROM usuario u
													INNER JOIN persona p on p.usuario_id = u.id
													INNER JOIN administracion adm on adm.persona_id = p.id
													WHERE p.id = $id_persona");
		return $r->result();
	}
}
