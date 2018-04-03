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
	public function eliminar_datos($id)
	{
		$this->db->delete('estudiante', array('id' => $id));
	}
}
