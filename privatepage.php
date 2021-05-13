<?php
	session_start();?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	
    <title>My Codes</title>
	<link rel="stylesheet" href="css/style2.css" />
	<link rel="stylesheet" href="css/bootstrap.min.css" />
</head>
<body>
	
    <?php
	$uid=$_SESSION["userid"];
    $dbh = new PDO("mysql:host=localhost;dbname=mydata","root","");
    if(isset($_POST['btn'])){
        $name = $_FILES['myfile']['name'];
        $mime = $_FILES['myfile']['type'];
        $data = file_get_contents($_FILES['myfile']['tmp_name']);
        $stmt = $dbh->prepare("insert into myblob values('',?,?,?,?)");
        $stmt->bindParam(1,$name);
        $stmt->bindParam(2,$mime);
        $stmt->bindParam(3,$data, PDO::PARAM_LOB);
		$stmt->bindParam(4,$uid);
        $stmt->execute() or die();
    }
	if(isset($_POST['logout'])){
		session_destroy();
		header("Location:index.php");
		
	}
    ?>
    <form method="post" enctype="multipart/form-data" style="padding:30px">
        <input type="file" name="myfile"/>
        <button name="btn">Upload</button>
    </form>
	<form method="post" enctype="multipart/form-data" style="position:fixed;top:30px;right:30px">
        <input type="button" onClick="window.open('https://ideone.com/','_blank')" value="Open ideone">
		<button name="logout">Logout</button>
    </form>
	
    <ol>
    <?php
    $stat = $dbh->prepare("select * from myblob where uid=?");
	$stat->bindParam(1,$uid);
    $stat->execute();
    while($row = $stat->fetch()){
        echo "<li><a href='view.php?id=".$row['id']."' target='_blank'>".$row['name']."</a></li>";
    }
    ?>
    </ol>
	<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>