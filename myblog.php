<?php session_start();?>
<?php 
	if(!isset($_SESSION['email'])) {
		header("Location: login.php");
		exit();
	}
	$email=$_SESSION['email'];
?>

<?php include 'functions.php'; ?>
<?php
	if(isset($_GET['id'])) {
		delete_post($_GET['id']);
	}
?>

<?php include 'includes/header.php'; ?>
	<?php get_my_posts($email); ?>
<?php include 'includes/footer.php'; ?>