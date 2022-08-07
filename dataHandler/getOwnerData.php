<?php
	require_once 'connectionInfo.php';
	$id = $_GET['id'];
	$Query = $mysqli->query("SELECT * FROM owner WHERE Owner_ID={$id};") or die($mysqli->error);
	$pet = $Query->fetch_assoc();
	
	$xml = new XMLWriter();
	$xml->openURI("php://output");
	$xml->startDocument();
	$xml->setIndent(true);
	$xml->startElement("owner");
		$xml->startElement("id");
			$xml->writeRaw($pet['Owner_ID']);
		$xml->endElement();
		$xml->startElement("lastName");
			$xml->writeRaw($pet['Last_Name']);
		$xml->endElement();
		$xml->startElement("firstName");
			$xml->writeRaw($pet['First_Name']);
		$xml->endElement();
		$xml->startElement("middleName");
			$xml->writeRaw($pet['Middle_Name']);
		$xml->endElement();
		$xml->startElement("contactNumber");
			$xml->writeRaw($pet['Contact_Number']);
		$xml->endElement();
		$xml->startElement("address");
			$xml->writeRaw($pet['Address']);
		$xml->endElement();
	$xml->endElement();
	header('Content-type: text/xml');
	$xml->flush();
?>