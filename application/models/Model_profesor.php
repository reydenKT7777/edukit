<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_profesor extends CI_Model {
	public function listar_profesor()
	{
		$query = $this->db->query('SELECT p.id,p.a_paterno,p.a_materno,p.nombres,p.ci,p.exp,p.sexo,prf.especialidad
															FROM usuario u
															INNER JOIN persona p on p.usuario_id=u.id
															INNER JOIN profesor prf on prf.persona_id = p.id');
		return $query->result();
	}
	public function agregar_datos($data)
	{
		$this->db->set($data);
		$this->db->insert('profesor');
	}
	public function modificar_profesor($id,$data)
	{
		$this->db->where('id', $id);
		$this->db->update('profesor', $data);
	}
	public function buscar_profesor($id)
	{
		$query = $this->db->select('*')
                ->where('id', $id)
                ->get('profesor');
		return $query->result();
	}
	public function eliminar_datos($id)
	{
		$this->db->delete('profesor', array('id' => $id));
	}
}
