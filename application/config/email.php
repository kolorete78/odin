

<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/*$config['protocol'] = 'sendmail';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['charset'] = 'iso-8859-1';
$config['wordwrap'] = TRUE;
*/
$config['protocol'] = 'smtp';
$config['smtp_host']='ssl://mail.ifts19.edu.ar';
$config['smtp_user']='odin@ifts19.edu.ar';
$config['smtp_pass']='e-mail-odin#';
$config['smtp_port']='465';
/* End of file config.php */
/* Location: ./application/config/config.php */

?>