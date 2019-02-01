<?php
require_once "vendor/autoload.php";
use UserRegistration\Activity\User;

$obj=new User();
$row=$obj->getRecord($_GET['u_id']);
echo $id;
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
<h1>Edit User</h1>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
    Name:      <input name="name" type="text" required value="<?php echo $row["fname"]?>"><br><br>
    Email:     <input name="email" type="email" required value="<?php  echo $row["email"]?>"><br><br>
    Role:      <input name="role" type="text" required value="<?php  echo $row["roles"]?>"><br><br>
    <input type="submit" name="update" value="Update"> 
    
    <!-- <?php echo '<a href="update_user.php?u_id='. $_GET["u_id"]. '"><input type="submit" name="delete" value="Delete"></a>'?> -->
    <input type="submit" name="delete" value="Delete">
    </form><br>
    <a href="admin.php">Home</a>
</body> 
</html>
<?php

if($_POST['update'])
{
   if($obj->updateUser($_POST['name'],$_POST['role'],$_POST['email']))
   {
       echo "Record Updated Successfully";
   }
}

if($_POST['delete'] == 'Delete')
{
   if($obj->deleteUser($_POST['email']))
   {
      echo "Record deleted successfully";
   }
}

?>