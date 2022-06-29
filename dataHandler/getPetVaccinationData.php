<?php
	require_once 'connectionInfo.php';
	$id = $_GET['id'];
	$Query = $mysqli->query("SELECT vaccine.Vaccine_Name FROM vaccine join pet_vaccination ON vaccine.Vaccine_ID = pet_vaccination.Vaccine_ID WHERE pet_vaccination.Pet_ID = {$id};") or die($mysqli->error);
	
	$xml = new XMLWriter();
	$xml->openURI("php://output");
	$xml->startDocument();
	$xml->setIndent(true);
	$xml->startElement("petvaccine");
	while($row = $Query->fetch_assoc())
	{
	    $xml->startElement("vaccine");
		$xml->startElement("vaccineName");
			$xml->writeRaw($row['Vaccine_Name']);	
		$xml->endElement();
		$xml->endElement();
	}
	$xml->endElement();
	header('Content-type: text/xml');
	$xml->flush();
?>