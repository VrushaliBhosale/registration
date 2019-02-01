<?php
require_once "vendor/autoload.php";
use UserRegistration\Activity\Logout_class;
use UserRegistration\Activity\User;
session_start();
$limit=2;
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit;  
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
    table,tr,th,td{
        border:1px solid gray;
        border-collapse: collapse;
    }
    th,td{
        padding:20px;
    }
    .links,.btns{
        display:flex;
    }
    .in{
        margin:10px;
        height:20px;
    }
    a{
        margin:10px;
    }
    span{
        margin-top:10px;
    }
    span input{
        width:80px;
        height:100px;
    }
    </style>
    <script>
    script type="text/javascript">

    function myFunction() {
        document.getElementById();
}

</script>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    <div class="links">
    <a href="add_user.php">Add user</a> 
    <?php 
    
     $user_obj=new User();
     $result=$user_obj->allRecords($start_from,$limit);
     
    ?>
    <span>Email:</span> <input type="text" name="email_list" list="emailList" class="in">
            <datalist id="emailList">
            <?php
             while($row = $result->fetch_assoc()){
                 echo '<option value='.$row["email"].'>';
            }
            ?>
            </datalist> <br><br>

    <span>Role:</span><input type="text" name="role_list" list="roleList" class="in">
            <datalist id="roleList">
            <option value="admin">
            <option value="guest">
            </datalist> <br><br>   
    <span><input type="submit" value="filter" name="filter"></span>     
     </div>       

        <table>
        <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Roles</th>
        <th>Edit</th>
        </tr>
    <?php
    if(!$_POST['filter']=="filter")
    {
    $result=$user_obj->allRecords($start_from,$limit); 
     while($row = $result->fetch_assoc()){
    ?>  
        <tr>
        <td><?php echo $row["fname"]?></td>
        <td><?php echo $row["email"]?></td>
        <td><?php echo $row["roles"]?></td>
        <?php echo '<td><a href="update_user.php?u_id='. $row["u_id"]. '">Edit User</a></td>'?>
        </tr>
    <?php } 
        }else{
           
            $rslt=$user_obj->filterData($_POST['email_list'],$_POST['role_list']);
            while($data=$rslt->fetch_assoc())
            {?>
               <tr>
        <td><?php echo $data["fname"]?></td>
        <td><?php echo $data['email']?></td>
        <td><?php echo $data['roles']?></td>
        <?php echo '<td><a href="update_user.php?u_id='. $row["u_id"]. '">Edit User</a></td>'?>
        </tr>
                
            <?php }
            }
                ?>
               

      </table>
       
        <div class="btns">
        <a href="admin.php">Home</a>
        <a href="logout.php" class="button">logout</a>
        </div>
    </form>
</body>
</html>

<?php
 
 $total_records=$user_obj->getCount();
$total_pages=ceil($total_records/$limit);

$pagLink="<div class='pagination'>";  
for ($i=1; $i<=$total_pages; $i++) {  
             $pagLink .= "<a href='admin.php?page=".$i."'>".$i."</a>";  
};  
echo $pagLink . "</div>";   
// if($_POST['logout']=="Logout")
//  {

//      if(session_destroy()){
//          header("Location: login.php");
//      }
//  }
 
//  if($_POST['filter'])
//  {
     
//  }

?>