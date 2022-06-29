<?php
	require_once 'connectionInfo.php';
	$mysqli = new mysqli('localhost', 'id18938107_group7', 'qMk>80[+J~R>+E?$', 'id18938107_cdis');
	$Query = $mysqli->query("SELECT Owner_ID, Last_Name, First_Name, Middle_Name FROM owner;") or die($mysqli->error);
	$xml = new XMLWriter();
	$xml->openURI("php://output");
	$xml->startDocument();
	$xml->setIndent(true);
	$xml->startElement("owner");
	while($row = $Query->fetch_assoc())
	{
	    $xml->startElement("owner");
		$xml->startElement("ownerID");
			$xml->writeRaw($row['Owner_ID']);
		$xml->endElement();
		$xml->startElement("lastName");
			$xml->writeRaw($row['Last_Name']);
		$xml->endElement();
		$xml->startElement("firstName");
			$xml->writeRaw($row['First_Name']);
		$xml->endElement();
		$xml->startElement("middleName");
			$xml->writeRaw($row['Middle_Name']);
		$xml->endElement();
		$xml->endElement();
	}
	$xml->endElement();
	header('Content-type: text/xml');
	$xml->flush();
?>