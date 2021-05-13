<?php
//index.php
$error = '';
$username = '';
$fname = '';
$lname = '';
$email = '';
$Password ='';
function clean_text($string)
{
  $string = trim ($string);
  $string = stripslashes($string);
  $string = htmlspecialchars($string);
  return $string;
}
if(isset($_POST["submit"]))
{
  if(empty($_POST["username"]))
  {
    $error .= '<p> <label class="text-danger">Please Enter your User Name</label></p>';
  }
  else {
    $username = clean_text($_POST["username"]);
    if(!preg_match("/^[a-zA-Z\s]*$/",$username))
    {
      $error .='<p><label class="text-danger">Only letters and white space allowed</label></p>';
    }

  }
  if(empty($_POST["fname"]))
  {
    $error .= '<p> <label class="text-danger">Please Enter your First Name</label></p>';
  }
  else {
    $fname = clean_text($_POST["fname"]);
    if(!preg_match("/^[a-zA-Z\s]*$/",$fname))
    {
      $error .='<p><label class="text-danger">Only letters and white space allowed</label></p>';
    }

  }
  if(empty($_POST["lname"]))
  {
    $error .= '<p> <label class="text-danger">Please Enter your Last Name</label></p>';
  }
  else {
    $lname = clean_text($_POST["lname"]);
    if(!preg_match("/^[a-zA-Z\s]*$/",$lname))
    {
      $error .='<p><label class="text-danger">Only letters and white space allowed</label></p>';
    }

  }
  if(empty($_POST["email"]))
  {
    $error .= '<p> <label class="text-danger">Please Enter your Email</label></p>';
  }
  else {
    $email = clean_text($_POST["email"]);
    if(!filter_var($email,FILTER_VALIDATE_EMAIL))
    {
      $error .='<p><label class="text-danger">invalid email format</label></p>';

    }


  }
  if(empty($_POST["Password"]))
  {
    $error .= '<p> <label class="text-danger">Please Enter your Password </label></p>';
  }
  else {
    $Password = clean_text($_POST["Password"]);
    if(!preg_match("/^[a-zA-Z0-9]*$/",$Password))
    {
      $error .='<p><label class="text-danger">Only degit and alphabets are allowed</label></p>';
    }

  }
  
   if($error =='')
   {
    error_reporting(0);
    include 'db.php'; 
    $sql="INSERT into user ( uname , fname , lname , email , pass ) values( '$username' , '$fname' , '$lname' , '$email' , '$Password' )";
  
    	if(mysqli_query($conn,$sql)){
			echo "<div style='position:fixed;top:550px;width:100%;text-align:center;padding-bottom:50px;'>Account successfully created.</div>";
    	}
    	else{
    		echo "Error: " . "<br>" . mysqli_error($conn);
    	}
   }


  }

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Open new account</title>
    <link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	 </head>
  <body>
  <div class="container">
      <div class ="col-md-6" style="margin:0 auto;float:none;">
  <form method="post">
          <h3 align ="center">Registration form</h3>
          <br />
          <?php echo $error; ?>
          <div class ="form-group">
            <label>Enter User Name</label>
            <input type="text" name="username"
            placeholder="Enter User Name" class="form-control"  value ="<?php echo $username;?>"/>
          </div>
		  <div class ="form-group">
            <label>Enter First Name</label>
            <input type="text" name="fname"
            placeholder="Enter First Name" class="form-control"  value ="<?php echo $fname;?>"/>
          </div>
		  <div class ="form-group">
            <label>Enter Last Name</label>
            <input type="text" name="lname"
            placeholder="Enter Last Name" class="form-control"  value ="<?php echo $lname;?>"/>
          </div>
		  <div class ="form-group">
            <label>Enter Email</label>
            <input type="text" name="email"
            placeholder="Enter Email" class="form-control"  value ="<?php echo $email;?>"/>
          </div>
          <div class ="form-group">
            <label>Enter Password</label>
            <input type="text" name="Password"
            placeholder="Enter Password" class="form-control"
            value ="<?php echo $Password;?>"/>
          </div>
          <div class ="form-group" align="center">
            <input type ="submit" name="submit"
            class ="btn btn-info"value="Submit"/>
	</div>
</form>
  
  <script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
   </body>
   </html>