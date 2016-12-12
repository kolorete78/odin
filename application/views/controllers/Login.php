<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @name Login.php
 * @author Imron rosdiana
 */
class Login extends CI_Controller
{


    function __construct() {
        parent::__construct();
        $this->load->model("login_model", "login");
         if(!empty($_SESSION['id_user']))
            $this->load->view("Principal.php"); //redirect('principal');
        $this->load->library('navigation',array('config' => 'navigation_bootstrap'));
        $this->load->helper('url');
    }

    public function index() {
        $navegador = new Navigation();
        if($_POST) {
            $result = $this->login->validate_user($_POST);
            if(!empty($result)) {
                $data = [
                    'id_user' => $result->id_user,
                    'username' => $result->username,
                    'mail'=> $result->mail,
                    'nombre'=>$result->nombre,
                    'rol' => $result->rol,
                ];
                $data['navigation'] = $navegador->generateNav_fromName($data['rol']);
                $this->session->set_userdata($data);
                redirect('home');
            } else {
                $this->session->set_flashdata('flash_data', 'Username or password is wrong!');
                redirect('login');
            }
        }

       $this->load->view("login");
    }
}