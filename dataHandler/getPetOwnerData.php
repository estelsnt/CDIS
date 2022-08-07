<?php
	require_once 'connectionInfo.php';
	$id = $_GET['id'];
	$Query = $mysqli->query("SELECT CONCAT(owner.Last_Name, \", \", owner.First_Name, \" \", owner.Middle_Name, \".\") AS ownerName, owner.Address, owner.Contact_Number FROM owner JOIN pets ON pets.Owner_ID = owner.Owner_ID WHERE owner.Owner_ID = {$id};") or die($mysqli->error);
	$owner = $Query->fetch_assoc();
	
	$xml = new XMLWriter();
	$xml->openURI("php://output");
	$xml->startDocument();
	$xml->setIndent(true);
	$xml->startElement("owner");
		$xml->startElement("name");
			$xml->writeRaw($owner['ownerName']);
		$xml->endElement();
		$xml->startElement("address");
			$xml->writeRaw($owner['Address']);
		$xml->endElement();
		$xml->startElement("contactnumber");
			$xml->writeRaw($owner['Contact_Number']);
		$xml->endElement();
	$xml->endElement();
	header('Content-type: text/xml');
	$xml->flush();
?>