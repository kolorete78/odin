<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lstmatinsc extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        /* Standard Libraries of codeigniter are required */
        $this->load->database('default');
        $this->load->helper('url');
        /* ------------------ */
        $this->load->library('grocery_CRUD');


    }

    public function index()
    {
        $crud = new grocery_CRUD();

        $crud->set_table('inscripcionmaterias');
        //$crud->field_type('inscmat_alumno_id','hidden',$condicion);

        //$crud->unset_columns('inscmat_alumno_id');

        $crud->display_as("inscmat_materia_id","Materia");
        $crud->set_relation('inscmat_materia_id','materia','materia_nombre');

        $crud->display_as("inscmat_alumno_id","Alumno");
        $crud->set_relation('inscmat_alumno_id','alumno','alumno_nombre');

        $crud->display_as('inscmat_cuat_id','Cuatrimestre');
        $crud->set_relation('inscmat_cuat_id','cuatrimestres','cuatrimestre_nombre');

        //$crud->where('inscmat_alumno_id =', $condicion);

        //$crud->unset_read();
        //$crud->unset_edit();

        $output = $crud->render();
        $this->_example_output($output);

    }


    function _example_output($output = null)

    {
        $this->load->view('Principal.php', $output);
    }
}