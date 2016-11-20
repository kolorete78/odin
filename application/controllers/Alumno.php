<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//* @name Altafinales.php
//* @author Prof. Ing. Pablo Eduardo Hernandez
//* @Fecha: Octubre 2016
//* @Funcion: este controlador sirve para mostrar las notas de los alumnos
//* @Perfiles: Alumno

class Alumno extends CI_Controller
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

    public function notas()
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

        $crud->set_table('materia_alumno');

        $crud->unset_columns('profesor_id','1Parcial','2Parcial','1Recu','2Recu','tp');
        $crud->unset_delete();
        $crud->unset_add();
        $crud->unset_read();
        $crud->unset_edit();

        $crud->unset_fields('profesor_id');

        $crud->display_as("carrera_id","Carrera");
        $crud->set_relation('carrera_id','carrera','carrera_nombre');

        $crud->display_as("materia_id","Materia");
        $crud->set_relation('materia_id','materia','materia_nombre');

        $crud->display_as("alumno_id","Alumno");
        $crud->set_relation('alumno_id','alumno','alumno_nombre');

        $crud->set_language('spanish');

        $crud->where('materia_alumno.alumno_id =', $condicion);

        $crud->display_as("1Parcial","Primer Parcial");
        $crud->display_as("2Parcial","Segundo Parcial");
        $crud->display_as("1Recu","Primer Recuperatorio");
        $crud->display_as("2Recu","Segundo Recuperatorio");

        $output = $crud->render();

        $this->_example_output($output);

    }

    function _example_output($output = null)

    {
        $this->load->view('Principal.php', $output);
    }
}