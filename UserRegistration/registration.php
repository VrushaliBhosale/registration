<?php
require_once "vendor/autoload.php";
use UserRegistration\Activity\Register_class;
use UserRegistration\Activity\User;

session_start();
if(!isSet($_SESSION['name']))
{
    $login_user=$_SESSION['admin'];
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
<?php if($login_user) {?>
<h1>Add new User</h1>
<?php }else{?>
<h1>Registration Page</h1><?php }?>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
    Name:  <input name="name" type="text" required><br><br>
    Email: <input name="email" type="email" required><br><br>
    Password:<input name="password" type="password" required><br><br>
    <?php if($login_user) {?>
    Role: <input type="text" name="roles" list="exampleList">
    <datalist id="exampleList">
    <option value="admin">
    <option value="guest">
    </datalist> <br><br>

    <?php }?>
    <input type="submit" value="Register">
    
    <?php if($login_user) {?>
        <a href="admin.php">Home</a>
    <?php }else{?>
        <a href="login.php">Login</a>
    <?php }?> 

</body>
</html>

<?php
include "Register_class.php";
if($login_user) { $roles=$_POST['roles'];}
else{$roles="guest";}


  if($_SERVER["REQUEST_METHOD"] == "POST")  
  {
    $obj=new Register_class();
    $isregistered=$obj->register($roles);
    if($isregistered=="registering guest")
    {
        echo $_POST['name']." you are Registered succesfully.";
        if(!$_SESSION['admin'])
        {
            if($obj->verifyMail($_POST['email']))
            {
                echo "Message has been sent";
            }
        }
        else{
           $user_obj=new User();
           $user_obj->changeUserStatus($_POST['email'],md5($_POST['password']));
        }
    }
    elseif($isregistered=="admin registered")
    {
        echo $_POST['name']." you are Registered succesfully.";
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