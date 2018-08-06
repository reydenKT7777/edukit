<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_calificacion extends CI_Model {
	public function listar_materia()
	{
		$query = $this->db->get('materia');
		return $query->result();
	}
	public function est_materia($id,$prof)
	{
		$query = $this->db->query("SELECT CONCAT(p.a_paterno,' ',p.a_materno,', ',p.nombres) as nombres, e.id
											FROM persona p
											INNER JOIN usuario u ON p.usuario_id = u.id
											INNER JOIN estudiante e ON e.persona_id = p.id
											INNER JOIN inscripcion ins on ins.estudiante_id = e.id
											INNER JOIN curso c on c.id = ins.curso_id
											INNER JOIN materia m ON m.curso_id = c.id
											WHERE m.id = $id and m.profesor_id = $prof");

		return $query->result();
	}

	public function nota_est($id,$prof,$id_est)
	{
		$r = $this->db->query("SELECT
									GROUP_CONCAT( DISTINCT
										CONCAT(
											'SUM( IF(bl.id = '
											, bl.id
											, ', clf.nota,0) ) AS mo_'
											, bl.id
										)
									) as ini
										FROM persona p
							            INNER JOIN usuario u ON p.usuario_id = u.id
							            INNER JOIN estudiante e ON e.persona_id = p.id
							            INNER JOIN inscripcion ins on ins.estudiante_id = e.id
							            INNER JOIN curso c on c.id = ins.curso_id
							            INNER JOIN materia m ON m.curso_id = c.id
							            INNER JOIN calificacion clf ON clf.inscripcion_id = ins.id
							            INNER JOIN bloque_notas bl ON bl.id = clf.bloque_notas_id
							    		WHERE m.id = $id and m.profesor_id = $prof and e.id = $id_est");
		// foreach ($r as $row) {
		// 	$piv = $row->pivot;
		// }
		// echo $r;
		// $query = $this->db->query("SELECT CONCAT(p.a_paterno,' ',p.a_materno,' ',p.nombres) as nombres, $piv
		// 							   	FROM persona p
		// 					            INNER JOIN usuario u ON p.usuario_id = u.id
		// 					            INNER JOIN estudiante e ON e.persona_id = p.id
		// 					            INNER JOIN inscripcion ins on ins.estudiante_id = e.id
		// 					            INNER JOIN curso c on c.id = ins.curso_id
		// 					            INNER JOIN materia m ON m.curso_id = c.id
		// 					            INNER JOIN calificacion clf ON clf.inscripcion_id = ins.id
		// 					            INNER JOIN bloque_notas bl ON bl.id = clf.bloque_notas_id
		// 								WHERE m.id = $id and m.profesor_id = $prof and e.id = $id_est");







		return $r->result();
	}
	public function tabla_nota($id,$prof,$id_est,$ini)
	{
		$query = $this->db->query("SELECT CONCAT(p.a_paterno,' ',p.a_materno,' ',p.nombres) as nombres, $ini
									   	FROM persona p
							            INNER JOIN usuario u ON p.usuario_id = u.id
							            INNER JOIN estudiante e ON e.persona_id = p.id
							            INNER JOIN inscripcion ins on ins.estudiante_id = e.id
							            INNER JOIN curso c on c.id = ins.curso_id
							            INNER JOIN materia m ON m.curso_id = c.id
							            INNER JOIN calificacion clf ON clf.inscripcion_id = ins.id
							            INNER JOIN bloque_notas bl ON bl.id = clf.bloque_notas_id
										WHERE m.id = $id and m.profesor_id = $prof and e.id = $id_est");


		return $query->result();
	}
	public function contador($id,$prof)
	{
		$query = $this->db->query("SELECT bl.id

									   	FROM persona p
							            INNER JOIN usuario u ON p.usuario_id = u.id
							            INNER JOIN estudiante e ON e.persona_id = p.id
							            INNER JOIN inscripcion ins on ins.estudiante_id = e.id
							            INNER JOIN curso c on c.id = ins.curso_id
							            INNER JOIN materia m ON m.curso_id = c.id
							            INNER JOIN calificacion clf ON clf.inscripcion_id = ins.id
							            INNER JOIN bloque_notas bl ON bl.id = clf.bloque_notas_id
							             WHERE m.id = $id and m.profesor_id = $prof
                                        GROUP by bl.id");


		return $query->num_rows();
	}
	public function notas($id,$prof)
	{
		$query = $this->db->query("SELECT clf.nota,p.a_paterno,p.nombres,bl.nombre as bloque,m.nombre as materia, e.id
									   	FROM persona p
							            INNER JOIN usuario u ON p.usuario_id = u.id
							            INNER JOIN estudiante e ON e.persona_id = p.id
							            INNER JOIN inscripcion ins on ins.estudiante_id = e.id
							            INNER JOIN curso c on c.id = ins.curso_id
							            INNER JOIN materia m ON m.curso_id = c.id
							            INNER JOIN calificacion clf ON clf.inscripcion_id = ins.id
							            INNER JOIN bloque_notas bl ON bl.id = clf.bloque_notas_id
							            WHERE m.id = $id and m.profesor_id = $prof");

		return $query->result();
	}
	public function bloques($id,$prof)
	{
		$query = $this->db->query("SELECT bl.nombre as bloque, bl.id
													   	FROM estudiante e
											            INNER JOIN inscripcion ins on ins.estudiante_id = e.id
											            INNER JOIN curso c on c.id = ins.curso_id
											            INNER JOIN materia m ON m.curso_id = c.id
											            INNER JOIN calificacion clf ON clf.inscripcion_id = ins.id
											            INNER JOIN bloque_notas bl ON bl.id = clf.bloque_notas_id
											            WHERE m.id = $id and m.profesor_id = $prof
														group by bloque
														order by bloque");
		return $query->result();
	}
	public function id_estudiantes($id,$prof)
	{
		$query = $this->db->query("SELECT e.id as id_estudiante
													   	FROM estudiante e
											            INNER JOIN inscripcion ins on ins.estudiante_id = e.id
											            INNER JOIN curso c on c.id = ins.curso_id
											            INNER JOIN materia m ON m.curso_id = c.id
											            INNER JOIN calificacion clf ON clf.inscripcion_id = ins.id
											            INNER JOIN bloque_notas bl ON bl.id = clf.bloque_notas_id
											            WHERE m.id = 5 and m.profesor_id = 5
														group by id_estudiante
														order by id_estudiante");
			return $query->result();
	}

	//
	public function prub($id,$prof,$id_est)
	{
		$query = $this->db->query("SELECT p.nombres, (SELECT clf.nota
FROM persona p
INNER JOIN usuario u ON p.usuario_id = u.id
INNER JOIN estudiante e ON e.persona_id = p.id
INNER JOIN inscripcion ins on ins.estudiante_id = e.id
INNER JOIN curso c on c.id = ins.curso_id
INNER JOIN materia m ON m.curso_id = c.id
WHERE m.id = $id and m.profesor_id = $prof and e.id = $id_est) as nota
FROM persona p
INNER JOIN usuario u ON p.usuario_id = u.id
INNER JOIN estudiante e ON e.persona_id = p.id
INNER JOIN inscripcion ins on ins.estudiante_id = e.id
INNER JOIN curso c on c.id = ins.curso_id
INNER JOIN materia m ON m.curso_id = c.id
INNER JOIN calificacion clf ON clf.inscripcion_id = ins.id
INNER JOIN bloque_notas bl ON bl.id = clf.bloque_notas_id
WHERE m.id = $id and m.profesor_id = $prof and e.id = $id_est");
							            // WHERE m.id = 5 and m.profesor_id = 5 and e.id = 1");


		return $query->result();
	}

}
