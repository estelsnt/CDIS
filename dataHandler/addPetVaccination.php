<?php
    require_once 'connectionInfo.php';

	$PetID = $_POST['PetID'];
	$VaccineID = $_POST['VaccineID'];

	$mysqli->query("INSERT INTO pet_vaccination (Pet_ID, Vaccine_ID) VALUES ({$PetID}, {$VaccineID});") or die($mysqli->error());
?>