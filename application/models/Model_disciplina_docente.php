<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_disciplina_docente extends CI_Model {
	public function listar_disciplina_docente()
	{
		$query = $this->db->query("SELECT us.foto_perfil,p.a_paterno,p.a_materno,p.nombres,dis.descripcion,dis.fecha FROM persona p 
									INNER JOIN profesor pr on pr.persona_id = p.id
									INNER JOIN usuario us on us.id = p.usuario_id
									INNER JOIN disciplina_docente dis on dis.profesor_id = pr.id
									WHERE us.rol = 2");
		return $query->result();
	}
	public function agregar_datos($data)
	{
		$this->db->set($data);
		$this->db->insert('disciplina_docente');
	}
	public function modificar_disciplina_docente($id,$data)
	{
		$this->db->where('id', $id);
		$this->db->update('disciplina_docente', $data);
	}
	public function buscar_disciplina_docente($id)
	{
		$query = $this->db->select('*')
                ->where('id', $id)
                ->get('disciplina_docente');
		return $query->result();
	}
	public function eliminar_datos($id)
	{
		$this->db->delete('disciplina_docente', array('id' => $id));
	}
}
