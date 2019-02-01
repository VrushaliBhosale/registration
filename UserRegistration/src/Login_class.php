<?php
namespace UserRegistration\Activity;
use UserRegistration\Activity\User;
require_once "vendor/autoload.php";


class Login_class extends User
{
    protected $client;
    public function __construct()
    {
        $this->client=new User();
    }

    public function login()
    {
      if($this->client->test_input())
      {
        if($this->client->isAdmin()){
            $_SESSION['admin']=$this->client->name;
            return "admin";   
        }
         else{
            if($this->client->select_query()=="already registered")
            {
                $istrue=$this->client->isVerified($_POST['email']);
            
                if($istrue)
                {
                    $_SESSION['name']=$this->client->name;
                   
                    return "guest";
                }
                else{      
                    return "verification_error";
                    }
            }
            return "register_error";
         } 
      }
     
    }
    public function rememberMe()
    {
        if(isset($_POST['test']))
        {
            setcookie('remember_name',$this->client->name);
            setcookie('remember_pass',$this->client->pass);
            print_r($_COOKIE['remember_name']);
            print_r($_COOKIE['remember_pass']);
        }
        
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header("location: login.php");
        return true;
    }
}
?>