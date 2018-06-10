<?php 
/**
* 
*/
class Model_contador extends CI_Model
{
	public function contar_profesor()
	{
		$r = $this->db->query("SELECT COUNT(prf.id) as total_p
								FROM usuario u
								INNER JOIN persona p on p.usuario_id=u.id
								INNER JOIN profesor prf on prf.persona_id = p.id
								where u.estado = 1 and u.rol = 2");
		return $r->result();
	}
	
}