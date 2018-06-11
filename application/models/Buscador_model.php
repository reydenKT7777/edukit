<?php 
/**
* 
*/
class Buscador_model extends CI_Model
{
	public function buscar_profesor($nombre)
	{
		$r = $this->db->query("SELECT pr.id,CONCAT(p.nombres, ' ', p.a_paterno, ' ', p.a_materno) As nombre,us.foto_perfil, CONCAT('Especialidad: ', pr.especialidad) as detalle
								from persona p
                                INNER JOIN usuario us on us.id = p.usuario_id
                                INNER JOIN profesor pr on pr.persona_id = p.id
								where us.estado = 1 and us.rol = 2 and 
								( p.nombres like '$nombre%'or p.nombres like '%$nombre%' or p.nombres like '%$nombre' or 
                                 p.a_paterno like '$nombre%'or p.a_paterno like '%$nombre%' or p.a_paterno like '%$nombre'or 
                                 p.a_materno like '$nombre%'or p.a_materno like '%$nombre%' or p.a_materno like '%$nombre')
                                LIMIT 5 ");
		return $r->result();
	}
	public function buscar_tutor($ci)
	{
		$r = $this->db->query("SELECT p.*,tu.id as id_tutor, es.id as id_estudiante, cur.id as id_curso, ins.gestion,CONCAT(cur.grado,' ',cur.paralelo,' - ',cur.nivel) as grado, us.foto_perfil
								from tutor tu 
								INNER JOIN estudiante es on es.tutor_id = tu.id
								INNER JOIN persona p on p.id = es.persona_id
                                INNER JOIN inscripcion ins on ins.estudiante_id = es.id
                                INNER JOIN curso cur on cur.id = ins.curso_id
                                INNER JOIN usuario us on us.id = p.usuario_id
								where tu.persona_id = (SELECT per.id FROM persona per WHERE per.ci = $ci)");
		if ($r->num_rows() > 0) {
			return $r->result();
		}
		else{
			return false;
		}
	}
	public function buscar_estudiante($nombre)
	{
		$r = $this->db->query("SELECT es.id,CONCAT(p.nombres, ' ', p.a_paterno, ' ', p.a_materno) As nombre,us.foto_perfil, CONCAT('Curso: ', c.grado,' ',c.nivel,'-',c.paralelo) as detalle
								from persona p
                                INNER JOIN usuario us on us.id = p.usuario_id
                                INNER JOIN estudiante es on es.persona_id = p.id
                                INNER JOIN inscripcion ins ON ins.estudiante_id = es.id
                                INNER JOIN curso c ON c.id = ins.curso_id
								where us.estado = 1 and us.rol = 3 and 
								( p.nombres like '$nombre%'or p.nombres like '%$nombre%' or p.nombres like '%$nombre' or 
                                 p.a_paterno like '$nombre%'or p.a_paterno like '%$nombre%' or p.a_paterno like '%$nombre'or 
                                 p.a_materno like '$nombre%'or p.a_materno like '%$nombre%' or p.a_materno like '%$nombre')
                                LIMIT 5 ");
		return $r->result();
	}
}