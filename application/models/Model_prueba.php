<?php 
/**
* 
*/
class Model_prueba extends CI_Model
{
	
	public function asistentes($id_curso,$fecha)
	{
		$query = $this->db->query("SELECT COUNT(e.id) as asistente
									FROM persona p
									INNER JOIN usuario u ON p.usuario_id = u.id
									INNER JOIN estudiante e ON e.persona_id = p.id
									INNER JOIN inscripcion ins on ins.estudiante_id = e.id
									INNER JOIN curso c on c.id = ins.curso_id
									INNER JOIN asistencia_estudiante ae on ae.estudiante_id = e.id
									WHERE c.id = $id_curso and ae.fecha = '$fecha' and ae.estado = 1 and ae.tipo_asistencia in('1','3','5')");
		return $query->result();
	}

	public function ausentes($id_curso,$fecha)
	{
		$query = $this->db->query("SELECT COUNT(e.id) as ausente
									FROM persona p
									INNER JOIN usuario u ON p.usuario_id = u.id
									INNER JOIN estudiante e ON e.persona_id = p.id
									INNER JOIN inscripcion ins on ins.estudiante_id = e.id
									INNER JOIN curso c on c.id = ins.curso_id
									INNER JOIN asistencia_estudiante ae on ae.estudiante_id = e.id
									WHERE c.id = $id_curso and ae.fecha = '$fecha' and ae.estado = 1 and ae.tipo_asistencia in('2','4')");
		return $query->result();
	}

	public function cont_estudiantes($id_curso,$fecha)
	{
		$query = $this->db->query("SELECT COUNT(e.id) as estudiantes
									FROM persona p
									INNER JOIN usuario u ON p.usuario_id = u.id
									INNER JOIN estudiante e ON e.persona_id = p.id
									INNER JOIN inscripcion ins on ins.estudiante_id = e.id
									INNER JOIN curso c on c.id = ins.curso_id
									WHERE c.id = $id_curso");
		return $query->result();
	}
}