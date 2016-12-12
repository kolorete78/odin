<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//* @name Lstmatinsc.php
//* @author Prof. Ing. Pablo Eduardo Hernandez
//* @Fecha: Octubre 2016
//* @Funcion: este controlador sirve tiene 2 metodos, muestra la lista de alumnos que se inscribieron a cierta materia
//* @Perfiles: Admin y Bedel


class Lstmatinsc extends CI_Controller
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