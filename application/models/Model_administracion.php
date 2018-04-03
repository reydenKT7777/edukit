<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_administracion extends CI_Model {
	public function listar_administracion()
	{
		$query = $this->db->get('administracion');
		return $query->result();
	}
	public function agregar_datos($data)
	{
		$this->db->set($data);
		$this->db->insert('administracion');
	}
	public function modificar_administracion($id,$data)
	{
		$this->db->where('id', $id);
		$this->db->update('administracion', $data);
	}
	public function buscar_administracion($id)
	{
		$query = $this->db->select('*')
                ->where('id', $id)
                ->get('administracion');
		return $query->result();
	}
	public function eliminar_datos($id)
	{
		$this->db->delete('administracion', array('id' => $id));
	}
}
