<?php
	require_once 'connectionInfo.php';
    $PetID = $_POST['PetID'];
	$RFID = $_POST['RFID'];
	$PetName = $_POST['Name'];
	$PetGender = $_POST['Gender'];
	$PetAge = $_POST['Age'];
	$PetType = $_POST['Type'];
	$PetPicture = $_POST['Picture'];
	$PetNeuterOrSpay = $_POST['NeuterOrSpay'];
	
	$mysqli->query("UPDATE pets SET 
	RFID='$RFID', 
	Name='$PetName', 
	Gender='$PetGender', 
	Age=$PetAge, 
	Type='$PetType', 
	Picture='$PetPicture', 
	Neuter_Or_Spay='$PetNeuterOrSpay' 
	WHERE Pet_ID=$PetID") or die($mysqli->error());
	
	
	
?>