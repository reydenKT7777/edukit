<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_materia extends CI_Model {
	public function listar_materia()
	{
		$query = $this->db->get('materia');
		return $query->result();
	}
	public function agregar_datos($data)
	{
		$this->db->set($data);
		$this->db->insert('materia');
	}
	public function modificar_materia($id,$data)
	{
		$this->db->where('id', $id);
		$this->db->update('materia', $data);
	}
	public function modificar_materia_r($id,$data)
	{
		$this->db->where('id', $id);
		return $this->db->update('materia', $data);
	}
	public function buscar_materia($id)
	{
		$query = $this->db->select('*')
                ->where('id', $id)
                ->get('materia');
		return $query->result();
	}
	public function eliminar_datos($id)
	{
		$this->db->delete('materia', array('id' => $id));
	}
	public function listar_materia_prof($idd)
	{
		$materia = $this->db->query("select m.id 
										FROM curso c 
										INNER JOIN materia m ON m.curso_id = c.id
										INNER JOIN profesor pr ON m.profesor_id = pr.id
										INNER JOIN persona p ON pr.persona_id = p.id
										WHERE m.estado = 1 and pr.persona_id = $idd");
		

		
			foreach ($materia->result() as $row) {
			$id_materia = $row->id;
				$est = $this->db->query("SELECT COUNT(es.id) as integrantes, CONCAT(c.grado, c.paralelo,' ') as curso, c.nivel, m.nombre as materia, m.id, m.color_hex, m.curso_id
											FROM curso c 
											INNER JOIN inscripcion ins ON ins.curso_id = c.id
											INNER JOIN estudiante es ON es.id = ins.estudiante_id
                                            INNER JOIN materia m ON m.curso_id = c.id
                                            INNER JOIN profesor pr ON m.profesor_id = pr.id
                                            INNER JOIN persona p ON pr.persona_id = p.id
											WHERE m.id = $id_materia and pr.persona_id = $idd ");
				$data[] = array(
								'id' => $est->row()->curso_id,
								'id_mat' => $est->row()->id,
								'titulo' => $est->row()->materia,
								'curso' => $est->row()->curso,
								'nivel' => $est->row()->nivel,
								'integrantes' => $est->row()->integrantes,
								'color_hex'=> $est->row()->color_hex,
								'color'=>'green'
							);
			}
		

		return $data;
	}
	 

	public function verifica_materia_rep($materia,$curso)
	{
		$query = $this->db->query("SELECT m.id as cant_mat_curso FROM materia m WHERE m.nombre = $materia and m.curso_id = $curso and m.estado = 1");
		return $query->num_rows();
	}

}
