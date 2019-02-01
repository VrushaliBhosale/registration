<?php
namespace UserRegistration\Activity;

require_once "vendor/autoload.php";
use UserRegistration\Activity\Login_class;
session_start();

if(!isset($_SESSION['name']))
{
     if(!isset($_SESSION['admin']))
       {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>LOGIN Page</h1>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
    <?php
    
    ?>
    Name:  <input name="name" type="text" required value="<?php echo (isset($_COOKIE['remember_name']))?$_COOKIE['remember_name']:'' ?>"><br><br>
    Email: <input name="email" type="email" required value="<?php echo (isset($_COOKIE['remember_email']))?$_COOKIE['remember_email']:'' ?>"><br><br>
    Password:<input name="password" type="password" required value="<?php echo (isset($_COOKIE['remember_pass']))?$_COOKIE['remember_pass']:'' ?>"><br><br>
    <input type="checkbox" name="test" value="value1">Remember me<br><br>
    <input type="submit" value="Login">
    <a href="registration.php?">Register</a>
    </form>
</body>
</html>

<?php

print_r($_SESSION['admin']) ;
if($_SERVER["REQUEST_METHOD"] == "POST")  
 {
     $obj=new Login_class();
     $error=$obj->login();
     switch($error)
     {
        case "admin": header("location:admin.php");
                      break;
         
        case "guest": header("location:welcome.php");
                        if(!empty($_POST['test']))  
                        {
                            setcookie('remember_name',$_POST['name']);
                            setcookie('remember_email',$_POST['email']);
                            setcookie('remember_pass',$_POST['password']);
                        
                        }
                        else{
                            
                            setcookie('remember_name',"");
                            setcookie('remember_email',"");
                            setcookie('remember_pass',"");
                            
                        }
                      break;    
                      
        case "verification_error": echo "verify your email first";
                                   break;               

        case "register_error": echo "register first";
                      break;             
                      
       }
     }
 }
 else{
    echo "Admin has already logged in <a href='admin.php'>Go to HOme</a>";
  }
}
else{
    
    echo "You are already logged in <a href='welcome.php'>Go to HOme</a>";
}
?>



