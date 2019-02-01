<?php
namespace UserRegistration\Activity;
require_once "vendor/autoload.php";
class User{
   public $name;
   public $email;
   public $pass;
   public $hash;
   public $db;
   public $conn;
   public $count=0;
   public $role;
  
function __construct()
 {
     //echo "heloo";
   //$this->conn=new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   $this->conn=mysqli_connect("localhost","root","root","userInfo");
   if(($this->conn)->connect_error)
   {
       echo "connection failed".$this->conn->connect_error;
   }
 }

 public function test_input()
 {
    $this->name=mysqli_real_escape_string($this->conn, $_POST['name']);
    $this->email=mysqli_real_escape_string($this->conn, $_POST['email']);
    $this->pass=mysqli_real_escape_string($this->conn, $_POST['password']);
    //$this->role=mysqli_real_escape_string($this->conn, $_POST['role']);
    $this->hash=md5($this->pass);
   
    if( empty($this->name) || empty($this->email) || empty($this->hash) )
     {
       return false;
     }else{
         return true;
     }
    
 }

 public function select_query()
{
    $sql="select * from signed_users";
    $result=mysqli_query($this->conn,$sql);
//    $sql="Select * from signed_users where email='$this->email' and pass='$this->hash'";
//    $result=mysqli_query($this->conn,$sql);
   if ($result->num_rows == 0) 
    {
      return "table is empty";
    } 
    else if($result->num_rows>0)
    {
        while($row = $result->fetch_assoc()) {
            if(($row["email"]==$this->email)&&($row["pass"]==$this->hash))
            {
                return "already registered";
            }
        }
        return "not registered";

    }
    
  }

  public function allRecords()
  {
    $sql="select * from signed_users";
    $result=mysqli_query($this->conn,$sql);
    if ($result->num_rows > 0)
    {
      return $result;
        
      }
  }

  public function isAdmin()
  {
      $sql="select * from signed_users where u_id=1";
      $result=mysqli_query($this->conn,$sql);
      if ($result->num_rows > 0)
      {
        while($row = $result->fetch_assoc()) {
          if(($row["fname"]==$this->name)&&($row["email"]==$this->email))
          {
              return true;
          }
        }
      }
      return false;
     
  }
 public function getRecord($getid)
 {
    $sql="select * from signed_users where u_id='$getid' ";
    $result=mysqli_query($this->conn,$sql);
    if ($result->num_rows > 0)
    {
      $row=$result->fetch_assoc();
      return $row;
        
      }
 }
 public function deleteUser($email)
 {
     $sql="delete from signed_users where email='$email' ";
     if ($this->conn->query($sql) === TRUE) {
        return true;
     } else {
        echo "Error delete record: " . $this->conn->error;
     }

     return false;
 }
 public function filterData($email,$role)
 {
    $sql="select * from signed_users where ";
    if($role!= NULL)
    {
        $sql.="roles='$role' ";
    }
    if($email)
    {
        if($role!= NULL){
            $sql.="and email='$email'";
        }
        else{
        $sql.="email='$email' ";
        }
    }
   
    $result=mysqli_query($this->conn,$sql);
    if ($result->num_rows > 0)
    {
      return $result; 
      }
 }
  public function changeUserStatus($email,$hash)
  {
    $sql=" update signed_users set isverified=1 where email='$email' and pass='$hash' ";
    if ($this->conn->query($sql) === TRUE) {
        return true;
    } else {
        echo "Error updating record: " . $this->conn->error;
    }
    
     return false;
  }
 
 public function updateUser($name,$role,$email)
 {
     $sql=" update signed_users set fname='$name',roles='$role' where email='$email' ";
     if ($this->conn->query($sql) === TRUE) {
        return true;
    } else {
        echo "Error updating record: " . $this->conn->error;
    }
    
     return false;
 }

  public function isVerified($email)
    {
        $sql="Select * from signed_users where email='$email'";
        $result=mysqli_query($this->conn,$sql);
        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc()) 
            {
                
                if(!$row["isverified"]==0)
                {
                   
                    return true;
                }
                return false;
            }
            
         } 
    }
  
  public function insert_query($user_role)
  {
      echo $this->hash;
     $sql="INSERT INTO signed_users (fname,email,pass,roles)VALUES('$this->name', '$this->email', '$this->hash','$user_role')";
    if($this->conn->query($sql))
       {
           echo "inside insert";
           return true;
       }
       else{
            echo "insert query false .Error:".$this->conn->error;
            return false;
       }
      
   }
}

?>