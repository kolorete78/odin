<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//* @name Altafinales.pho
//* @author Prof. Ing. Pablo Eduardo Hernandez
//* @Fecha: Octubre 2016
//* @Funcion: este controlador sirve tiene 2 metodos, muestra la vista con todos los inscriptos a los finales
//* y deja hacer inscripciones a finales forzosas
//* @Perfiles: Admin y Bedel

class Lstmatfinal extends CI_Controller
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
        if(($_SESSION['rol'] <> "admin") AND ($_SESSION['rol'] <> "bedel"))
        {
            redirect('home');
        }


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