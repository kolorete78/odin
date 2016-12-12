<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//* @name Inscfinales.php
//* @author Prof. Ing. Pablo Eduardo Hernandez
//* @Fecha: Octubre 2016
//* @Funcion: este controlador sirve para la inscripcion de los alumos a las materias
//* @Perfiles: Alumno



class Inscmaterias extends CI_Controller
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

        /* Standard Libraries of codeigniter are required */
        $this->load->database('default');
        $this->load->helper('url');
        /* ------------------ */
        $this->load->library('grocery_CRUD');


    }

    public function index()
    {
        //Para traer el ID del alumno

        if(!empty($_SESSION['id_user']))
        {
            $sql = ("SELECT alumno_id FROM alumno WHERE `alumno_dni`={$_SESSION['username']}");
            $query= $this->db->query($sql);
            $row = $query->row();

            if (isset($row))
            {
                $condicion= $row->alumno_id;
            }
        }

        $crud = new grocery_CRUD();

        $crud->set_table('inscripcionmaterias');
        $crud->field_type('inscmat_alumno_id','hidden',$condicion);

        $crud->unset_columns('inscmat_alumno_id');

        $crud->display_as("inscmat_materia_id","Materia");
        $crud->set_relation('inscmat_materia_id','materia','materia_nombre');

        //$crud->display_as("inscmat_alumno_id","Alumno");
        //$crud->set_relation('inscmat_alumno_id','alumno','alumno_nombre');

        $crud->display_as('inscmat_cuat_id','Cuatrimestre');
        $crud->set_relation('inscmat_cuat_id','cuatrimestres','cuatrimestre_nombre');



        $crud->where('inscmat_alumno_id =', $condicion);

        $crud->unset_read();
        $crud->unset_edit();

        $output = $crud->render();
        $this->_example_output($output);

    }


    function _example_output($output = null)

    {
        $this->load->view('Principal.php', $output);
    }
}