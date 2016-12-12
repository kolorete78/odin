<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actavolante extends CI_Controller {
    function __construct()
    {
        parent::__construct();

        $this->load->database('default');
        $this->load->helper('url');
        $this->load->library('grocery_CRUD');
        $this->load->model('Actavolante_model');
        $this->load->helper('form');
        $this->load->helper('download');

    }

    public function index()
    {
        $datos['arrMaterias'] = $this->Actavolante_model->get_materias();
        $datos['arrCarrera']=$this->Actavolante_model->get_carrera();
        $this->load->view('actavolante_view.php', $datos);
    }

    function dropfechas()
    {

        $id_materia = $this->input->post('id',TRUE);

        $districtData['districtDrop']=$this->Actavolante_model->get_fechas($id_materia);
        $output = null;


        if (!empty ($districtData)) {
            foreach ($districtData['districtDrop'] as $row) {

                $output .= "<option value='" . $row->final_fecha . "'>" . $row->final_fecha . "</option>";
            }
        }
        if($districtData = null)
        {
            $output = "<option value='Seleccionar'> Seleccionar</option>";
        }



        echo $output;

    }

    public function generar()
    {


        $materia_id  = $_GET['materia_id'];

        $materia_nombre  = $_GET['materia_nombre'];

        $fecha = $_GET['fecha'];


        $carrera = $_GET['carrera'];


        $cuatrimestre = $_GET['cuatrimestre'];


        $comision = $_GET['comision'];


        $materia_codigo = $this->Actavolante_model->materia_codigo($materia_id);

             // Se carga la libreria fpdf
        $this->load->library('pdf');

        // Se obtienen los alumnos de la base de datos
        $alumnos = $this->Actavolante_model->obtenerListaAlumnos($materia_id,$fecha,$comision);

        // Creacion del PDF

        /*
         * Se crea un objeto de la clase Pdf, recuerda que la clase Pdf
         * heredó todos las variables y métodos de fpdf
         */
        $pdf = new Pdf();


        //Seteamos las propiesdasd de la clase
        $pdf->carrera_nombre=$carrera;
        $pdf->materia_codigo=$materia_codigo;
        $pdf->materia_nombre=$materia_nombre;
        $pdf->fecha=$fecha;
        $pdf->cuatrimestre=$cuatrimestre;
        $pdf->comision=$comision;


        // Agregamos una página

        // Define el alias para el número de página que se imprimirá en el pie
        $pdf->AliasNbPages();

        // La variable $x se utiliza para mostrar un número consecutivo
        $x = 1;

        foreach ($alumnos as $alumno) {

            if (($x==1) OR ($x==24) OR ($x==47) OR ($x==70) OR ($x==93) OR ($x==116)) { //para ver los multiplos de 24

                /* Se define el titulo, márgenes izquierdo, derecho y
                 * el color de relleno predeterminado
                 */
                $pdf->AddPage();
                $pdf->SetTitle("Lista de alumnos");
                $pdf->SetLeftMargin(15);
                $pdf->SetRightMargin(15);
                $pdf->SetFillColor(200, 200, 200);

                // Se define el formato de fuente: Arial, negritas, tamaño 9
                $pdf->SetFont('Arial', 'B', 9);
                /*
                 * TITULOS DE COLUMNAS
                 *
                 * $pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
                 */

                $pdf->Cell(15, 7, 'Num', 'TLR', 0, 'C', '1');
                $pdf->Cell(20, 7, 'DNI', 'TLR', 0, 'L', '1');
                $pdf->Cell(60, 7, 'Alumno', 'TLR', 0, 'L', '1');
                $pdf->Cell(30, 7, 'Examen Escrito', 'TLR', 0, 'C', '1');
                $pdf->Cell(25, 7, 'Examen Oral', 'TLR', 0, 'C', '1');
                $pdf->Cell(35, 7, 'Calificacion definitiva', 'TLR', 0, 'C', '1');
                $pdf->Ln(7);
                $pdf->Cell(15, 7, '', 'BLR', 0, 'C', '1');
                $pdf->Cell(20, 7, '', 'BLR', 0, 'L', '1');
                $pdf->Cell(60, 7, '', 'BLR', 0, 'L', '1');
                $pdf->Cell(30, 7, 'Numero | Letra', 'TBLR', 0, 'C', '1');
                $pdf->Cell(25, 7, 'Numero | Letra', 'TBLR', 0, 'C', '1');
                $pdf->Cell(35, 7, 'Numero | Letra', 'TBLR', 0, 'C', '1');
                $pdf->Ln(7);
            }


            // se imprime el numero actual y despues se incrementa el valor de $x en uno
            $pdf->Cell(15,5,$x++,'TBLR',0,'C',0);
            // Se imprimen los datos de cada alumno
            $pdf->Cell(20,5,$alumno->DNI,'TBLR',0,'C',0);
            $pdf->Cell(60,5,$alumno->Alumno,'TBLR',0,'L',0);
            $pdf->Cell(30,5,'','TBLR',0,'C',0);
            $pdf->Cell(25,5,'','TBLR',0,'C',0);
            $pdf->Cell(35,5,'','TBLR',0,'C',0);

            //Se agrega un salto de linea
            $pdf->Ln(5);
        }
        /*
         * Se manda el pdf al navegador
         *
         * $pdf->Output(nombredelarchivo, destino);
         *
         * I = Muestra el pdf en el navegador
         * D = Envia el pdf para descarga
         *
         */
       $pdf->Output(FCPATH . "/downloads/" . $materia_nombre . "-" . $fecha . "-" . $comision .".pdf", 'F');
        force_download(FCPATH . "downloads/" . $materia_nombre . "-" . $fecha . "-" . $comision .".pdf",FCPATH . "downloads/" . $materia_nombre . "-" . $fecha . "-" . $comision .".pdf",TRUE);
    }





}
