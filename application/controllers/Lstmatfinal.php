<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lstmatfinal extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('grocery_CRUD');
    }

    public function index()
    {
        $crud = new grocery_CRUD();
        $crud->set_subject('Inscriptos a Finales');
        $crud->set_table('Inscriptos');
        $crud->set_primary_key('inscfinal_id','Inscriptos');
        $crud->unset_add();
        $crud->unset_edit();
        $crud->unset_delete();
        $crud->unset_read();
        $output = $crud->render();
        $this->_example_output($output);

    }

    public function modificar()
    {

        $crud = new grocery_CRUD();
        $crud->set_subject('Inscriptos a Finales');
        $crud->set_table('inscripcionfinales');


        $crud->set_relation('insfinal_alumno_id','alumno','alumno_nombre');

        $output = $crud->render();
        $this->_example_output($output);
    }

    function _example_output($output = null)

    {
        $this->load->view('Principal.php', $output);
    }
}