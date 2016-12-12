<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends CI_Controller
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

    public function roles()
        {

            // Roles
            $crud = new grocery_CRUD();

            $crud->set_table('CI-Nav-Menus');

            $crud->set_language('spanish');
            $output = $crud->render();
            $this->_example_output($output);
        }

    public function items()
    {

        // Roles
        $crud = new grocery_CRUD();

        $crud->set_table('CI-Nav-Items');
        $crud->columns('ItemID','ItemName','ItemHumanName','ItemLink','ParentItem');
        $crud->set_language('spanish');
        $output = $crud->render();
        $this->_example_output($output);
    }

    public function menu()
    {

        // Menus
        $crud = new grocery_CRUD();

        $crud->set_table('CI-Nav-InMenu');
        $crud->unset_columns('NavInmenuid','MenuID','ItemID','ItemID');

        $crud->set_relation('ItemID','CI-Nav-Items','ItemID');

        $crud->set_relation('MenuID','CI-Nav-Menus','MenuID');

        $crud->set_language('spanish');
        $output = $crud->render();
        $this->_example_output($output);
    }


    function _example_output($output = null)

        {
            $this->load->view('Principal.php', $output);
        }
}