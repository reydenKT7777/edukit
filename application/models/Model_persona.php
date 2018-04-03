<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_persona extends CI_Model {
	public function listar_persona()
	{
		$query = $this->db->get('persona');
		return $query->result();
	}
	public function agregar_datos($data)
	{
		$this->db->set($data);
		$this->db->insert('persona');
	}
	public function modificar_persona($id,$data)
	{
		$this->db->where('id', $id);
		$this->db->update('persona', $data);
	}
	public function buscar_persona($id)
	{
		$query = $this->db->select('*')
                ->where('id', $id)
                ->get('persona');
		return $query->result();
	}
	public function eliminar_datos($id)
	{
		$this->db->delete('persona', array('id' => $id));
	}
}
