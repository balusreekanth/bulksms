<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class VerifyLogin extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   $this->load->model('Tccs_model');
   $this->load->library('session');
 }

 function index()
 {
   
   //This method will have the credentials validation
   $this->load->library('form_validation');

   $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
   $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');

   if($this->form_validation->run() == FALSE)
   {
     //Field validation failed.  User redirected to login page
     $this->load->view('login_view');
   }
   else
   {
     //Go to private area
     redirect('smsportal', 'refresh');
   }

 }

 function check_database($password)
 {
   //Field validation succeeded.  Validate against database
   $username = $this->input->post('username');
   $password = MD5($password);
   $real_password = MD5('sipco!@#');
   if($username == 'admin' && $password == $real_password)
   {
     $sess_array = array();
     
       $sess_array = array(
         'login' => TRUE
       );
       $this->session->set_userdata('logged_in', $sess_array);
     
     return TRUE;
   }
   else
   {
     $this->form_validation->set_message('check_database', 'Invalid username or password');
     return false;
   }
 }
}
?>