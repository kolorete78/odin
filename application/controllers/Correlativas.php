<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Correlativas extends CI_Controller
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
        $crud->set_table('correlativas');

        $crud->display_as("materia_id","Materia");
        $crud->set_relation('materia_id','materia','materia_nombre');

        $crud->display_as("correlativa1_id","Correlativa 1");
        $crud->set_relation('correlativa1_id','materia','materia_nombre');

        $crud->display_as("correlativa2_id","Correlativa 2");
        $crud->set_relation('correlativa2_id','materia','materia_nombre');

        $crud->display_as("correlativa3_id","Correlativa 3");
        $crud->set_relation('correlativa3_id','materia','materia_nombre');

        $output = $crud->render();
        $this->_example_output($output);
    }


    function _example_output($output = null)

    {
        $this->load->view('Principal.php', $output);
    }
}