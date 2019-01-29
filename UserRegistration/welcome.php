<?php
require_once "vendor/autoload.php";
use UserRegistration\Activity\Logout_class;

session_start();
if(isset($_SESSION['name']))
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
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
    <h2>welcome!!</h2><br><br>
    <input type="submit" value="Logout">
</form>
</body>
</html>
<?php


if($_SERVER["REQUEST_METHOD"] == "POST")  
    {   
        $obj=new Logout_class();
        $obj->logout();
    }
}
else{
    echo "login first <a href='login.php'>Login</a>";
}

?>