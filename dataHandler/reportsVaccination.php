<?php
	require_once 'connectionInfo.php';
	$Query = $mysqli->query("SELECT vaccine.Vaccine_Name AS 'VaccineName',
	SUM(if(pets.Type = 'Cat', 1, 0)) AS 'Cats',
	SUM(if(pets.Type = 'Dog', 1, 0)) AS 'Dogs',
	COUNT(pet_vaccination.Pet_Vaccination_ID) AS 'Total'
	FROM pet_vaccination
	JOIN vaccine ON pet_vaccination.Vaccine_ID = vaccine.Vaccine_ID
	JOIN pets ON pet_vaccination.Pet_ID = pets.Pet_ID
	GROUP BY vaccine.Vaccine_Name;") or die($mysqli->error);
	
	$xml = new XMLWriter();
	$xml->openURI("php://output");
	$xml->startDocument();
	$xml->setIndent(true);
	$xml->startElement("vaccination");
	while($row = $Query->fetch_assoc())
	{
	    $xml->startElement("vaccine");
			$xml->startElement("VaccineName");
				$xml->writeRaw($row['VaccineName']);
			$xml->endElement();
			$xml->startElement("Cats");
				$xml->writeRaw($row['Cats']);
			$xml->endElement();
			$xml->startElement("Dogs");
				$xml->writeRaw($row['Dogs']);
			$xml->endElement();
			$xml->startElement("Total");
				$xml->writeRaw($row['Total']);
			$xml->endElement();
		$xml->endElement();
	}
	$xml->endElement();
	header('Content-type: text/xml');
	$xml->flush();
?>