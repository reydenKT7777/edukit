<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_curso extends CI_Model {
	public function listar_curso()
	{
		$query = $this->db->query("SELECT c.id, CONCAT(c.grado,' ',c.nivel,' - ',c.paralelo) as grado 
									FROM curso c WHERE c.estado = 1");
		return $query->result();
	}
	public function listar_curso_completo()
	{
		$query = $this->db->query("SELECT *
									FROM curso c ");
		return $query->result();
	}

	
	public function listar_curso_por_estado()
	{
		$query = $this->db->query("SELECT c.id, c.grado, c.nivel, c.paralelo
									FROM curso c 
									WHERE c.estado=1");
		return $query->result();
	}


	public function agregar_datos($data)
	{
		$this->db->set($data);
		$this->db->insert('curso');
	}
	public function modificar_curso($id,$data)
	{
		$this->db->where('id', $id);
		$this->db->update('curso', $data);
	}
	public function buscar_curso($id)
	{
		$query = $this->db->select('*')
                ->where('id', $id)
                ->get('curso');
		return $query->result();
	}
	public function eliminar_datos($id)
	{
		$this->db->delete('curso', array('id' => $id));
	}
	public function mis_cursos($id)
	{
		$r = $this->db->query("SELECT c.id FROM curso c
								INNER JOIN materia m ON c.id = m.curso_id
								WHERE m.profesor_id = $id");
		return $r->result();
	}
}
