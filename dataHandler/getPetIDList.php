<?php
	require_once 'connectionInfo.php';
	$Query = $mysqli->query("SELECT Pet_ID, Name FROM pets;") or die($mysqli->error);
	$xml = new XMLWriter();
	$xml->openURI("php://output");
	$xml->startDocument();
	$xml->setIndent(true);
	$xml->startElement("pets");
	while($row = $Query->fetch_assoc())
	{
	    $xml->startElement("pets");
		$xml->startElement("petID");
			$xml->writeRaw($row['Pet_ID']);
		$xml->endElement();
		$xml->startElement("name");
			$xml->writeRaw($row['Name']);
		$xml->endElement();
		$xml->endElement();
	}
	$xml->endElement();
	header('Content-type: text/xml');
	$xml->flush();
?>