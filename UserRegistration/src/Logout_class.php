<?php
namespace UserRegistration\Activity;
use UserRegistration\Activity\User;
require_once "vendor/autoload.php";
//session_start();
class Logout_class
{
    public function logout()
    {
         var_dump($_SESSION['admin']);
        if(isset($_SESSION['name']))
        {
            session_unset();
            session_destroy();
            header("location:login.php");
        }
        if(isset($_SESSION['admin']))
        {
            session_unset();
            session_destroy();
            header("location:login.php");
        }
    }
}
?>