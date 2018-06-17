<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_profesor extends CI_Model {
	public function listar_profesor()
	{
		$query = $this->db->query('SELECT u.nombre_usuario,u.correo_electronico, u.foto_perfil,u.estado,
																			p.*,prf.especialidad
															FROM usuario u
															INNER JOIN persona p on p.usuario_id=u.id
															INNER JOIN profesor prf on prf.persona_id = p.id
														  where u.estado = 1 and u.rol = 2');
		return $query->result();
	}
	public function listar_profesor_baja()
	{
		$query = $this->db->query('SELECT u.nombre_usuario,u.correo_electronico, u.foto_perfil,u.estado,
																			p.*,prf.especialidad
															FROM usuario u
															INNER JOIN persona p on p.usuario_id=u.id
															INNER JOIN profesor prf on prf.persona_id = p.id
														  where u.estado = 0 and u.rol = 2');
		return $query->result();
	}
	public function agregar_datos($data)
	{
		$this->db->set($data);
		$this->db->insert('profesor');
	}
	public function modificar_profesor($id,$data)
	{
		$this->db->where('id', $id);
		$this->db->update('profesor', $data);
	}
	public function buscar_profesor($id)
	{
		$query = $this->db->select('*')
                ->where('id', $id)
                ->get('profesor');
		return $query->row();
	}
	public function eliminar_datos($id)
	{
		$this->db->delete('profesor', array('id' => $id));
	}
	public function buscar_IDprofesor($id_personal)
	{
		$query = $this->db->select('*')
                ->where('persona_id', $id_personal)
                ->get('profesor');
		return $query->row();
	}
}
