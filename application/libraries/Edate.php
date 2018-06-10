<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Edate {
        

        public function obtenerFechaEnLetra($fecha){
            $dia= $this->conocerDiaSemanaFecha($fecha);
            $num = date("j", strtotime($fecha));
            $time = date("H", strtotime($fecha)).":".date("i", strtotime($fecha));
            $mes = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
            $mes = $mes[(date('m', strtotime($fecha))*1)-1];
            return $dia.', '.$num.' de '.$mes.' a las '.$time;
        }

        public function conocerDiaSemanaFecha($fecha) {
            $dias = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
            $dia = $dias[date('w', strtotime($fecha))];
            return $dia;
        }

        public function obtenerHora($fecha)
        {
          date_default_timezone_set('America/La_paz');
          $fecha_actual = date("Y-m-d");
          $fecha_entrada =date("Y-m-d", strtotime($fecha));
          if($fecha_actual > $fecha_entrada){
              $otro=$this->obtenerFechaEnLetra($fecha);
              return $otro;
          }else{
              $time = date("H", strtotime($fecha)).":".date("i", strtotime($fecha));
            return $time.' h';
          } 
        }

        public function obtenerFecha($fecha){
          $dia= $this->conocerDiaSemanaFecha($fecha);
            $num = date("j", strtotime($fecha));
            $mes = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
            $mes = $mes[(date('m', strtotime($fecha))*1)-1];
            return $dia.', '.$num.' de '.$mes;
        }

    }
