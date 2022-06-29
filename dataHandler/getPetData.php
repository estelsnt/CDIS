<?php
	require_once 'connectionInfo.php';
	$id = $_GET['id'];
	$Query = $mysqli->query("SELECT * FROM pets WHERE Pet_ID={$id};") or die($mysqli->error);
	$pet = $Query->fetch_assoc();
	
	$xml = new XMLWriter();
	$xml->openURI("php://output");
	$xml->startDocument();
	$xml->setIndent(true);
	$xml->startElement("pet");
		$xml->startElement("id");
			$xml->writeRaw($pet['Pet_ID']);
		$xml->endElement();
		$xml->startElement("ownerID");
			$xml->writeRaw($pet['Owner_ID']);
		$xml->endElement();
		$xml->startElement("rfid");
			$xml->writeRaw($pet['RFID']);
		$xml->endElement();
		$xml->startElement("name");
			$xml->writeRaw($pet['Name']);
		$xml->endElement();
		$xml->startElement("gender");
			$xml->writeRaw($pet['Gender']);
		$xml->endElement();
		$xml->startElement("age");
			$xml->writeRaw($pet['Age']);
		$xml->endElement();
		$xml->startElement("type");
			$xml->writeRaw($pet['Type']);
		$xml->endElement();
		$xml->startElement("neuterspayed");
			$xml->writeRaw($pet['Neuter_Or_Spay']);
		$xml->endElement();
		
		$xml->startElement("picture");
			$xml->writeRaw($pet['Picture']);
		$xml->endElement();
		
	$xml->endElement();
	header('Content-type: text/xml');
	$xml->flush();
?>