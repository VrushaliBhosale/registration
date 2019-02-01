<?php
namespace UserRegistration\Activity;
use UserRegistration\Activity\User;

require_once "vendor/autoload.php";


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';


class Register_class extends User
{
    protected $client;
    protected $to;
    protected $subject;
    protected $role;
   
   // public $email;
    public function __construct()
    {
        $this->client=new User();
       // $this->email=$this->client->email;
    }

    public function register($roles)
    {
        $this->role=$roles;
        $this->client->test_input();
        switch(($this->client)->select_query())
        {
            case "table is empty": if(($this->client)->select_query()=="table is empty")
                                  {
                                     $role="admin";
                                     if(($this->client)->insert_query($this->role))
                                        {
                                            echo "admin registered";
                                            return true;
                                         }
                                         return false;
                                    }
                                    
                                   break;
                                   
            case "already registered": return false; 
            
            case "not registered":if(($this->client)->insert_query($this->role))
                                  {
                                      return "registering guest";
                                  }
                                  else{
                                    return false;
                                  }
                                  break;
        }
        return false;
    }

    public function verifyMail($email)
    {
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com;';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'alshayakapoor@gmail.com';                 // SMTP username
            $mail->Password = 'Vrushali@123';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to
            $mail->Timeout = 3600;
        
            $mail->From = "alshayakapoor@gmail.com";
            //Recipients
            $mail->setFrom('alshayakapoor@gmail.com', 'Mailer');
             $mail->addAddress($email, 'Joe User');     // Add a recipient
                        // Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
        
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Here is the subject';
            $mail->Body    = '
            
             
            Thanks for signing up!
            Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
             
            ------------------------
            Username: '.$_POST['name'].'
            ------------------------
             
            Please click this link to activate your account:
            http://localhost:8888/registration/UserRegistration/verify.php?email='.$email.'&hash='.$this->client->hash.'
            ';
           
            $mail->AltBody = '
           
            ';
        
            $mail->send();
           return true;
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }

        return true;
    }
 }  
?>