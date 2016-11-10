<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @name: Login model
 * @author: Pablo Hernandez
 */
class Login_model extends CI_Model
{

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function validate_user($data) {
        //This method will have the credentials validation
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if($this->form_validation->run() == FALSE) {
            //Field validation failed.  User redirected to login page
            $this->load->view('login');
        }
        else {

            $this->db->where('username', $data['username']);
            $this->db->where('password', md5($data['password']));
            return $this->db->get('users')->row();
        //pablo@Loki:~$ echo -n "ifts192016" | md5sum
        //    82d593bca8f8ebcbbbe16d651adb48c7  -

        }
    }

    function __destruct() {
        $this->db->close();
    }
}