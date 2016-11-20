<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actavolante extends CI_Controller {
    function __construct()
    {
        parent::__construct();

        /* Me fijo si tengo un usuario valido*/
        if(empty($_SESSION['id_user']))
        {
            $this->session->set_flashdata('flash_data','Debe estar logueado para operar ');
            redirect('login');
        }

        /* Me fijo si el perfil del usuario corresponde con el rol que deberia ser para esta clase*/
        if($_SESSION['rol'] = "alumno")
      //  {
      //      redirect('home');
      //  }


        $this->load->database('default');
        $this->load->helper('url');
        $this->load->library('grocery_CRUD');
        $this->load->model('Actavolante_model');
        $this->load->helper('form');

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


    public function mpdf()
    {
        $data = [];
        //load the view and saved it into $html variable
        $html=$this->load->view('actavolante', $data, true);

        //this the the PDF filename that user will get to download
        $pdfFilePath = "output_pdf_name.pdf";

        //load mPDF library
        $this->load->library('m_pdf');

        //generate the PDF from the given html
        $this->m_pdf->pdf->WriteHTML($html);

        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "C");
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */