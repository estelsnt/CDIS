<?php
    require_once 'connectionInfo.php';

	$VaccineName = $_POST['VaccineName'];

	$mysqli->query("INSERT INTO vaccine (Vaccine_Name) VALUES ('{$VaccineName}');") or die($mysqli->error());
?>