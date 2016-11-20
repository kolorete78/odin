<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @name Home.php
 * @author Imron Rosdiana
 */
class Home extends CI_Controller
{

    function __construct() {
        parent::__construct();

        if(empty($this->session->userdata('id_user'))) {
            $this->session->set_flashdata('flash_data', 'Usted no tiene permiso!');
            redirect('login');
        }
    }


    public function index() {
        $this->load->view('home');
    }

    public function logout() {
        $data = ['id_user', 'username','mail','nombre','rol','navigation'];
        $this->session->unset_userdata($data);

        redirect('login');
    }
}