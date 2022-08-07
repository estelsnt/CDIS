<?php
    require_once 'connectionInfo.php';
	$PetID = $_POST['PetID'];
	$OwnerID = $_POST['OwnerID'];
	
	$mysqli->query("UPDATE pets SET 
	Owner_ID='$OwnerID'
	WHERE Pet_ID=$PetID") or die($mysqli->error());
	
	
	
?>