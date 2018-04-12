<?php
	phpinfo(); ?>
	<?php

	/*//$xml="<library><book>PHP Everyday</book></library>";
	//$sxe=simplexml_load_string($xml);
	//print $sxe->asXML(); //prints to browser
	 //writes to file
	$myxml=simplexml_load_file('test.xml');
	echo $myxml->note->to."<br>";
	echo $myxml->note[1]->to."<br>";
	foreach ($myxml as $val) {
		echo "Note by: ".$val->from."<br>";
		echo "To ".$val->to.", this is the message: "."<br>";
		echo $val->body."<br>";
		echo "<br>";
	}

	print_r ($myxml->children());
	echo "<br>";

?>

<?php 
	$connection=mysqli_connect("localhost", "root", "vertrigo", "blog_db") or die("Could not connect to the database!");
	$query=mysqli_query($connection, "SELECT user_profile.*, blog_user.*, blog_country.country AS nation FROM user_profile, blog_user, blog_country WHERE user_profile.fkuserid=blog_user.user_id AND user_profile.country=blog_country.id");
	$xml="<user>";
	while($profile=mysqli_fetch_array($query)) {
		$xml.="<profile>";
		$xml.="<firstname>".$profile['firstname']."</firstname>";
		
		$xml.="<lastname>".$profile['lastname']."</lastname>";
		
		$xml.="<email>".$profile['email']."</email>";
		
		$xml.="<username>".$profile['username']."</username>";
		
		$xml.="<nation>".$profile['nation']."</nation>";
		
		$xml.="<dob>".$profile['dateofbirth']."</dob>";
		$xml.="</profile>";
	}
	$xml.="</user>";
	$sxe=simplexml_load_string($xml);
	$sxe->asXML('myxml.xml');
	foreach ($sxe as $value) {
		foreach ($value as $nextval) {
			echo $nextval."&nbsp;";
		}
		echo "<br>";
		# code...
	}
	echo "<br>";
	//echo $sxe->profile->email; //accessing individul element
	echo "<br>";

	$user=$sxe->profile;
	//print $user->email;
	echo "<br>";

	foreach ($sxe as $value) {
		//echo $value->email."<br>";
	}

	$userprofile=$sxe->profile[2];
	//echo $userprofile->username."<br>";

	//to access children when we don't know the structure
	$children=$sxe->children();
	//print_r($children);
	echo "<br>";

	//for iteration
	foreach ($children as $value) {
		echo $value->firstname."&nbsp;".$value->lastname."<br>";
	}

	$loadxml=simplexml_load_file('test.xml');
	//print $loadxml->asXML();
	foreach ($loadxml as $value) {
		foreach ($value as $key) {
			echo $key."<br>";
		}
	}

?>	