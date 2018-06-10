<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_administracion extends CI_Model {
	public function listar_administracion()
	{
		$query = $this->db->query("SELECT u.nombre_usuario,u.correo_electronico, u.foto_perfil,u.estado,
																			p.*,adm.cargo
															FROM usuario u
															INNER JOIN persona p on p.usuario_id=u.id
															INNER JOIN administracion adm on adm.persona_id = p.id
                                                            where u.estado = 1 and u.rol = 1");
		return $query->result();
	}
	public function listar_administracion_baja()
	{
		$query = $this->db->query("SELECT u.nombre_usuario,u.correo_electronico, u.foto_perfil,u.estado,
																			p.*,adm.cargo
															FROM usuario u
															INNER JOIN persona p on p.usuario_id=u.id
															INNER JOIN administracion adm on adm.persona_id = p.id
                                                            where u.estado = 0 and u.rol = 1");
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
                ->where('persona_id', $id)
                ->get('administracion');
		return $query->row();
	}
	public function buscar_administracionV2($usuario)
	{
		$query = $this->db->select('*')
                ->where('usuario', $usuario)
                ->get('administracion');
		return $query->num_rows();
	}
	public function eliminar_datos($id)
	{
		$this->db->delete('administracion', array('id' => $id));
	}
	public function login($u,$p)
	{
		$r = $this->db->query("SELECT u.*,p.*,p.id as persona_id from usuario u, persona p
				WHERE p.usuario_id = u.id AND
				u.nombre_usuario = '$u' AND u.contrasena = '".sha1($p)."'");
		if ($r->num_rows() > 0) {
			return $r->row();
		}
		else {
			return false;
		}
	}
}
