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
}
