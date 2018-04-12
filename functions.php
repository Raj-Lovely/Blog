<?php 
	function connect() {
		$connection=mysqli_connect("localhost", "root", "", "blog_db") or die("Could not connect to the database!");
		return $connection;
	} //end of connect
	
	function Login() {
		unset($_SESSION['error']);
		//check if the form is submitted
		if(isset($_POST['submitted'])) {
			
			$connection=connect(); //connect to the database

			$email=$_POST['email'];
			$password=$_POST['password'];

			//query the database
			$query=mysqli_query($connection, "SELECT * FROM blog_user WHERE email='$email' AND password='$password'");
			
			//if there is any row returned, then set session and redirect
			if(mysqli_num_rows($query)) {
				$_SESSION['email']=$email;
				header("Location: dashboard.php");
				exit();
			}

			$error['login']="Incorrect email or password";
			$_SESSION['error']=$error;

		} //end of submission check if
	} //end of login function

	function register() {
		unset($_SESSION['error']);
		if(isset($_POST['submitted'])) {
			$fname=$_POST['fname'];
			$lname=$_POST['lname'];
			$email=$_POST['email'];
			$username=$_POST['username'];
			$password=$_POST['password'];
			$confirm=$_POST['confirm'];

			if(!preg_match('/^[a-zA-Z]+$/', $fname)) {
				$error['fname']="Please enter a valid fname";
			}

			if(!preg_match('/^[a-zA-Z]+$/', $lname)) {
				$error['lname']="Please enter a valid lname";
			}

			if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$error['email']="Please enter a valid email";
			}

			if(!preg_match('/^[a-zA-Z]+$/', $username)) {
				$error['username']="Please enter a valid username";
			}

			if(!preg_match('/^([a-zA-Z0-9@*#]{6,15})$/', $password)) {
				$error['password']="Please enter a valid password";
			}

			if(!preg_match('/^([a-zA-Z0-9@*#]{6,15})$/', $confirm)) {
				$error['confirm']="Error in confirm password";
			}

			if($error=='') { //only if there are no errors

				if($password==$confirm) { //only if password is confirmed

					$connection=connect(); //connect to the database
					
					//see if the email already exists
					$query=mysqli_query($connection, "SELECT * FROM blog_user WHERE email='$email' AND username='$username'");
					
					//if email doesn't already exist, then insert the values in the database, set session and redirect
					if(!mysqli_num_rows($query)) {
						$query=mysqli_query($connection, "INSERT INTO blog_user (firstname, lastname, username, email, password) VALUES ('$fname', '$lname', '$username', '$email', '$password')");
						$_SESSION['email']=$email;
						header("Location: dashboard.php");
						exit();
					} 

					//else set an error message and redirect to login.php page
					$_SESSION['error']="Sorry! This email is unavailable. Please select another email.";
					header("Location: register.php");
					exit();
				} //end of inner if

			} else {
				$_SESSION['error']=$error;
			} //end of else

		} //end of form submission check
	} //end of register

	function comments($postid) {
		unset($_SESSION['error']);
		if(isset($_POST['comment'])) {
			@$error;
			$email=$_POST['email'];
			$username=$_POST['username'];
			$comments=$_POST['comments'];

			if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$error[]="Please enter a valid email";
			}

			if(!preg_match('/^[a-zA-Z\s]+$/', $username)) {
				$error[]="Please enter a valid username";
			}

			if($comments=='') {
				$error[]="You can't have empty comment!";
			}

			if(@$error=='') {
				$connection=connect();
				$comments=mysqli_real_escape_string($connection, $comments);
				$query=mysqli_query($connection, "INSERT INTO blog_comment (c_email, name, c_blog_id, comments) VALUES ('$email', '$username', '$postid', '$comments')");
			} else {
				$_SESSION['error']=$error;
			}
		}
	} //end of comments
	
	function get_blog_post() {
		$connection=connect();

		$pagenum=1;
		if(isset($_GET['pagenum'])) {
			$pagenum=$_GET['pagenum'];
		}

		$query=mysqli_query($connection, "SELECT * FROM blog_post");

		$rows=mysqli_num_rows($query);
		
		//no. of results per page
		$page_rows=3;

		//page number of our last page
		$last=ceil($rows/$page_rows);

		//make sure page number isn't below one or more than last page
		if($pagenum<1) {
			$pagenum=1;
		} elseif ($pagenum>$last) {
			$pagenum=$last;
		}

		$max='LIMIT '.($pagenum-1)*$page_rows.','.$page_rows;

		$query=mysqli_query($connection, "SELECT blog_post.blogid, blog_post.heading, LEFT(blog_post.article, 560) AS article, blog_user.* FROM blog_post INNER JOIN blog_user ON blog_post.fkuserid=blog_user.user_id $max");
		

		if(mysqli_num_rows($query)) {

			while($results=mysqli_fetch_array($query)) {
				$blogid=$results['blogid'];
				$image=mysqli_query($connection, "SELECT * FROM blog_images WHERE post_id='$blogid'");
				$imagepath=mysqli_fetch_array($image);
				$image=$imagepath['path'];
				echo "<div id=\"contents\">";
				echo "<div class=\"row\">";
				echo "<h2><a href=\"posts.php?id=".$results['blogid']."\">".htmlentities($results['heading'])."</a></h2>";
				echo "<p>By ".$results['firstname']."&nbsp;".$results['lastname']." on ".$results['datecreated']."</p>";
				if ($image) {
					echo "<img style=\"height: 60px; width: 60px;\" src=\"".$image."\">";
				}
				echo "<p>".htmlentities($results['article'])."</p>"; 
				echo "<div class=\"more\"><a href=\"posts.php?id=".$results['blogid']."\">Read More</a></div>";
				echo "</div>";
			}
		} else {
			echo "Sorry! No posts found!";
		}

		aside();
		echo "</div>"; //close the contents div

		echo "<div class=\"pagination\">"; //new div for pagination

		

		if($pagenum!=1) {
			echo "<a href='{$_SERVER['PHP_SELF']}?pagenum=1'>&nbsp;&nbsp;First&nbsp;&nbsp;</a>";
			echo " ";
			$previous=$pagenum-1;
			echo "<a href='{$_SERVER['PHP_SELF']}?pagenum=$previous'>&nbsp;&nbsp;Previous&nbsp;&nbsp;</a>";

		}

		//This shows the user what page they are on, and the total number of pages
		echo "Page $pagenum of $last";
		echo "    ";

		if($pagenum!=$last) {
			$next=$pagenum+1;
			echo "<a href='{$_SERVER['PHP_SELF']}?pagenum=$next'>&nbsp;&nbsp;Next&nbsp;&nbsp;</a>";
			echo " ";
			echo "<a href='{$_SERVER['PHP_SELF']}?pagenum=$last'>&nbsp;&nbsp;Last&nbsp;&nbsp;</a>";
		}

		echo "</div>";
	} //end of get_blog_posts

	function aside() {
		echo "<aside>";
		echo "<h3>Recent Posts</h3>";
		echo "<div id=\"recentposts\">";
		recentposts();
		echo "</div>";
		echo "<br><br>";
		echo "<h3>Recent Comments</h3>";
		echo "<div id=\"recentcomments\">";
		recentcomments();
		echo "</div>";
		echo "</aside>"; //echo the side bar
	}

	function get_title($postid) {
		$connection=connect();
		$query=mysqli_query($connection, "SELECT heading FROM blog_post WHERE blogid='$postid'");
		$result=mysqli_fetch_array($query);
		echo $result['heading'];
	}

	function get_article($postid) {
		$connection=connect();
		$query=mysqli_query($connection, "SELECT article FROM blog_post WHERE blogid='$postid'");
		$result=mysqli_fetch_array($query);
		echo $result['article'];
	}

	function get_comments($postid) {
		$connection=connect();
		$query=mysqli_query($connection, "SELECT * from blog_comment WHERE c_blog_id='$postid'");
		if(mysqli_num_rows($query)) {
			echo '<div class="comments">';
			echo '<h2>Comments</h2>';
			echo '<hr>';
			while ($results=mysqli_fetch_array($query)) {
				echo "<h3 style=\"margin-left:0;\">".$results['name']." says:<br></h3>";
				echo htmlentities($results['comments'])."<br><br>";
			}
			echo '<div class="error">'.error_message(0).'</div>';
			echo '</div>';
		} else {
			echo "<br>No comments for this post yet. Be the first one to comment.";
		}
	} //end of get_comments

	function get_single_post($postid) {
		$connection=connect();
		$query=mysqli_query($connection, "SELECT blog_post.*, blog_user.* FROM blog_post INNER JOIN blog_user ON blog_post.fkuserid=blog_user.user_id WHERE blogid='$postid'");
		
		if(mysqli_num_rows($query)) {
			$imagepath=mysqli_query($connection, "SELECT path FROM blog_images WHERE post_id='$postid'");
			$imagepath=mysqli_fetch_array($imagepath);
			$image=$imagepath['path'];
			$results=mysqli_fetch_array($query);

			echo "<div id=\"contents\">";
			aside();
			echo "<div class=\"row\">";
			if ($image) {
				echo "<img src=\"".$image."\">";
			}
			
			echo "<h2>".htmlentities($results['heading'])."</h2>";
			echo "<p>By ".$results['firstname']."&nbsp;".$results['lastname']."</p>";
			echo "<br>";
			echo "<p>".htmlentities($results['article'])."</p>";
			echo "<div class=\"more\"><a href=\"javascript:history.go(-1)\">Back</a></div>";
				
			echo '<div class="comform">
					<h3>Put your view in the box below: </h3><br>
					<form method="POST" action="posts.php?id='.$postid.'">
						<input type="email" name="email" placeholder="Enter your email"><br>
						<input type="name" name="username" placeholder="Enter your username"><br>
						<textarea name="comments" placeholder="Type your comment here"></textarea><br>
						<input type="hidden" name="id" value="$postid">
						<input type="hidden" name="comment">
						<input type="submit" value="Comment">
					</form>'.
				get_comments($postid).
				'</div>';
			echo "</div>";
		
		} else {
			echo "Sorry! No posts found!";
		}
	} //end of get_single_post

	function get_this_post($postid) { //to get post for editing
		$connection=connect();
		$query=mysqli_query($connection, "SELECT * FROM blog_post WHERE blogid='$postid'");
		$results=mysqli_fetch_array($query);
		echo htmlspecialchars($results['article']);
	} //end of get_this_post

	function get_my_posts($email) {
		$connection=connect();
		$query=mysqli_query($connection, "SELECT blog_post.*, blog_user.user_id FROM blog_post INNER JOIN blog_user ON blog_post.fkuserid=blog_user.user_id WHERE blog_user.email='$email'");
		echo "<div id=\"contents\">";
		echo "<table>";
		echo "<tr>";
		echo "<th>Blog</th>";
		echo "<th>Actions</th>";
		echo "</tr>";
		while($results=mysqli_fetch_array($query)) {
			echo "<tr>";
			echo "<td><a href=\"posts.php?id=".$results['blogid']."\">".htmlentities($results['heading'])."</a></td>";
			echo "<td><a href=\"edit.php?id=".$results['blogid']."\">Edit Post</a>"."&nbsp;&nbsp;|&nbsp;&nbsp;"."<a href=\"myblog.php?id=".$results['blogid']."\">Delete Post</a>"."</td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "</div>";
	} //end of get_my_posts

	function get_id($email) {
		$connection=connect();
		$query=mysqli_query($connection, "SELECT user_id FROM blog_user WHERE email='$email'");
		$query=mysqli_fetch_array($query);
		$query=$query['user_id'];
		return $query;	
	} //end of get_id


//This function is used to create a new post
	function new_post($id) {
		unset($_SESSION['error']);
		$error;
		if(isset($_POST['submitted'])) {
			if($_POST['title']==''){
				$error['title']="Title cannot be empty";
			} 

			if($_POST['article']=='') {
				$error['article']="Article cannot be empty";
			}

			$allowedExts = array("jpg", "jpeg", "gif", "png");
			$fname=$_FILES["file"]["name"];
			$ftype=$_FILES["file"]["type"];
			$fsize=$_FILES["file"]["size"];
			$ferror=$_FILES["file"]["error"];
			$ftemp=$_FILES["file"]["tmp_name"];
			@$extension = end(explode(".", $fname));
			if((($ftype == "image/gif") || ($ftype == "image/jpeg") || ($ftype == "image/png") || ($ftype == "image/pjpeg")) && ($fsize < 2000000)
			&& in_array($extension, $allowedExts)) {
			    if($ferror > 0) {
			    	$error['file']="File Error!";
		        } else {
		        	if(file_exists("blog_images/".$fname)) {
		        		$error['file']="File already exists!";
		        	}
		    	}
		    } else {
		        $error['file']="Invalid File";
		    }


			if(@$error=='') {
				$connection=connect();
				$title=mysqli_real_escape_string($connection, $_POST['title']);
				$article=mysqli_real_escape_string($connection, $_POST['article']);
				$query=mysqli_query($connection, "INSERT INTO blog_post (fkuserid, heading, article) VALUES ('$id', '$title', '$article')");
				if($query) {
					$error[]="First query success, ie, insertion of post";
					$query=mysqli_query($connection, "SELECT blogid FROM blog_post WHERE heading='$title' AND fkuserid='$id'");
					$blog_id=mysqli_fetch_array($query);
					$blogid=$blog_id['blogid'];
					move_uploaded_file($ftemp, "blog_images/".$fname);   
					$fname="blog_images/".$fname;
					$insert=mysqli_query($connection, "INSERT INTO blog_images (path, post_id) VALUES ('$fname', '$blogid')");
					if($insert) {
						header("Location: myblog.php");
						exit();
					} else {
						$error[]="unsuccessful in inserting image path";
					}
				} else {
					$error[]="unsuccessful in inserting blog post";
					$_SESSION['error']=$error;
				}
			} else {
				$_SESSION['error']=$error;
			}
		}
	} //end of new_post

	function error_message($var) {
		if(isset($_SESSION['error'])) {
			$error=$_SESSION['error'];
			if(isset($error[$var])) {
				echo $error[$var]."<br>";
			}
		}
	} //end of error_message

	function edit_blog($id) {
		unset($_SESSION['error']);
		$error;
		if(isset($_POST['submitted'])) {
			$title=$_POST['title'];
			$article = $_POST['article']; //get posted data

			if($title=='') {
				$error['title']="Title is empty!";
			}

			if($article=='') {
				$error['article']="Article is empty!";
			}

			$allowedExts = array("jpg", "jpeg", "gif", "png");
			$fname=$_FILES["file"]["name"];
			$ftype=$_FILES["file"]["type"];
			$fsize=$_FILES["file"]["size"];
			$ferror=$_FILES["file"]["error"];
			$ftemp=$_FILES["file"]["tmp_name"];
			@$extension = end(explode(".", $fname));
			if((($ftype == "image/gif") || ($ftype == "image/jpeg") || ($ftype == "image/png") || ($ftype == "image/pjpeg")) && ($fsize < 2000000)
			&& in_array($extension, $allowedExts)) {
			    if($ferror > 0) {
			    	$error['file']="File Error!";
		        } else {
		        	if(file_exists("blog_images/" . $fname)) {
		        		$error['file']="File already exists!";
		        	}
		    	}
		    } else {
		        $error['file']="Invalid File";
		    }

			if(@$error=='') {
				$connection=connect();
		        $article = mysqli_real_escape_string($connection, $article);  //escape string 
		 		$title = mysqli_real_escape_string($connection, $title);
		 		$query=mysqli_query($connection, "UPDATE blog_post SET heading='$title', article='$article' WHERE blogid='$id'");
		 		if($query) {
					move_uploaded_file($ftemp, "blog_images/" . $fname);   
					$fname="blog_images/".$fname;
					$insert=mysqli_query($connection, "UPDATE blog_images SET path='$fname' WHERE post_id='$id')");
					if($insert) {
						$error['success']="Blog edited successully!";
		 				$_SESSION['error']=$error;
						header("Location: myblog.php");
						exit();
					}
				}
			} else {
	    		$_SESSION['error']=$error;
	    	}
	    }
	}

	function recentposts() {
		$connection=connect();
		$query=mysqli_query($connection, "SELECT blog_post.blogid, LEFT(blog_post.heading, 20) AS heading, blog_user.firstname, blog_user.lastname FROM blog_post, blog_user WHERE blog_post.fkuserid=blog_user.user_id ORDER BY blogid DESC LIMIT 5");
		while($results=mysqli_fetch_array($query)) {
			echo "<br>";
			echo "<a href=\"posts.php?id=".$results['blogid']."\">".htmlentities($results['heading'])."</a><br>";
			echo " by <span id=\"commentor\">".htmlentities($results['firstname'])."&nbsp;".htmlentities($results['lastname'])."</span><br>";
			
		}
	}

	function recentcomments() {
		$connection=connect();
		$query=mysqli_query($connection, "SELECT LEFT(blog_comment.comments, 20) AS comments, blog_comment.name, blog_post.heading, blog_post.blogid FROM blog_comment, blog_post WHERE blog_comment.c_blog_id=blog_post.blogid ORDER BY blog_comment.c_id DESC LIMIT 5");
		while ($results=mysqli_fetch_array($query)) {
			echo "<br>";
			echo htmlentities($results['comments'])."...<br>"; 
			echo " by <span id=\"commentor\">".htmlentities($results['name'])."</span>";
			echo " on <a href=\"posts.php?id=".$results['blogid']."\">".htmlentities($results['heading'])."</a><br>";
		}
	}

	function delete_post($id) {
		$connection=connect();
		$query=mysqli_query($connection, "DELETE FROM blog_post WHERE blogid='$id'");
	}

	function country_option() {
		$connection=connect();
		$query=mysqli_query($connection, "SELECT * FROM blog_country");
		while ($country=mysqli_fetch_array($query)) {
			echo "<option value=\"".$country['id']."\">".$country['id']."&nbsp;.&nbsp;".$country['country']."</option>";
		}
	}

	function get_profile($id) {
		$connection=connect();
		
		$query=mysqli_query($connection, "SELECT user_profile.*, blog_user.*, blog_country.country AS nation FROM user_profile, blog_user, blog_country WHERE user_profile.fkuserid='$id' AND blog_user.user_id='$id' AND user_profile.country=blog_country.id");
		$profile=mysqli_fetch_array($query);
		echo $profile['firstname'];
		echo "&nbsp;";
		echo $profile['lastname'];
		echo "<br>";
		echo $profile['email'];
		echo "<br>";
		echo $profile['username'];
		echo "<br>";
		echo $profile['nation'];
		echo "<br>";
		echo $profile['dateofbirth'];
	}

?>