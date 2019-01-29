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
   $sql="Select * from signed_users where email='$this->email' and pass='$this->hash'";
   $result=mysqli_query($this->conn,$sql);
   if ($result->num_rows > 0) 
   {
      //echo "registered";
      return true;
    } 
    return false;
  }

  public function changeUserStatus($email,$hash)
  {
    $sql=" update signed_users set isverified=1 where email='$email' and pass='$hash' ";
    print_r($sql);
    print_r($email);
    if ($this->conn->query($sql) === TRUE) {
        return true;
    } else {
        echo "Error updating record: " . $conn->error;
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
  
  public function insert_query()
  {
      echo $this->hash;
   $sql="INSERT INTO signed_users (fname,email,pass) VALUES('$this->name', '$this->email', '$this->hash')";
   if($this->conn->query($sql))
       {
           return true;
       }
       else{
            echo "insert query false .Error:".$this->conn->error;
            return false;
       }
      
   }
}

?>