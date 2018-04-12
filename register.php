<?php session_start();?>
<?php include 'functions.php'; ?>
<?php register(); ?>
<?php include 'includes/header.php'; ?>
	<div class="regform">
		<h3>New users register here:</h3><br>
		<form method="POST" action="register.php">
			<span class="error"><?php error_message('fname'); ?></span>
			First Name:&nbsp;<input type="text" name="fname" placeholder="Type your First Name here"><br><br>
			
			<span class="error"><?php error_message('lname'); ?></span>
			Last Name:&nbsp;<input type="text" name="lname" placeholder="Type your Last Name here"><br><br>
			
			<span class="error"><?php error_message('email'); ?></span>
			Email:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="email" name="email" placeholder="Type your Email here"><br><br>
			
			<span class="error"><?php error_message('username'); ?></span>
			Username:&nbsp;&nbsp;<input type="text" name="username" placeholder="Type your Username here"><br><br>
			
			<span class="error"><?php error_message('password'); ?></span>
			Password:&nbsp;&nbsp;&nbsp;<input type="password" name="password" placeholder="Type your Password here"><br><br>
			
			<span class="error"><?php error_message('confirm'); ?></span>
			Re-type:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" name="confirm" placeholder="Confirm Password"><br><br>
			
			<input type="hidden" name="submitted">
			<div class="logregbtn">
				<input type="submit" value="Register">
			</div>
		</form>
	</div>
<?php include 'includes/footer.php'; ?>