<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    // Incluimos el archivo fpdf
    require_once APPPATH."/third_party/fpdf/fpdf.php";

    //Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
    class Pdf extends FPDF {
        public function __construct() {
            parent::__construct();
        }
        // El encabezado del PDF
        public function Header(){

            $this->Image('./assets/images/logo/logoMA.jpg',20,7,15);

            $this->Image('./assets/images/logo/isologo.png',175,7,25);
            $this->SetFont('Arial','B',9);

            $this->Ln('1');
            $this->Cell(24);
            $this->Cell(139   ,0,'Unidad Educativa',0,1);
            $this->Ln('4');
            $this->Cell(24);
            $this->Cell(139   ,0,'Maria Auxiliadora',0,1);
            $this->Ln('4');
            $this->Cell(24);
            $this->Cell(139   ,0,'Gestion 2018',0,1);
            $this->Ln('4');
            
            $this->SetFont('Arial','B',11);
          }
       // El pie del pdf
       public function Footer(){
           $this->SetY(-15);
           $this->SetFont('Arial','I',8);
           $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
      }
    }
