<?php
	require_once 'connectionInfo.php';
	$Query = $mysqli->query("SELECT * FROM vaccine;") or die($mysqli->error);
	$xml = new XMLWriter();
	$xml->openURI("php://output");
	$xml->startDocument();
	$xml->setIndent(true);
	$xml->startElement("vaccineList");
	while($row = $Query->fetch_assoc())
	{
	    $xml->startElement("vaccine");
			$xml->startElement("vaccineID");
				$xml->writeRaw($row['Vaccine_ID']);
			$xml->endElement();
			$xml->startElement("vaccineName");
				$xml->writeRaw($row['Vaccine_Name']);
			$xml->endElement();
		$xml->endElement();
	}
	$xml->endElement();
	header('Content-type: text/xml');
	$xml->flush();
?>