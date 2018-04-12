<?php session_start(); ?>
<?php include 'functions.php'; ?>
<?php 
	if(!isset($_SESSION['email'])) {
		header("Location: login.php");
		exit();
	}
	$email=$_SESSION['email'];
	$id=get_id($email);
?>

<?php include 'includes/header.php'; ?>
	<?php get_profile($id); ?>
<?php include 'includes/footer.php'; ?>