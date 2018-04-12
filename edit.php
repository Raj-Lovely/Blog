<?php session_start(); ?>
<?php 
	if(!isset($_SESSION['email'])) {
		header("Location: login.php");
		exit();
	}
?>
<?php 
	if(isset($_GET['id'])) {
		$postid=$_GET['id'];
	}
?>

<?php include 'functions.php'; ?>

<?php edit_blog($postid); ?>

<?php include 'includes/header.php'; ?>

<div class="regform">
		<h3>Edit Post</h3>
		<form method="POST" action="edit.php?id=<?php echo $postid;?>" enctype="multipart/form-data">
			<span class="error"><?php error_message('title'); ?></span>
			Title: <input type="text" name="title" value="<?php get_title($postid); ?>"><br>
			<span class="error"><?php error_message('article'); ?></span>
			Article: <textarea name="article"> <?php get_article($postid); ?> </textarea><br>
			<span class="error"><?php error_message('file'); ?></span>
			Image: <input type="file" name="file"><br>
			<input type="hidden" name="submitted">
			<input type="submit" value="Edit Post">
		</form>
	</div>

<?php include 'includes/footer.php'; ?>