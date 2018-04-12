<?php session_start();?>
<?php 
	if(!isset($_SESSION['email'])) {
		header("Location: login.php");
		exit();
	}
	$email=$_SESSION['email'];
?>
<?php include 'functions.php'; ?>
<?php include 'includes/header.php'; ?>
	<div id="dashboard">
		<a href="profile.php">My Profile</a><br>
		<a href="myblog.php">My Blogs</a><br>
		<a href="newblog.php">Create New Blog Post</a>
		
	</div>
	
<?php include 'includes/footer.php'; ?>