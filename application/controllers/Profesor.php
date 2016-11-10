<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profesor extends CI_Controller
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

    public function notas()
        {
        //Para traer el ID del profesor

            if(!empty($_SESSION['id_user']))
               {
                $sql = ("SELECT profesor_id FROM profesor WHERE `profesor_dni`={$_SESSION['username']}");
                $query= $this->db->query($sql);
                $row = $query->row();

                    if (isset($row))
                        {
                        $condicion= $row->profesor_id;
                        }
                }



            $crud = new grocery_CRUD();

            $crud->set_table('materia_alumno');
            $crud->set_theme('datatables');


            $crud->unset_columns('profesor_id');
            $crud->unset_delete();
            $crud->unset_add();

            $crud->unset_fields('profesor_id');

                //Cambiamos algunos campos a solo lectura
                $state = $crud->getState();
                $state_info = $crud->getStateInfo();

                if($state == 'edit')
                {
                    $crud->field_type('carrera_id','readonly');
                    $crud->field_type('materia_id','readonly');
                    $crud->field_type('alumno_id','readonly');
                    $crud->field_type('fecha_final','hidden');
                    $crud->field_type('Final','hidden');
                }

            $crud->display_as("carrera_id","Carrera");
            $crud->set_relation('carrera_id','carrera','carrera_nombre');

            $crud->display_as("materia_id","Materia");
            $crud->set_relation('materia_id','materia','materia_nombre');

            $crud->display_as("alumno_id","Alumno");
            $crud->set_relation('alumno_id','alumno','alumno_nombre');

            $crud->set_language('spanish');

            $crud->where('profesor_id =', $condicion);

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