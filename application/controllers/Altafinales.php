<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//* @name Altafinales.pho
//* @author Prof. Ing. Pablo Eduardo Hernandez
//* @Fecha: Octubre 2016
//* @Funcion: este controlador sirve para gestionar las notas de los finales
//* @Perfiles: Admin y Bedel

class Altafinales extends CI_Controller {

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



        $this->load->database();
        $this->load->helper('url');
        $this->load->library('grocery_CRUD');


    }

    public function index()
    {
        $crud = new grocery_CRUD();
        $crud->set_table('fechafinales');
        $crud->columns('final_id','final_mat_id','final_fecha','final_comision','final_activa');


        $crud->display_as("final_mat_id","Materia");
        $crud->set_relation('final_mat_id','materia','materia_nombre');

        $output = $crud->render();
        $this->_example_output($output);

    }


   function _example_output($output = null)

    {
        $this->load->view('Principal.php',$output);
    }

}


