<?php
session_start();
$conn=mysqli_connect("hostname","vertex", "vertex123" , "wedmegood");
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

<!DOCTYPE html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="app.css">
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>
<body>
	<div class="main" >  
		<input type="checkbox" id="chk" aria-hidden="true">
			<div class="signup">
       
				<form method='POST' enctype="multipart/form-data" autocomplete="off">
        <label style="color:#E72E77;;">Registration</label>

					<!-- <label for="chk" aria-hidden="true" >Sign up</label><br> -->
          <input type="email" name="email"  title="Enter valid Email"  placeholder="Email" required="">
					<input type="text" name="name"  maxlength="32" pattern="[A-Za-z ]+" title="Enter valid name" placeholder="Full Name" required="">
          
					<div class="password-wrapper">
            <input type="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W)(?!.*\s).{8,}"  id="password" title="Password must contain at least 8 characters, including one uppercase letter, one lowercase letter, one digit, and one special character. No spaces allowed."
          placeholder="Password" required="">
          <i class="fas fa-eye-slash password-icon" onclick="togglePassword()"></i>
        </div>
         </p>
					<input type="password" name="cpassword" placeholder="Confirm Password" required="">
        <p style="color:red;text-align:center;" justify="center"><?php //echo $msg ?>
					<button name="signup">Sign up</button>
				</form>
			</div>



			<div class="login">
				<form method='POST'>
					<label for="chk" aria-hidden="true">Login</label>
					<input type="email" name="email" placeholder="Email" required="">
					<input type="password" name="password" placeholder="Password" required="">
					<button name="login">Login</button>
				</form>
			</div>
	</div>
</body>

<script>
function togglePassword() {
  var passwordField = document.getElementById("password");
  var icon = document.querySelector(".password-icon");
  
  if (passwordField.type === "password") {
    passwordField.type = "text";
    icon.classList.remove("fa-eye-slash");
    icon.classList.add("fa-eye");
  } else {
    passwordField.type = "password";
    icon.classList.remove("fa-eye");
    icon.classList.add("fa-eye-slash");
  }
}
</script>
</html>

<!-- pattern="^[^\s@]+@[^\s@]+\.[^\s@]+$"  -->





