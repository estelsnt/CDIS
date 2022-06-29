<?php
    require_once 'connectionInfo.php';
	
	$LastName = $_POST['LastName'];
	$FirstName = $_POST['FirstName'];
	$MiddleName = $_POST['MiddleName'];
	$ContactNumber = $_POST['ContactNumber'];
	$Address = $_POST['Address'];

	$mysqli->query("INSERT INTO owner (Last_Name, First_Name, Middle_Name, Contact_Number, Address) VALUES ('$LastName', '$FirstName', '$MiddleName', '$ContactNumber', '$Address')") or die($mysqli->error());
?>