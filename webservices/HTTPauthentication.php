<?php

  // test for username/password

  if(($_SERVER['PHP_AUTH_USER'] == "mia") AND

    ($_SERVER['PHP_AUTH_PW'] == "secret"))

  {
    echo("Logged in successfully!<br>");
  }
  else

  {    //Send headers to cause a browser to request

    //username and password from user
    header("WWW-Authenticate: " .
    "Basic realm=\"Protected Area\"");
     

    header("HTTP/1.0 401 Unauthorized");

    //Show failure text, which browsers usually

    //show only after several failed attempts

    print("This page is protected by HTTP ");

  }

?>
