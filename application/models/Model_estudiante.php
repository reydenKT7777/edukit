<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_estudiante extends CI_Model {
	public function listar_estudiante()
	{
		$query = $this->db->get('estudiante');
		return $query->result();
	}
	public function agregar_datos($data)
	{
		$this->db->set($data);
		$this->db->insert('estudiante');
		return $this->db->insert_id();
	}
	public function modificar_estudiante($id,$data)
	{
		$this->db->where('id', $id);
		$this->db->update('estudiante', $data);
	}
	public function buscar_estudiante($id)
	{
		$query = $this->db->select('*')
                ->where('id', $id)
                ->get('estudiante');
		return $query->result();
	}
	public function buscar_estudiantes_curso($id_curso)
	{
		$query = $this->db->query("SELECT u.foto_perfil, p.a_paterno,p.a_materno,p.nombres, CONCAT(c.grado,' ',c.nivel,'-',c.paralelo) as curso,e.id as estudiante_id
											FROM persona p
											INNER JOIN usuario u ON p.usuario_id = u.id
											INNER JOIN estudiante e ON e.persona_id = p.id
											INNER JOIN inscripcion ins on ins.estudiante_id = e.id
											INNER JOIN curso c on c.id = ins.curso_id
											WHERE c.id = $id_curso");
		return $query->result();
	}

	public function buscar_asistencia_estudiantes_curso($id_curso)
	{
		$query = $this->db->query("SELECT u.foto_perfil, CONCAT(p.a_paterno,' ',p.a_materno,', ',p.nombres) as nombre_completo
											FROM persona p
											INNER JOIN usuario u ON p.usuario_id = u.id
											INNER JOIN estudiante e ON e.persona_id = p.id
											INNER JOIN inscripcion ins on ins.estudiante_id = e.id
											INNER JOIN curso c on c.id = ins.curso_id
											INNER JOIN asistencia_estudiante ae on ae.estudiante_id = e.id
											WHERE c.id = $id_curso");
		return $query->result();
	}

	public function eliminar_datos($id)
	{
		$this->db->delete('estudiante', array('id' => $id));
	}
}
