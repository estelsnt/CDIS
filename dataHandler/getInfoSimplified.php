<?php
	require_once 'connectionInfo.php';
	
	$DogsQuery = $mysqli->query("SELECT COUNT(Pet_ID) As AdoptedDogs FROM pets WHERE Type='Dog';") or die($mysqli->error);
	$Dogs = $DogsQuery->fetch_assoc();
	$CatsQuery = $mysqli->query("SELECT COUNT(Pet_ID) As AdoptedCats FROM pets WHERE Type='Cat';") or die($mysqli->error);
	$Cats = $CatsQuery->fetch_assoc();
	$VaccinatedQuery = $mysqli->query("SELECT COUNT(DISTINCT Pet_ID) As VaccinatedPets FROM pet_vaccination;") or die($mysqli->error);
	$Vaccinated = $VaccinatedQuery->fetch_assoc();
	$NeuteredSpayedQuery = $mysqli->query("SELECT COUNT(Pet_ID) As NeuteredOrSpayedPets FROM pets WHERE Neuter_Or_Spay = 'True';") or die($mysqli->error);
	$NeuteredSpayed = $NeuteredSpayedQuery->fetch_assoc();
	
	$xml = new XMLWriter();
	$xml->openURI("php://output");
	$xml->startDocument();
	$xml->setIndent(true);
	$xml->startElement("summary");
	$xml->startElement("dogs");
	$xml->writeRaw($Dogs['AdoptedDogs']);
	$xml->endElement();
	$xml->startElement("cats");
	$xml->writeRaw($Cats['AdoptedCats']);
	$xml->endElement();
	$xml->startElement("vaccinated");
	$xml->writeRaw($Vaccinated['VaccinatedPets']);
	$xml->endElement();
	$xml->startElement("neuteredorspayed");
	$xml->writeRaw($NeuteredSpayed['NeuteredOrSpayedPets']);
	$xml->endElement();
	$xml->endElement();
	header('Content-type: text/xml');
	$xml->flush();
	
?>