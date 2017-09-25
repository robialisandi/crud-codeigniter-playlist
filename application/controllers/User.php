<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();
      $this->load->helper('url');
      $this->load->model('user_model');
      $this->load->library('session', 'email');
   }

   public function index()
   {
      $this->load->view("register.php");
   }

   public function register_user()
   {
      $user = array(
         'user_name' => $this->input->post('user_name'),
         'user_email' => $this->input->post('user_email'),
         'user_password' => md5($this->input->post('user_password')),
         'user_age' => $this->input->post('user_age'),
         'user_mobile' => $this->input->post('user_mobile')
      );

      print_r($user);

      $email_check = $this->user_model->email_check($user['user_email']);

      if($email_check)
      {


         //echo "<pre>";
         //die(print_r($user['user_email'], TRUE));

         if($this->user_model->sendEmail($user['user_email'], $user['user_name'])){
            $this->user_model->register_user($user);
            $this->session->set_flashdata('success_msg', 'Register successfully. Now login to your account!');
            redirect('user/login_view');
         }
         else
         {
            $this->session->set_flashdata('error_msg', 'Register error. try again!');
            redirect('user');
         }

      }
      else
      {
         $this->session->set_flashdata('error_msg', 'Error occured, try again!');
         redirect('user');
      }
   }

   function verify($hash=NULL)
   {
        if ($this->user_model->verifyEmailID($hash))
        {
            $this->session->set_flashdata('success_msg','<div class="alert alert-success text-center">Your Email Address is successfully verified! Please login to access your account!</div>');
            redirect('user/login_view');
        }
        else
        {
            $this->session->set_flashdata('error_msg','<div class="alert alert-danger text-center">Sorry! There is error verifying your Email Address!</div>');
            redirect('user/register');
        }
    }

   public function login_view()
   {
      $this->load->view("login.php");
   }

   function login_user()
   {
      $user_login=array(
         'user_email'=>$this->input->post('user_email'),
         'user_password'=>md5($this->input->post('user_password'))
      );
      //debugger
      // echo "<pre>";
      // die(print_r($user_login, TRUE));

      $data = $this->user_model->login_user($user_login['user_email'],$user_login['user_password']);
      if($data)
      {
         $status = $this->user_model->check_Status($user_login['user_email']);
         //echo "<pre>";
         //die(print_r($status, TRUE));

         if($status)
         {
            $this->session->set_userdata('user_id',$data['user_id']);
            $this->session->set_userdata('user_email',$data['user_email']);
            $this->session->set_userdata('user_name',$data['user_name']);
            $this->session->set_userdata('user_age',$data['user_age']);
            $this->session->set_userdata('user_mobile',$data['user_mobile']);

            //  echo "<pre>";
            //  die(print_r($this->session->userdata(), TRUE));

            redirect('book');
         }
         else
         {
            $this->session->set_flashdata('error_msg', 'Please open email to verified this account.');
            $this->load->view("login.php");
         }

      }
      else
      {
         $this->session->set_flashdata('error_msg', 'Error occured,Try again.');
         $this->load->view("login.php");
      }
   }

   function user_profile()
   {
      $this->load->view('user_profile.php');
   }

   public function user_logout()
   {
      $this->session->sess_destroy();
      redirect('user/login_view', 'refresh');
   }
}
?>
