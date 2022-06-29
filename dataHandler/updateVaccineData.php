<?php
	require_once 'connectionInfo.php';
	$VaccineID = $_POST['VaccineID'];
	$VaccineName = $_POST['VaccineName'];

	$mysqli->query("UPDATE vaccine SET Vaccine_Name='$VaccineName' WHERE Vaccine_ID={$VaccineID};") or die($mysqli->error());
?>