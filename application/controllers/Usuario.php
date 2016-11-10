<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Controller
{

    function __construct()
        {
            parent::__construct();

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

            $crud->where('id_user =', $_SESSION['id_user']);
            $crud->unset_delete();
            $crud->unset_add();
            $crud->unset_read();
            $crud->unset_export();
            $crud->change_field_type('password','password');
            $crud->display_as("username","DNI");
            //$crud->callback_before_insert(array($this,'encrypt_password_callback'));
            $crud->callback_before_update(array($this,'encrypt_password_callback'));
            $crud->columns('nombre','mail','username','password','rol');
            //Cambiamos algunos campos a solo lectura
                $state = $crud->getState();
                $state_info = $crud->getStateInfo();

            if($state == 'edit')
                {
                    $crud->field_type('nombre','readonly');
                    $crud->field_type('mail','readonly');
                    $crud->field_type('username','readonly');
                    $crud->field_type('rol','hidden');

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