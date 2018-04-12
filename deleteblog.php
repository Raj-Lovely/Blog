<?php session_start();?>
<?php 
	if(!isset($_SESSION['email'])) {
		header("Location: login.php");
		exit();
	}
?>

<?php include 'functions.php'; ?>
<?php include 'includes/header.php'; ?>
<?php
	$id=$_GET['id'];
	delete_post($id);
?>
<?php
	include 'includes/footer.php';
?>