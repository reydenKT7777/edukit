<?php 
/**
* 
*/
class Model_asistencia extends CI_Model
{
	
	public function buscar_asistencias($fecha)
	{
		$r = $this->db->query("SELECT COUNT(id) as registros 
						  FROM asistencia_estudiante
						  WHERE fecha BETWEEN '$fecha' and '$fecha'");
		return $r->row()->registros;
	}
	public function lista_es($fecha)
	{
		$r = $this->db->query("SELECT i.*,c.id as curso_id 
								FROM inscripcion i
								INNER JOIN curso c ON c.id = i.curso_id
								WHERE i.gestion = '$fecha'");
		return $r->result();
	}
	public function agregar_datos($data)
	{
		$this->db->set($data);
		$this->db->insert('asistencia_estudiante');
	}
	public function lista_es_prof($fecha)
	{
		if ($this->session->rol == 1) {
			$r = $this->db->query("SELECT COUNT(asis.id) cantidad FROM asistencia_estudiante asis 
									WHERE asis.rol_responsable = 1 AND 
									asis.fecha BETWEEN '$fecha' and '$fecha'");
		}
		if ($this->session->rol == 2) {
			$r = $this->db->query("SELECT COUNT(asis.id) cantidad FROM asistencia_estudiante asis 
									WHERE asis.rol_responsable = 2 AND 
									asis.fecha BETWEEN '$fecha' and '$fecha' AND
									asis.id_responsable = ".$this->session->persona_id);
		}
		return $r->row()->cantidad;
	}
	public function modificar_asistencia($id,$data)
	{
		$this->db->where('id', $id);
		$this->db->update('asistencia_estudiante', $data);
	}
	public function buscar_asistencia_estudiante($id_estudiante)
	{
		$query = $this->db->query("SELECT u.foto_perfil, CONCAT(p.a_paterno,' ',p.a_materno,', ',p.nombres) as nombre_completo, ae.id as asistencia_id, e.id as estudiante_id,c.id as curso_id,ae.observacion,ae.tipo_asistencia, CONCAT(c.grado,' ',c.nivel,'-',c.paralelo) as curso
											FROM persona p
											INNER JOIN usuario u ON p.usuario_id = u.id
											INNER JOIN estudiante e ON e.persona_id = p.id
											INNER JOIN inscripcion ins on ins.estudiante_id = e.id
											INNER JOIN curso c on c.id = ins.curso_id
											INNER JOIN asistencia_estudiante ae on ae.estudiante_id = e.id
											WHERE 
											ae.estado = 0 AND
											ae.fecha BETWEEN '".date("Y-m-d")."' AND '".date("Y-m-d")."' AND
											e.id = $id_estudiante ");
		return $query->row();
	}
}