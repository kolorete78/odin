<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// Incluimos el archivo fpdf
require_once APPPATH."third_party/fpdf/fpdf.php";

//Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
class Pdf extends FPDF {

    var $carrera_nombre = 0;
    var $fecha=0;
    var $materia_codigo=0;
    var $materia_nombre=0;
    var $regular_libre='REGULARES';
    var $cuatrimestre=0;
    var $comision=0;
    var $ano=0;
    var $profesor=0;



    public function __construct() {
        parent::__construct();
    }
    // El encabezado del PDF
    public function Header(){
        $this->Image(FCPATH.'assets/images/ifts19_logo.jpg',180,8,15,15);
        $this->SetFont('Arial','B',16);
        $this->Cell(30);
        $this->Cell(120,10,'Instituto de Formacion Tecnica N 19',0,0,'C');
        $this->Ln(10);


        $this->SetFont('Arial','',10);
        $this->Cell(60,10,'ACTA DE EXAMEN DE ALUMNOS: ',0,0,'L');
        $this->SetFont('Arial','B',10);
        $this->Cell(40,10,$this->regular_libre,0,0,'L');
        $this->SetFont('Arial','B',10);
        $this->Cell(15,10,'Fecha: ',0,0,'L');
        $this->SetFont('Arial','',10);
        $this->Cell(20,10,$this->fecha,0,0,'L');
        $this->Ln(10);

        $this->SetFont('Arial','B',10);
        $this->Cell(15,10,'Carrera:',0,0,'L');
        $this->SetFont('Arial','',10);
        $this->Cell(90,10,$this->carrera_nombre,0,0,'L');
        $this->SetFont('Arial','B',10);
        $this->Cell(22,10,'PROFESOR: ',0,0,'L');
        $this->SetFont('Arial','',10);
        $this->Cell(90,10,$this->profesor,0,0,'L');
        $this->Ln(10);


        $this->SetFont('Arial','B',10);
        $this->Cell(28,10,'Materia Codigo:',0,0,'L');
        $this->SetFont('Arial','',10);
        $this->Cell(15,10,$this->materia_codigo,0,0,'L');

        $this->SetFont('Arial','B',10);
        $this->Cell(29,10,'Materia Nombre:',0,0,'L');
        $this->SetFont('Arial','',10);
        $this->Cell(17,10,$this->materia_nombre,0,0,'L');
        $this->Ln(10);


        $this->SetFont('Arial','B',10);
        $this->Cell(18,10,'Comision:',0,0,'L');
        $this->SetFont('Arial','',10);
        $this->Cell(25,10,$this->comision,0,0,'L');

        $this->SetFont('Arial','B',10);
        $this->Cell(24,10,'Cuatrimestre:',0,0,'L');
        $this->SetFont('Arial','',10);
        $this->Cell(40,10,$this->cuatrimestre,0,0,'L');

        $this->SetFont('Arial','B',10);
        $txt='Correspondiente al ' . $this->ano .' año de la carrera';
        $txt1=iconv("UTF-8", "ISO-8859-1",$txt);
        $this->Cell(24,10,$txt1,0,0,'L');

        $this->Ln(10);
    }
    // El pie del pdf
    public function Footer(){
        $this->SetFont('Arial','B',10);
        $this->SetXY(20,-90);
        $this->Cell(30,7,'LIBRO: ','TBLR',0,'L');
        $this->Cell(30,7,'FOLIO: ','TBLR',0,'L');

        $this->SetFont('Arial','B',10);

        $this->SetXY(120,-100);
        $this->Cell(24,10,'Aprobados:       (         ) ...........................',0,0,'L');
        $this->SetXY(120,-90);
        $this->Cell(24,10,'Desaprobados: (         ) ...........................',0,0,'L');
        $this->SetXY(120,-80);
        $this->Cell(24,10,'Ausente:            (         ) ...........................',0,0,'L');
        $this->SetXY(120,-70);
        $this->Cell(24,10,'Total en lista:    (         ) ...........................',0,0,'L');
        $this->SetXY(15,-40);
        $this->Cell(50,10,'Vocal 1','T',0,'C');
        $this->SetXY(80,-40);
        $this->Cell(50,10,'Presidente','T',0,'C');
        $this->SetXY(145,-40);
        $this->Cell(50,10,'Vocal 2','T',0,'C');
        $this->SetXY(15,-25);
        $this->Cell(50,10,'Buenos Aires: .........................................................................................',0,0,'L');

        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
    }
}
?>;