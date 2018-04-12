<?php
	$xml="<library><book>PHP Everyday</book>
	<book>Java</book>
	</library>";
	$sxe=simplexml_load_string($xml);
	$sxe->asXML('simple.xml'); //prints to browser
	 //writes to file
?>