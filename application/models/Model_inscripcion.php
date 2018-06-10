<?php
/**
 *
 */
class Model_inscripcion extends CI_Model
{

  public function agregar_datos($data)
	{
		$this->db->set($data);
		$this->db->insert('inscripcion');
	}
  public function modificar_inscripcion($id_es,$data)
  {
    $this->db->where('estudiante_id', $id_es);
		$this->db->update('inscripcion', $data);
  }
}
