<?php
/**
 *
 */
class Login extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('Model_administracion');
    $this->load->model('Model_profesor');
    $this->load->model('Model_curso');
    //$this->load->model('Model_estudiante');
  }
  public function verificar()
  {
    $user = $this->input->post("nombre_usuario");
    $pass = $this->input->post("password");
    $r = $this->Model_administracion->login($user,$pass);
    $rol = 0;
    if ($r != false) {
      $data = array('valida' => 'ok' );
      $this->session->set_userdata('id_usuario',$r->id);
      $this->session->set_userdata('rol',$r->rol);
      $this->session->set_userdata('sexo',$r->sexo);
      $this->session->set_userdata('foto_perfil',$r->foto_perfil);
      $this->session->set_userdata('nombres',$r->a_paterno.' '.$r->nombres);
      $this->session->set_userdata('persona_id',$r->persona_id);
      if ($r->rol == 1) {
        $adm = $this->Model_administracion->buscar_administracion($r->persona_id);
        $this->session->set_userdata('id_administracion',$adm->id);
      }
      if ($r->rol == 2) {
       $prof = $this->Model_profesor->buscar_IDprofesor($r->persona_id);
        $this->session->set_userdata('id_profesor',$prof->id); 
        $cursos = $this->Model_curso->mis_cursos($prof->id);
        $ar ="";
        foreach ($cursos as $row) {
          $ar = $ar."'nc-".$row->id."',";
          $cur[] = $row->id;
        }
        $this->session->set_userdata('cursos',$ar); 
        $this->session->set_userdata('array_cursos',$cur); 
      }
    }
    else {
      $data = array('valida' => 'error' );
    }
    echo json_encode($data);
  }
  public function logout()
  {
    $this->session->sess_destroy();
		redirect(base_url(),'refresh');
  }
}

 ?>
