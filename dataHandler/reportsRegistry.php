<?php
	require_once 'connectionInfo.php';
	$Query = $mysqli->query("SELECT
	(SELECT COUNT(Pet_ID) FROM pets WHERE Gender = 'Male' And Type = 'Cat') AS MaleCats,
	(SELECT COUNT(Pet_ID) FROM pets WHERE Gender = 'Female' And Type = 'Cat') AS FemaleCats,
	(SELECT COUNT(Pet_ID) FROM pets WHERE Type = 'Cat') AS TotalCats,
	(SELECT COUNT(Pet_ID) FROM pets WHERE Gender = 'Male' And Type = 'Cat' AND Neuter_Or_Spay = 'True') AS NSMaleCats,
	(SELECT COUNT(Pet_ID) FROM pets WHERE Gender = 'Female' And Type = 'Cat' AND Neuter_Or_Spay = 'True') AS NSFemaleCats,
	(SELECT COUNT(Pet_ID) FROM pets WHERE Type = 'Cat' AND Neuter_Or_Spay = 'True') AS NSTotalCats,
	(SELECT COUNT(Pet_ID) FROM pets WHERE Gender = 'Male' And Type = 'Dog') AS MaleDogs,
	(SELECT COUNT(Pet_ID) FROM pets WHERE Gender = 'Female' And Type = 'Dog') AS FemaleDogs,
	(SELECT COUNT(Pet_ID) FROM pets WHERE Type = 'Dog') AS TotalDogs,
	(SELECT COUNT(Pet_ID) FROM pets WHERE Gender = 'Male' And Type = 'Dog' AND Neuter_Or_Spay = 'True') AS NSMaleDogs,
	(SELECT COUNT(Pet_ID) FROM pets WHERE Gender = 'Female' And Type = 'Dog' AND Neuter_Or_Spay = 'True') AS NSFemaleDogs,
	(SELECT COUNT(Pet_ID) FROM pets WHERE Type = 'Dog' AND Neuter_Or_Spay = 'True') AS NSTotalDogs,
	(SELECT COUNT(Pet_ID) FROM pets) AS TotalPets,
	(SELECT COUNT(Pet_ID) FROM pets WHERE Neuter_Or_Spay = 'True') AS NSTotalPets
	FROM pets LIMIT 1;") or die($mysqli->error);
	
	$reports = $Query->fetch_assoc();
	
	$xml = new XMLWriter();
	$xml->openURI("php://output");
	$xml->startDocument();
	$xml->setIndent(true);
	$xml->startElement("reports");
		$xml->startElement("MaleCats");
			$xml->writeRaw($reports['MaleCats']);
		$xml->endElement();
		$xml->startElement("FemaleCats");
			$xml->writeRaw($reports['FemaleCats']);
		$xml->endElement();
		$xml->startElement("TotalCats");
			$xml->writeRaw($reports['TotalCats']);
		$xml->endElement();
		$xml->startElement("NeuteredSpayedMaleCats");
			$xml->writeRaw($reports['NSMaleCats']);
		$xml->endElement();
		$xml->startElement("NeuteredSpayedFemaleCats");
			$xml->writeRaw($reports['NSFemaleCats']);
		$xml->endElement();
		$xml->startElement("NeuteredSpayedTotalCats");
			$xml->writeRaw($reports['NSTotalCats']);
		$xml->endElement();
		$xml->startElement("MaleDogs");
			$xml->writeRaw($reports['MaleDogs']);
		$xml->endElement();
		$xml->startElement("FemaleDogs");
			$xml->writeRaw($reports['FemaleDogs']);
		$xml->endElement();
		$xml->startElement("TotalDogs");
			$xml->writeRaw($reports['TotalDogs']);
		$xml->endElement();
		$xml->startElement("NeuteredSpayedMaleDogs");
			$xml->writeRaw($reports['NSMaleDogs']);
		$xml->endElement();
		$xml->startElement("NeuteredSpayedFemaleDogs");
			$xml->writeRaw($reports['NSFemaleDogs']);
		$xml->endElement();
		$xml->startElement("NeuteredSpayedTotalDogs");
			$xml->writeRaw($reports['NSTotalDogs']);
		$xml->endElement();
		$xml->startElement("TotalPets");
			$xml->writeRaw($reports['TotalPets']);
		$xml->endElement();
		$xml->startElement("NeuteredSpayedTotalPets");
			$xml->writeRaw($reports['NSTotalPets']);
		$xml->endElement();
	$xml->endElement();
	header('Content-type: text/xml');
	$xml->flush();
?>