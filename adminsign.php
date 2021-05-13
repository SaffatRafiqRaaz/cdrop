<?php
session_start();
//index.php
$error = '';
$username = '';
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
  if(empty($_POST["Password"]))
  {
    $error .= '<p> <label class="text-danger">Please Enter your Password </label></p>';
  }
  else {
    $Password = clean_text($_POST["Password"]);
    if(!preg_match("/^[a-zA-Z0-9]*$/",$Password))
    {
      $error .='<p><label class="text-danger">Only digit and alphabets are allowed</label></p>';
    }

  }
  
   if($error =='')
   {
    
     error_reporting(0);
     include 'db.php';
        $query=mysqli_query($conn,"SELECT * from admin where name='$username' and pass='$Password'") or die("error");
        
        $row=mysqli_fetch_array($query);
         	if($row['name']==$username && $row['pass']==$Password)
         	{
					$_SESSION["userid"]=$row['name'];
         		   header("Location:adminpage.php");
				   echo $_SESSION["userid"];
         	}
         	else
         	{
         		echo "<div style='position:fixed;top:40px;width:100%;text-align:center;padding-bottom:50px;'>Incorrect credentials. Please try again.</div>";
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
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	 </head>
  <body>
  <div class="container">
      <div class ="col-md-6" style="margin:0 auto;float:none;">
  <form method="post">
          <h3 align ="center">Admin Zone</h3>
          <br />
          <?php echo $error; ?>
          <div class ="form-group">
            <label>Enter Name</label>
            <input type="text" name="username"
            placeholder="Enter Name" class="form-control"  value ="<?php echo $username;?>"/>
          </div>
          <div class ="form-group">
            <label>Enter Password</label>
            <input type="password" name="Password"
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