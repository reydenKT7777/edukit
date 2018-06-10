<?php
/**
 *
 */
class Model_me_gusta extends CI_Model
{
  public function agregar_datos($data)
  {
    $this->db->set($data);
		$this->db->insert('me_gusta');
  }
  public function eliminar_datos($id_megusta)
  {
    $this->db->delete('me_gusta', array('id' => $id_megusta));
  }
  public function me_gusta_noticia($id_noticia)
  {
    $r = $this->db->query("SELECT CONCAT(p.nombres,' ',p.a_paterno,' ',p.a_materno) AS nombres, u.foto_perfil,u.rol,p.id AS persona_id
                      FROM persona p
                      INNER JOIN me_gusta m ON m.persona_id = p.id
                      INNER JOIN usuario u ON u.id = p.usuario_id
                      INNER JOIN noticia n ON n.id = m.ref_publicacion
                      WHERE n.id =$id_noticia");
    return $r->result();
  }
}
