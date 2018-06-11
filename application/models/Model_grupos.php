<?php 
/**
* 
*/
class Model_grupos extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
	}
	public function lista_top_grupo($rol)
	{
		$r = $this->db->query("SELECT COUNT(n.id) as cantidadNoticias,n.ref_visualizacion
							   FROM noticia n
							   WHERE n.ref_visualizacion LIKE 'n%'
							   GROUP BY n.ref_visualizacion");
		foreach ($r->result() as $row) {
			$porciones = explode("-", $row->ref_visualizacion);
			$ref = $porciones[0];
			if ($ref == 'np') {
				$prof = $this->db->query("select count(id) as c from profesor");
				$data[] = array(
								'noticias' => $row->cantidadNoticias, 
								'titulo' => 'Profesores',
								'ini'=>'P',
								'subtitulo' => 'Grupo de profesores',
								'integrantes' => $prof->row()->c,
								'tipo' => $row->ref_visualizacion,
								'color'=>'indigo'
							);
			}
			if ($ref == 'nc') {
				$id_curso = $porciones[1];
				$est = $this->db->query("SELECT COUNT(es.id) as integrantes, CONCAT(c.grado, c.paralelo,' de ',c.nivel) as curso
											FROM curso c 
											INNER JOIN inscripcion ins ON ins.curso_id = c.id
											INNER JOIN estudiante es ON es.id = ins.estudiante_id
											WHERE c.id = $id_curso");
				$data[] = array(
								'noticias' => $row->cantidadNoticias, 
								'titulo' => $est->row()->curso,
								'ini'=>$est->row()->curso[0],
								'subtitulo' => 'Grupo de alumnos',
								'integrantes' => $est->row()->integrantes,
								'tipo' => $row->ref_visualizacion,
								'color'=>'blue'
							);
			}
			if ($ref == 'nm') {
				$id_materia = $porciones[1];
				$est = $this->db->query("SELECT COUNT(es.id) as integrantes, CONCAT(c.grado, c.paralelo,' de ',c.nivel) as curso, m.nombre as materia
											FROM curso c 
											INNER JOIN inscripcion ins ON ins.curso_id = c.id
											INNER JOIN estudiante es ON es.id = ins.estudiante_id
                                            INNER JOIN materia m ON m.curso_id = c.id
											WHERE m.id = $id_materia");
				$data[] = array(
								'noticias' => $row->cantidadNoticias, 
								'titulo' => $est->row()->materia,
								'ini'=>$est->row()->materia[0],
								'subtitulo' => 'Grupo de materia '.$est->row()->curso,
								'integrantes' => $est->row()->integrantes,
								'tipo' => $row->ref_visualizacion,
								'color'=>'green'
							);
			}
		}
		$curso = $this->db->query("select * from curso WHERE estado = 1");
		
		if ($rol==1 or $rol==3 or $rol==4) {
			foreach ($curso->result() as $row) {
			$id_curso = $row->id;
				$est = $this->db->query("SELECT COUNT(es.id) as integrantes, CONCAT(c.grado, c.paralelo,' de ',c.nivel) as curso,c.id
											FROM curso c 
											INNER JOIN inscripcion ins ON ins.curso_id = c.id
											INNER JOIN estudiante es ON es.id = ins.estudiante_id
											WHERE c.id = $id_curso");
				$data[] = array(
								'noticias' => 0, 
								'titulo' => $est->row()->curso,
								'ini'=>$est->row()->curso[0],
								'subtitulo' => 'Grupo de alumnos',
								'integrantes' => $est->row()->integrantes,
								'tipo' => 'nc-'.$est->row()->id,
								'color'=>'red'
							);
			}
		}

		$materia = $this->db->query("select * from materia WHERE estado = 1");
		

		if ($rol==2 or $rol==3 or $rol==4) {
			foreach ($materia->result() as $row) {
			$id_materia = $row->id;
				$est = $this->db->query("SELECT COUNT(es.id) as integrantes, CONCAT(c.grado, c.paralelo,' de ',c.nivel) as curso, m.nombre as materia,m.id
											FROM curso c 
											INNER JOIN inscripcion ins ON ins.curso_id = c.id
											INNER JOIN estudiante es ON es.id = ins.estudiante_id
                                            INNER JOIN materia m ON m.curso_id = c.id
											WHERE m.id = $id_materia");
				$data[] = array(
								'noticias' => 0, 
								'titulo' => $est->row()->materia,
								'ini'=>$est->row()->materia[0],
								'subtitulo' => 'Grupo de materia '.$est->row()->curso,
								'integrantes' => $est->row()->integrantes,
								'tipo' => 'nm-'.$est->row()->id,
								'color'=>'green'
							);
			}
		}

		return $data;
	}

}