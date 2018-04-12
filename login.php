<?php session_start(); ?>

<?php include_once 'functions.php'; ?>
<?php login(); ?>
<?php 
	if(isset($_SESSION['email'])) {
		
	header("Location: dashboard.php");
	exit();
	}
?>
<?php include 'includes/header.php'; ?>
	<div id="loginform">
		<h3>Existing users log in here:</h3><br>
		<form method="POST"	action="login.php">
			Email: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="email" placeholder="Type your email here"><br><br>
			Password: <input type="password" name="password" placeholder="Type your password here"><br><br>
			<input type="hidden" name="submitted">
			<div class="logregbtn">
				<input type="submit" value="&nbsp;&nbsp;Login&nbsp;&nbsp;">
			</div>
			<div id="error"><?php error_message('login'); ?></div>
		</form>
	</div>
<?php include 'includes/footer.php'; ?>