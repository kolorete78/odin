<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//* @name Inscfinales.php
//* @author Prof. Ing. Pablo Eduardo Hernandez
//* @Fecha: Octubre 2016
//* @Funcion: este controlador sirve para la inscripcion de los alumos en los finales
//* @Perfiles: Alumno

class Inscfinales extends CI_Controller
{

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
        if($_SESSION['rol'] <> "alumno")
            {
                redirect('home');
            }


        $this->load->database('default');
        $this->load->helper('url');
        $this->load->library('grocery_CRUD');
        $this->load->model('Altafinal_model');
        $this->load->helper('form');

    }

    function index(){


        $datos['arrMaterias'] = $this->Altafinal_model->get_materias();

        $this->load->view('formfinal', $datos);
    }

    function dropfechas(){

        $id_materia = $this->input->post('id',TRUE);

        $districtData['districtDrop']=$this->Altafinal_model->get_fechas($id_materia);
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

    function grabar(){

        $materia_id  = $_GET['materia_id'];
        $fecha = $_GET['fecha'];

         if ($fecha<>0 and isset($materia_id)){
             $materia_nombre = $this->Altafinal_model->materia_nombre($materia_id);
             $this->Altafinal_model->grabar_final($materia_id,$fecha);
            echo json_encode('Su inscripcion fue correcta para la materia: ' . $materia_nombre . ' en la fecha: ' . $fecha);
        }else
        {echo "Debe completar todos los campos";}


    }

}