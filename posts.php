<?php session_start(); ?>
<?php include 'functions.php'; ?>

<?php 
	if(isset($_GET['id'])) {
		$postid=$_GET['id'];
	}
?>

<?php comments($postid); ?>

<?php include 'includes/header.php'; ?>
	<?php get_single_post($postid); ?>
<?php include 'includes/footer.php'; ?>