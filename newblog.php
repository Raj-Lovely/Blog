<?php session_start();?>
<?php 
	if(!isset($_SESSION['email'])) {
		header("Location: login.php");
		exit();
	} else {
		$email=$_SESSION['email'];
	}
?>
<?php include 'functions.php'; ?>
<?php $user_id=get_id($email); ?>
<?php new_post($user_id); ?>
<?php include 'includes/header.php'; ?>

	<div class="regform">
		<h3>Create New Post</h3>
		<form method="POST" action="newblog.php" enctype="multipart/form-data">
			<span class="error"><?php error_message('title'); ?></span>
			Title: <input type="text" name="title"><br>
			
			<span class="error"><?php error_message('article'); ?></span>
			Article: <textarea name="article"></textarea><br>
			
			<span class="error"><?php error_message('file'); ?></span>
			Image: <input type="file" name="file"><br>
			<input type="hidden" name="submitted">
			<input type="submit" value="Create Post">
		</form>
	</div>

<?php include 'includes/footer.php'; ?>