<?php @session_start(); ?>
<!doctype html>
<html>

	<head>
		<title>PHP Developers' Blog</title>
		<link rel="stylesheet" href="style.css">
		<script src="jquery.js"></script>
		<script src="script.js"></script>
	</head>

	<body>

		<div id="container">

			<div id="upper">
				<header>
					<p>PHP Developers' Blog</p>
				</header>

				<nav>
					<ul>
						<?php if(!isset($_SESSION['email'])) { ?>
						<li><a href="index.php">Home</a></li>
						<li><a href="about.php">About</a></li>
						<li><a href="services.php">Products & Services</a></li>
						<li><a href="contact.php">Contact</a></li>
						<?php } else { ?>
						<li><a href="dashboard.php">Dashboard</a></li>
						<li><a href="index.php" target="_blank">Blog</a></li>
						<?php } ?>
					</ul>

					<div class="logreg">
						<?php if(!isset($_SESSION['email'])) { ?>
						<a href="login.php">Login</a>&nbsp;&nbsp;&nbsp;OR&nbsp;&nbsp;&nbsp;
						<a href="register.php">Register</a>
						<?php } else { echo $_SESSION['email']."&nbsp;|";?>
						<a href="logout.php">Logout</a>
						<?php } ?>
					</div>
				</nav>
			</div>
