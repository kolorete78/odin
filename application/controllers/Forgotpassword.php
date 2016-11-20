<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @name Login.php
 * @author Imron rosdiana
 */
class Forgotpassword extends CI_Controller
{


    function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->database('default');

    }

    public function index()
    {

        $this->load->view("forgotpwd");
    }

    public function doforget()
    {

        $email = $_POST['email'];
        $sql="select * from users where mail='" . $email . "'";
        $query= $this->db->query($sql);
        $row = $query->row();

        if (isset($row))
        {

            $user= $row->id_user;
            $this->resetpassword($user);
            $info = urlencode(htmlentities('La contraseña fue cambiada, se envio la nueva a la siguiente dirección de mail: ' .
                $email .'. Haga click aqui para volver a entrar: ',ENT_QUOTES,"UTF-8"));
            $this->load->view('forgotpwd', $info);
            redirect('forgotpassword/forget?info=' . $info, 'refresh');

        } else{
                $error = htmlspecialchars("El email que usted ingreso no se encuentra registrada en nuestra base datos",ENT_QUOTES);
                redirect('forgotpassword/forget?error=' . $error, 'refresh');
                }
    }

    public function forget()
    {
        if (isset($_GET['info'])) {
            $data['info'] = $_GET['info'];
        }
        if (isset($_GET['error'])) {
            $data['error'] = $_GET['error'];
        }

        $this->load->view('forgotpwd', $data);
    }


    private function resetpassword($user)
    {
        date_default_timezone_set('America/Buenos_Aires');
        $this->load->helper('string');
        $this->load->helper('security');

        $ramdon_pass= random_string('alnum', 16);

        $password = md5($ramdon_pass);

        $this->db->where('id_user', $user);
        $this->db->update('users', array('password' => $password));
        $this->load->library('email');
        $this->email->from('odin@ifts19.edu.ar', 'Odin IFTS19');
        $this->email->reply_to('noreply@noreply.com','noreply');
        $this->email->to($_POST['email']);
        $this->email->subject('Reseteo de Contraseña');
        $this->email->message('Usted solicito un blanqueo de contraseña, su nueva contraseña es la siguiente:' . $ramdon_pass);
        $this->email->send();
    }
}