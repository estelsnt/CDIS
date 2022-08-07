<?php
	require_once 'connectionInfo.php';
	
	$PetOwnerID = $_POST['PetOwnerID'];
	$RFID = $_POST['RFID'];
	$PetName = $_POST['Name'];
	$PetGender = $_POST['Gender'];
	$PetAge = $_POST['Age'];
	$PetType = $_POST['Type'];
	$Picture = $_POST['Picture'];
	$PetNeuterOrSpay = $_POST['NeuterOrSpay'];
		
	$mysqli->query("INSERT INTO pets (Owner_ID, RFID, Name, Gender, Age, Type, Picture, Neuter_Or_Spay) VALUES ($PetOwnerID, '$RFID', '$PetName', '$PetGender', $PetAge, '$PetType', '$Picture', '$PetNeuterOrSpay')") or die($mysqli->error);
?>