
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        /* Standard Libraries of codeigniter are required */
        $this->load->database();
        $this->load->helper('url');
        /* ------------------ */

        $this->load->library('grocery_CRUD');


    }

    public function index()
    {
        echo "<h1>Welcome to the world of Codeigniter</h1>";//Just an example to ensure that we get into the function
        print_r($_SESSION);
        die();

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

        $output = $this->grocery_crud->render();
        $this->_example_output($output);
    }

public function alumno_materia()
    {

        $this->grocery_crud->set_table('materia_alumno');

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

        $output = $this->grocery_crud->render();
        $this->_example_output($output);
    }



    function _example_output($output = null)

    {
        $this->load->view('Principal.php',$output);
    }

}

/* End of file main.php */
/* Location: ./application/controllers/main.php */

