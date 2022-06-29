<?php
	require_once 'connectionInfo.php';
	$OwnerID = $_POST['OwnerID'];
	$LastName = $_POST['LastName'];
	$FirstName = $_POST['FirstName'];
	$MiddleName = $_POST['MiddleName'];
	$ContactNumber = $_POST['ContactNumber'];
	$Address = $_POST['Address'];

	$mysqli->query("UPDATE owner SET 
	Last_Name='$LastName', 
	First_Name='$FirstName', 
	Middle_Name='$MiddleName', 
	Contact_Number='$ContactNumber', 
	Address='$Address'
	WHERE Owner_ID=$OwnerID") or die($mysqli->error());
?>