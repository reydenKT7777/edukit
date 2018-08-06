<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_publicacion extends CI_Model {
	public function listar_publicacion($pag)
	{
		if ($this->session->rol == 1) {
			$query = $this->db->query("SELECT
																			u.foto_perfil,
																			CONCAT(p.nombres,' ',p.a_paterno,' ',p.a_materno) AS nombres,
																			n.fecha,
																			n.contenido,
																			n.src_adj,
																			n.formato_adj,
																			n.nombre_adj,
																			n.tipo_adj,
																			n.id AS noticia_id,
																			p.id AS persona_id,
																			(SELECT COUNT(m.id) FROM me_gusta m WHERE n.id = m.ref_publicacion) as meGusta,
                                      (SELECT COUNT(mm.id) as id_meGusta
																							 FROM me_gusta mm, noticia nn
																							 WHERE nn.id = mm.ref_publicacion and
																							 mm.persona_id = ".$this->session->persona_id." and
										                        	 nn.id = n.id) as meGustaPersonal
																	FROM persona p
																	INNER JOIN noticia n ON n.persona_id = p.id
																	INNER JOIN usuario u ON u.id = p.usuario_id
																	WHERE n.ref_visualizacion in ('NG','NP')
																	ORDER BY n.id DESC
																	LIMIT 10 OFFSET $pag
																	");
		}
		if ($this->session->rol == 2) {
			$query = $this->db->query("SELECT
																			u.foto_perfil,
																			CONCAT(p.nombres,' ',p.a_paterno,' ',p.a_materno) AS nombres,
																			n.fecha,
																			n.contenido,
																			n.src_adj,
																			n.formato_adj,
																			n.nombre_adj,
																			n.tipo_adj,
																			n.id AS noticia_id,
																			p.id AS persona_id,
																			(SELECT COUNT(m.id) FROM me_gusta m WHERE n.id = m.ref_publicacion) as meGusta,
                                      (SELECT COUNT(mm.id) as id_meGusta
																							 FROM me_gusta mm, noticia nn
																							 WHERE nn.id = mm.ref_publicacion and
																							 mm.persona_id = ".$this->session->persona_id." and
										                        	 nn.id = n.id) as meGustaPersonal
																	FROM persona p
																	INNER JOIN noticia n ON n.persona_id = p.id
																	INNER JOIN usuario u ON u.id = p.usuario_id
																	WHERE n.ref_visualizacion in ('ng','np',".$this->session->cursos."'')
																	ORDER BY n.id DESC
																	LIMIT 10 OFFSET $pag
																	");
		}
		if ($this->session->rol == 3) {
			$query = $this->db->query("SELECT
																			u.foto_perfil,
																			CONCAT(p.nombres,' ',p.a_paterno,' ',p.a_materno) AS nombres,
																			n.fecha,
																			n.contenido,
																			n.src_adj,
																			n.formato_adj,
																			n.nombre_adj,
																			n.tipo_adj,
																			n.id AS noticia_id,
																			p.id AS persona_id,
																			(SELECT COUNT(m.id) FROM me_gusta m WHERE n.id = m.ref_publicacion) as meGusta,
                                      (SELECT COUNT(mm.id) as id_meGusta
																							 FROM me_gusta mm, noticia nn
																							 WHERE nn.id = mm.ref_publicacion and
																							 mm.persona_id = ".$this->session->persona_id." and
										                        	 nn.id = n.id) as meGustaPersonal
																	FROM persona p
																	INNER JOIN noticia n ON n.persona_id = p.id
																	INNER JOIN usuario u ON u.id = p.usuario_id
																	WHERE n.ref_visualizacion in ('NG')
																	ORDER BY n.id DESC
																	LIMIT 10 OFFSET $pag");
		}
		if ($this->session->rol == 4) {
			$query = $this->db->query("select * from notiticia");
		}
		return $query->result();
	}
	public function verificarMegustaPersonal($nid)
	{
		$r = $this->db->query("SELECT n.id,m.id as id_meGusta
													 FROM me_gusta m, noticia n
													 WHERE n.id = m.ref_publicacion and
													 m.persona_id = ".$this->session->persona_id." and
                        	 n.id = $nid");

			return $r->row();
	}



	public function agregar_datos($data)
	{
		$this->db->set($data);
		$this->db->insert('noticia');
		return $this->db->insert_id();
	}
	public function verMiPublicacion($idNoticia)
	{
		$r = $this->db->query("SELECT
									u.foto_perfil,
									CONCAT(p.nombres,' ',p.a_paterno,' ',p.a_materno) AS nombres,
									n.fecha,
									n.contenido,
									n.src_adj,
									n.formato_adj,
									n.nombre_adj,
									n.tipo_adj,
									n.id AS noticia_id,
									p.id AS persona_id
							FROM persona p
							INNER JOIN noticia n ON n.persona_id = p.id
							INNER JOIN usuario u ON u.id = p.usuario_id
							WHERE n.ref_visualizacion in ('NG','NP','NET') AND
	                        n.id = $idNoticia");
		return $r->result();
	}
}
