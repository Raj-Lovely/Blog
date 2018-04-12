<?php session_start();?>
<?php 
	if(!isset($_SESSION['email'])) {
		header("Location: login.php");
		exit();
	}
?>

<?php include 'includes/header.php'; ?>

<?php include 'functions.php'; ?>

<?php 
	if(isset($_GET['id'])) //retrieving id from the url
	{
	$id=$_GET['id'];
		
		if(isset($_POST['submitted'])) 
		{
		$title=$_POST['title'];
		$article=$_POST['article'];
		$connection=connect();
		$query=mysqli_query($connection,"UPDATE blog_post SET heading='$title', article='$article' WHERE blogid='$id'");
		header("Location:myblog.php");
		}

	}
?>

<form method="POST" action="editblog.php?id=<?php echo $id; ?>">
Title: <input type="text" name="title" value="<?php echo get_title($id); /* This value is displayed in title*/?>"> <br>	
Article:<textarea rows="20" cols="80" name="article"> <?php echo get_article($id); ?> </textarea><br>
<input type="hidden" name="submitted">
<input type="submit" value="Done Editing">
</form>

<?php include 'includes/footer.php'; ?>