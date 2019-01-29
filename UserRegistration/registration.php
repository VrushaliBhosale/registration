<?php
require_once "vendor/autoload.php";
use UserRegistration\Activity\Register_class;

session_start();
if(!isSet($_SESSION['name']))
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
<h1>Registration Page</h1>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
    Name:  <input name="name" type="text" required><br><br>
    Email: <input name="email" type="email" required><br><br>
    Password:<input name="password" type="password" required><br><br>
    <input type="submit" value="Register">
    <a href="login.php">Login</a>
</body>
</html>

<?php
include "Register_class.php";

  if($_SERVER["REQUEST_METHOD"] == "POST")  
  {
    $obj=new Register_class();
   
    if($obj->register())
    {
        echo $_POST['name']." you are Registered succesfully.";
       if($obj->verifyMail($_POST['email']))
       {
           
       }
       else{

       }
    }
    else{
        echo $_POST['name']." you are already registered.";
    
    }
  }
}
else{
    echo "You are already Logged in <a href='welcome.php'>Go to HOme</a>";
}
?>