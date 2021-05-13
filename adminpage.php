<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
 <title>Admin Page</title>
 <link rel="stylesheet" href="css/bootstrap.min.css" />
 <style>
  table {
   border-collapse: collapse;
   width: 100%;
   color: #588c7e;
   font-family: monospace;
   font-size: 25px;
   text-align: left;
     } 
  th {
   background-color: #588c7e;
   color: white;
    }
  tr:nth-child(even) {background-color: #f2f2f2}
 </style>
</head>
<body>
<?php
echo "<div style='margin:30px;font-family: monospace;font-size:30px'>Welcome ".$_SESSION["userid"]."</div>";
?>
 <table>
 <tr>
  <th>Id</th> 
  <th>Username</th>
  <th>First name</th> 
  <th>Last name</th>
  <th>Email</th>
  <th>Password</th>
 </tr>
 <?php
 if(isset($_POST["logout"])){
	 session_destroy();
	 header("Location:Index.php");
	 
	 
 }
$conn = mysqli_connect("localhost", "root", "", "cdrop");
  // Check connection
  if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
  } 
  $sql = "SELECT id, uname,fname,lname,email, pass FROM user";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
   // output data of each row
   while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["id"]. "</td><td>" . $row["uname"] . "</td><td>"
. $row["fname"]. "</td><td>" . $row["lname"]. "</td><td>" . $row["email"]. "</td><td>" . $row["pass"]. "</td></tr>";
}
echo "</table>";
} else { echo "0 results"; }
$conn->close();
?>
</table>
<div>
 <form method="post">
<input type ="submit" name="logout"
            class ="btn btn-info"value="Logout" style="position:fixed;bottom:40px;right:40px;"/></div></form>
</body>
</html>