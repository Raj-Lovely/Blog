<?php session_start(); ?>
<?php 
		if(!isset($_SESSION['email'])) 
		{
		header("Location: login.php");
		exit();
		}
?>

<?php include 'functions.php'; ?>

<?php
	if(isset($_POST['submitted']))
	{

		$email=$_SESSION['email'];
		$fname=$_POST['fname'];
		$lname=$_POST['lname'];
		$connection=connect();
		$query=mysqli_query($connection, "UPDATE blog_user SET firstname='$fname' WHERE email='$email'");
		$query1=mysqli_query($connection, "UPDATE blog_user SET lastname='$lname' WHERE email='$email'");
		
					header("Location:dashboard.php");
					exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Profile Editor</title>
</head>
<body>
	<form method="POST" action="show.php">
		Edit First Name:<input type="text" name="fname"><br>
		Edit Last Name:<input type="text" name="lname"><br>
		<input type="hidden" name="submitted">
		<input type="submit" value="Done Editing">
	</form>
</body>
</html>