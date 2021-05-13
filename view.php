<?php
$dbh = new PDO("mysql:host=localhost;dbname=mydata","root","");
$id = isset($_GET['id'])? $_GET['id'] : "";
$stat = $dbh->prepare("select * from myblob where id=?");
$stat->bindParam(1,$id);
$stat->execute();
$row = $stat->fetch();
header("Content-Type:".$row['mime']);
echo $row['data'];
echo "<input type ='submit' name='submit'
            class ='btn btn-info'value='Submit' style='position:fixed;bottom=30px;right=30px;'/>";
//echo '<img src="data:image/jpeg;base64,'.base64_encode($row['data']).'"/>';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Code Viewer</title>
    <link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	 </head>
  <body>
  <form>
  </form>
  <script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
   </body>
   </html>