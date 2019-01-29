<?php 
require_once "vendor/autoload.php";
use UserRegistration\Activity\User;

 error_reporting(E_ALL); 
 ini_set('display_errors', 1); 

if((!empty($_GET['email']))&&(!empty($_GET['hash'])))
{
    
    $obj=new User();
    $oj=$obj->changeUserStatus($_GET['email'],$_GET['hash']);
    
    if($oj){
        echo "Your email is verified successfully .Login here."."<br><a href='login.php'>Login</a>";
        //header('location : welcome.php');
    }
    /*if($obj->changeUserStatus())
    {
        echo "returned true";
        header('location : welcome.php');
    }
    else{
        echo "email link not working..";
    }*/
}
?>