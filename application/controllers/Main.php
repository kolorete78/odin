
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//* @name Altafinales.php
//* @author Prof. Ing. Pablo Eduardo Hernandez
//* @Fecha: Octubre 2016
//* @Funcion: este controlador sirve para gestionar ABM profesores, ABM materieas, asignacion de materia a profesor
//* @ ABM alumnos, asignacion de alumnos a materias
//* @Perfiles: Admin y Bedel

class Main extends CI_Controller {

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
        if(($_SESSION['rol'] <> "admin") AND ($_SESSION['rol'] <> "bedel"))
        {
            redirect('home');
        }


        /* Standard Libraries of codeigniter are required */
        $this->load->database();
        $this->load->helper('url');
        /* ------------------ */

        $this->load->library('grocery_CRUD');


    }

    public function index()
    {
      redirect('home');

    }

    public function profesor()
    {
        $this->grocery_crud->set_table('profesor');
        $output = $this->grocery_crud->render();
        $this->_example_output($output);
    }

    public function materia()
    {
        $this->grocery_crud->set_table('materia');
        $this->grocery_crud->display_as("materia_carrera_id","Carrera");
        $this->grocery_crud->set_relation('materia_carrera_id','carrera','carrera_nombre');


        $output = $this->grocery_crud->render();
        $this->_example_output($output);
    }

    public function materia_profesor()
    {
        $this->grocery_crud->set_table('materia_profesor');

        $this->grocery_crud->display_as("carrera_id","Carrera");
        $this->grocery_crud->set_relation('carrera_id','carrera','carrera_nombre');

        $this->grocery_crud->display_as("materia_id","Materia");
        $this->grocery_crud->set_relation('materia_id','materia','materia_nombre');

        $this->grocery_crud->display_as("profesor_id","Profesor");
        $this->grocery_crud->set_relation('profesor_id','profesor','profesor_nombre');

        $output = $this->grocery_crud->render();
        $this->_example_output($output);
    }

    public function alumnos()
    {
        $this->grocery_crud->set_table('alumno');
        $this->grocery_crud->set_subject('Alumno');
        $this->grocery_crud->required_fields('alumno_nombre','alumno_legajo','alumno_dni','comision');

        $output = $this->grocery_crud->render();
        $this->_example_output($output);
    }

    public function alumno_materia()
    {

        $this->grocery_crud->set_table('materia_alumno');
        $this->grocery_crud->set_subject('Inscripcion');
        $this->grocery_crud->required_fields('carrera_id','materia_id','alumno_id','profesor_id');


        $this->grocery_crud->display_as("carrera_id","Carrera");
        $this->grocery_crud->set_relation('carrera_id','carrera','carrera_nombre');

        $this->grocery_crud->display_as("materia_id","Materia");
        $this->grocery_crud->set_relation('materia_id','materia','materia_nombre');

        $this->grocery_crud->display_as("alumno_id","Alumno");
        $this->grocery_crud->set_relation('alumno_id','alumno','alumno_nombre');

        $this->grocery_crud->display_as("profesor_id","Profesor");
        $this->grocery_crud->set_relation('profesor_id','profesor','profesor_nombre');


        $this->grocery_crud->display_as("1Parcial","Primer Parcial");
        $this->grocery_crud->display_as("2Parcial","Segundo Parcial");
        $this->grocery_crud->display_as("1Recu","Primer Recuperatorio");
        $this->grocery_crud->display_as("2Recu","Segundo Recuperatorio");


        $this->grocery_crud->columns('alumno_id','carrera_id','profesor_id','materia_id','1Parcial',
            '2Parcial','1Recu','2Recu','tp','Final','fecha_final' );
        $this->grocery_crud->add_fields('alumno_id','carrera_id','profesor_id','materia_id','1Parcial',
            '2Parcial','1Recu','2Recu','tp','Final','fecha_final');
        $this->grocery_crud->edit_fields('alumno_id','carrera_id','profesor_id','materia_id','1Parcial',
            '2Parcial','1Recu','2Recu','tp','Final','fecha_final' );


        $output = $this->grocery_crud->render();
        $this->_example_output($output);
    }



    function _example_output($output = null)

    {
        $this->load->view('Principal.php',$output);
    }

}


