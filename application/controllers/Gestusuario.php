<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//* @name GestUsuario.php
//* @author Prof. Ing. Pablo Eduardo Hernandez
//* @Fecha: Noviembre 2016
//* @Funcion: este controlador sirve para la gestion de los usuarios
//* @Perfiles: Bedel y Admin

class Gestusuario extends CI_Controller
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
            //$this->load->library('grocery_crud_categories') ;
            /* ------------------ */
            $this->load->library('grocery_CRUD');


        }

    public function index()
        {

            $crud = new grocery_CRUD();

            $crud->set_table('users');
            $crud->unset_delete();
            $crud->change_field_type('password','password');
            $crud->display_as("username","DNI");
            $crud->callback_before_update(array($this,'encrypt_password_callback'));
            $crud->callback_before_insert(array($this,'encrypt_password_callback'));
            $crud->required_fields('username','mail','nombre','password','rol');
                //Cambiamos algunos campos a solo lectura
            $state = $crud->getState();
            $crud->edit_fields('mail','nombre','password');

            if($state == 'edit')
                {
                    $crud->field_type('username','readonly');
                    $crud->field_type('rol','readonly');
                    }


            $output = $crud->render();

            $this->_example_output($output);

        }


    function encrypt_password_callback($post_array, $primary_key = null)
    {
        $this->load->helper('security');
        $post_array['password'] = do_hash($post_array['password'], 'md5');
        return $post_array;
    }

    function _example_output($output = null)

        {
            $this->load->view('Principal.php', $output);
        }
}