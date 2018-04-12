<?php
	$xml = new DOMDocument("1.0");
	$root = $xml->createElement("data");
	$xml->appendChild($root);
	$id   = $xml->createElement("id");
	$idText = $xml->createTextNode('1');
	$id->appendChild($idText);
	$title   = $xml->createElement("title");
	$titleText = $xml->createTextNode('"PHP Undercover"');
	$title->appendChild($titleText);
	$book = $xml->createElement("book");
	$book->appendChild($id);
	$book->appendChild($title);
	$root->appendChild($book);
	 $xml->formatOutput = true;
	echo "<xmp>". $xml->saveXML() ."</xmp>";
	$xml->save("mybooks.xml") or die("Error");
?>



<?php 
$xmlString = <<< LAST 
		<?xml version="1.0"?>
		<data xmlns:home="http://www.mysite.com/xmlns/home" xmlns:pdf="http://www.mysite.com/xmlns/work">
		  <home:file>content1.doc</home:file>
		  <pdf:file>content2.pdf</pdf:file>
		  <pdf:file>content3.pdf</pdf:file>  
		  <home:file>content4.txt</home:file>
		  <home:file>content5.rtf</home:file>
		  <pdf:file>content6.pdf</pdf:file>        
		</data>
LAST;

	$xml=simplexml_load_string($xmlString);
	foreach ($xml->children("http://www.mysite.com/xmlns/work") as $value) {
		echo $value."<br>";
	}
 
?>