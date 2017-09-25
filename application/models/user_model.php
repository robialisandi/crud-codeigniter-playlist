<?php

class User_model extends CI_Model
{


   public function register_user($user)
   {
      $this->db->insert('user', $user);
   }

   public function login_user($email,$pass)
   {
      $this->db->select('*');
      $this->db->from('user');
      $this->db->where('user_email',$email);
      $this->db->where('user_password',$pass);

      if($query=$this->db->get())
      {
         return $query->row_array();
      }
      else
      {
         return false;
      }
   }

   public function check_Status($email)
   {
      $this->db->select('*');
      $this->db->from('user');
      $this->db->where('user_email', $email);
      $this->db->where('status', 1);
      $query=$this->db->get();

      if($query->num_rows()>0)
      {
         return true;
      }
      else
      {
         return false;
      }
   }

   public function email_check($email)
   {
      $this->db->select('*');
      $this->db->from('user');
      $this->db->where('user_email',$email);
      $query=$this->db->get();

      if($query->num_rows()>0)
      {
         return false;
      }
      else
      {
         return true;
      }

   }

   public function sendEmail($to_email, $name)
   {
      $from_email = 'example@example.com'; //change this to yours
      $subject = 'Verify Your Email Address';
      //$message = 'Dear User,<br /><br />Please click on the below activation link to verify your email address.<br /><br /> http://localhost:90/codeigniter/user/verify/' . md5($to_email) . '<br /><br /><br />Thanks<br />Mydomain Team';

      $message = '<html>
                     <head>
                        <style>
                           .banner-color {
                           background-color: #eb681f;
                           }
                           .title-color {
                           color: #0066cc;
                           }
                           .button-color {
                           background-color: #0066cc;
                           }
                           @media screen and (min-width: 500px) {
                           .banner-color {
                           background-color: #0066cc;
                           }
                           .title-color {
                           color: #eb681f;
                           }
                           .button-color {
                           background-color: #eb681f;
                           }
                           }
                        </style>
                     </head>
                     <body>
                        <div style="background-color:#ececec;padding:0;margin:0 auto;font-weight:200;width:100%!important">
                           <table align="center" border="0" cellspacing="0" cellpadding="0" style="table-layout:fixed;font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
                              <tbody>
                                 <tr>
                                    <td align="center">
                                       <center style="width:100%">
                                          <table bgcolor="#FFFFFF" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;max-width:512px;font-weight:200;width:inherit;font-family:Helvetica,Arial,sans-serif" width="512">
                                             <tbody>
                                                <tr>
                                                   <td bgcolor="#F3F3F3" width="100%" style="background-color:#f3f3f3;padding:12px;border-bottom:1px solid #ececec">
                                                      <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;width:100%!important;font-family:Helvetica,Arial,sans-serif;min-width:100%!important" width="100%">
                                                         <tbody>
                                                            <tr>
                                                               <td align="left" valign="middle" width="50%"><span style="margin:0;color:#4c4c4c;white-space:normal;display:inline-block;text-decoration:none;font-size:12px;line-height:20px">Webinars</span></td>
                                                               <td valign="middle" width="50%" align="right" style="padding:0 0 0 10px"><span style="margin:0;color:#4c4c4c;white-space:normal;display:inline-block;text-decoration:none;font-size:12px;line-height:20px">Tuesday 14, February 2017</span></td>
                                                               <td width="1">&nbsp;</td>
                                                            </tr>
                                                         </tbody>
                                                      </table>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td align="left">
                                                      <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
                                                         <tbody>
                                                            <tr>
                                                               <td width="100%">
                                                                  <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
                                                                     <tbody>
                                                                        <tr>
                                                                           <td align="center" bgcolor="#8BC34A" style="padding:20px 48px;color:#ffffff" class="banner-color">
                                                                              <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
                                                                                 <tbody>
                                                                                    <tr>
                                                                                       <td align="center" width="100%">
                                                                                          <h1 style="padding:0;margin:0;color:#ffffff;font-weight:500;font-size:20px;line-height:24px">Confirmation email</h1>
                                                                                       </td>
                                                                                    </tr>
                                                                                 </tbody>
                                                                              </table>
                                                                           </td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td align="center" style="padding:20px 0 10px 0">
                                                                              <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
                                                                                 <tbody>
                                                                                    <tr>
                                                                                       <td align="center" width="100%" style="padding: 0 15px;text-align: justify;color: rgb(76, 76, 76);font-size: 12px;line-height: 18px;">
                                                                                          <h3 style="font-weight: 600; padding: 0px; margin: 0px; font-size: 16px; line-height: 24px; text-align: center;" class="title-color">Hi '. $name .',</h3>
                                                                                          <p style="margin: 20px 0 30px 0;font-size: 15px;text-align: center;">Thanks you for register, to confirmatin the account. So click link in below !</p>
                                                                                          <div style="font-weight: 200; text-align: center; margin: 25px;"><a style="padding:0.6em 1em;border-radius:600px;color:#ffffff;font-size:14px;text-decoration:none;font-weight:bold" class="button-color" href="http://localhost:90/codeigniter/user/verify/' . md5($to_email) . '">Confirm</a></div>
                                                                                       </td>
                                                                                    </tr>
                                                                                 </tbody>
                                                                              </table>
                                                                           </td>
                                                                        </tr>
                                                                        <tr>
                                                                        </tr>
                                                                        <tr>
                                                                        </tr>
                                                                     </tbody>
                                                                  </table>
                                                               </td>
                                                            </tr>
                                                         </tbody>
                                                      </table>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td align="left">
                                                      <table bgcolor="#FFFFFF" border="0" cellspacing="0" cellpadding="0" style="padding:0 24px;color:#999999;font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
                                                         <tbody>
                                                            <tr>
                                                               <td align="center" width="100%">
                                                                  <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
                                                                     <tbody>
                                                                        <tr>
                                                                           <td align="center" valign="middle" width="100%" style="border-top:1px solid #d9d9d9;padding:12px 0px 20px 0px;text-align:center;color:#4c4c4c;font-weight:200;font-size:12px;line-height:18px">Regards,
                                                                              <br><b>The Awesome Team</b>
                                                                           </td>
                                                                        </tr>
                                                                     </tbody>
                                                                  </table>
                                                               </td>
                                                            </tr>
                                                            <tr>
                                                               <td align="center" width="100%">
                                                                  <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
                                                                     <tbody>
                                                                        <tr>
                                                                           <td align="center" style="padding:0 0 8px 0" width="100%"></td>
                                                                        </tr>
                                                                     </tbody>
                                                                  </table>
                                                               </td>
                                                            </tr>
                                                         </tbody>
                                                      </table>
                                                   </td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </center>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </body>
                  </html>';

        $config = Array(
         'protocol' => 'smtp',
         'smtp_host' => 'ssl://smtp.gmail.com',
         'smtp_port' => 465,
         'smtp_user' => $from_email,
         'smtp_pass' => '********s',
         'mailtype'  => 'html',
         'charset'   => 'iso-8859-1'
         );
         $this->load->library('email', $config);
         $this->email->set_newline("\r\n");


        //send mail
        $this->email->from($from_email, 'Store App');
        $this->email->to($to_email);
        $this->email->subject($subject);
        $this->email->message($message);
        return $this->email->send();
    }

    //activate user account
    public function verifyEmailID($key)
    {
        $data = array('status' => 1);
        $this->db->where('md5(user_email)', $key);
        return $this->db->update('user', $data);
    }


}
?>
