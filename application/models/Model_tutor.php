<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_tutor extends CI_Model {
	public function listar_tutor()
	{
		$query = $this->db->get('tutor');
		return $query->result();
	}
	public function agregar_datos($data)
	{
		$this->db->set($data);
		$this->db->insert('tutor');
	}
	public function modificar_tutor($id,$data)
	{
		$this->db->where('id', $id);
		$this->db->update('tutor', $data);
	}
	public function buscar_tutor($id)
	{
		$query = $this->db->select('*')
                ->where('id', $id)
                ->get('tutor');
		return $query->result();
	}
	public function eliminar_datos($id)
	{
		$this->db->delete('tutor', array('id' => $id));
	}
}
