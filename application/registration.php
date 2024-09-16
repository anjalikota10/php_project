<?php
session_start();
$conn=mysqli_connect("php-rds.ccx7flt77asx.ap-south-1.rds.amazonaws.com","root","12345678","wedmegood");
 if($conn)
 {
    // echo"Connected";
 }
 else
 {
    // echo"Connection fail".mysqli_connect_error();
 }
?>


<?php
$msg="";
 if(isset($_POST['signup']))
 { 

    $email=$_POST['email'];
	  $name=$_POST['name'];
    $password=$_POST['password'];
    $cpassword=$_POST['cpassword']; 

    $sql="select count(id) from registration where email='$email'";
    
    $res=mysqli_query($conn,$sql);
    $count=mysqli_fetch_row($res);
    // $id=$count[0];
    if($count[0]==1)
    {
      echo "<script>alert('Already registered')</script>";
    }
    
    
    else
    {

    if($password==$cpassword)
    {
      $query="insert into registration(email,name,password,cpassword) values('$email','$name','$password','$cpassword')";

      if(mysqli_query($conn,$query))
      {
      echo "<script>alert('Registration Successful')</script>";
      }
      else{
        echo "error".$conn->error;
      }
    }
    else
    {
       $msg="password and confirm password doesnt match";
       //return back()->with("Fail","password and confirm password doesnt match");
    }
  }
 }


   
?>

<?php

if(isset($_POST['login']))
{

  $email=$_POST['email'];
  $password=$_POST['password'];
  $query="select * from registration where email='$email' && password='$password' ";
  $data=mysqli_query($conn,$query);
  $total=mysqli_num_rows($data);
  // echo $total;
  if($total==1)
  {

    $_SESSION['wed']=$email;
    echo"<script> alert('login successfully')
     window.location.href='index.php'</script>";
  }
  else
  {
    echo"<script> alert('login Failed')</script>";
  }

}

?>


