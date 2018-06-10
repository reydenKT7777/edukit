<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model_usuario extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }
  public function listar_usuario()
	{
		$query = $this->db->get('usuario');
		return $query->result();
	}
	public function agregar_datos($data)
	{
		$this->db->set($data);
		$this->db->insert('usuario');
    return $this->db->insert_id();
	}
	public function modificar_usuario($id,$data)
	{
		$this->db->where('id', $id);
		return $this->db->update('usuario', $data);
	}
	public function buscar_usuario($id)
	{
		$query = $this->db->select('*')
                ->where('id', $id)
                ->get('usuario');
		return $query->result();
	}
	public function eliminar_datos($id)
	{
		$this->db->delete('usuario', array('id' => $id));
	}

}
