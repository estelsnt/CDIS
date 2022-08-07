<?php
	require_once 'connectionInfo.php';
	
	//owner variables
	$editOwner = false;
	$OwnerID = 0;
	$OwnerLastName = '';
	$OwnerFirstName = '';
	$OwnerMiddleName = '';
	$OwnerContactNumber = '';
	$OwnerAddress = '';
	
	//pet variables
	$editPet = false;
	$PetID = 0;
	$PetOwnerID = 0;
	$RFID = '';
	$PetName = '';
	$PetGender = '';
	$PetAge = 0;
	$PetType = '';
	$PetPicture = null;
	$PetNeuterOrSpay = '';
	
	//vaccine variables
	$editVaccine = false;
	$VaccineID = 0;
	$Vaccine = '';
	
	//pet vaccination variables
	$editPetVaccination = false;
	$PetVaccinationID = 0;
	$PetVaccinationPetID = 0;
	$PetVaccinationVaccineID = 0;
	
	//retrieve
	$owner = $mysqli->query("SELECT * FROM owner;") or die($mysqli->error);
	$pets = $mysqli->query("SELECT * FROM pets;") or die($mysqli->error);
	$vaccine = $mysqli->query("SELECT * FROM vaccine;") or die($mysqli->error);
	$petVaccination = $mysqli->query("SELECT * FROM pet_vaccination;") or die($mysqli->error);
	
	
	//to display in homepage
	$DogsQuery = $mysqli->query("SELECT COUNT(Pet_ID) As AdoptedDogs FROM pets WHERE Type='Dog';") or die($mysqli->error);
	$Dogs = $DogsQuery->fetch_assoc();
	$CatsQuery = $mysqli->query("SELECT COUNT(Pet_ID) As AdoptedCats FROM pets WHERE Type='Cat';") or die($mysqli->error);
	$Cats = $CatsQuery->fetch_assoc();
	$VaccinatedQuery = $mysqli->query("SELECT COUNT(DISTINCT Pet_ID) As VaccinatedPets FROM pet_vaccination;") or die($mysqli->error);
	$Vaccinated = $VaccinatedQuery->fetch_assoc();
	$NeuteredSpayedQuery = $mysqli->query("SELECT COUNT(Pet_ID) As NeuteredOrSpayedPets FROM pets WHERE Neuter_Or_Spay = 'True';") or die($mysqli->error);
	$NeuteredSpayed = $NeuteredSpayedQuery->fetch_assoc();
	//to display in pet for adoption
	$PetsForAdoption = $mysqli->query("SELECT * FROM pets WHERE Owner_ID = 1;") or die($mysqli->error);
	
	//owner crud
	if(isset($_POST['saveOwner'])){
		$ownerID = $_POST['Last_Name'];
		$firstName = $_POST['First_Name'];
		$middleName = $_POST['Middle_Name'];
		$contactNumber = $_POST['Contact_Number'];
		$address = $_POST['Address'];
		$mysqli->query("INSERT INTO owner (Last_Name, First_Name, Middle_Name, Contact_Number, Address) VALUES ('$lastName', '$firstName', '$middleName', '$contactNumber', '$address')") or die($mysqli->error);
		header("location: secretDatabaseAccess.php");
	}
	
	if(isset($_GET['editOwner'])){
		$OwnerID = $_GET['editOwner'];
		$editOwner = true;
		$result = $mysqli->query("SELECT * FROM owner WHERE Owner_ID=$OwnerID;") or die($mysqli->error());
		if(count(array($result)) > 0){
			$row = $result->fetch_array();
			$OwnerLastName = $row['Last_Name'];
			$OwnerFirstName = $row['First_Name'];
			$OwnerMiddleName = $row['Middle_Name'];
			$OwnerContactNumber = $row['Contact_Number'];
			$OwnerAddress = $row['Address'];
		}
	}
	
	if(isset($_POST['updateOwner'])){
		$OwnerID = $_POST['Owner_ID'];
		$OwnerLastName = $_POST['Last_Name'];
		$OwnerFirstName = $_POST['First_Name'];
		$OwnerMiddleName = $_POST['Middle_Name'];
		$OwnerContactNumber = $_POST['Contact_Number'];
		$OwnerAddress = $_POST['Address'];
		$mysqli->query("UPDATE owner SET Last_Name='$OwnerLastName', First_Name='$OwnerFirstName', Middle_Name='$OwnerMiddleName', Contact_Number='$OwnerContactNumber', Address='$OwnerAddress' WHERE Owner_ID=$OwnerID") or die($mysqli->error());
		header('location: secretDatabaseAccess.php');
	}
	
	if(isset($_GET['deleteOwner'])){
		$id =  $_GET['deleteOwner'];
		$mysqli->query("DELETE FROM owner WHERE Owner_ID =$id") or die($mysqli->error());
		header("location: secretDatabaseAccess.php");
	}
	
	//pet crud
	if(isset($_POST['savePet'])){
		$editPet = false;
		$PetOwnerID = $_POST['Pet_Owner_ID'];
		$RFID = $_POST['RFID'];
		$PetName = $_POST['Name'];
		$PetGender = $_POST['Gender'];
		$PetAge = $_POST['Age'];
		$PetType = $_POST['Type'];
		
		//uploading image all image is converted to base64 string for easy transport
		$file = base64_encode(file_get_contents($_FILES['Picture']['tmp_name']));
				
		$PetNeuterOrSpay = $_POST['Neuter_Or_Spay'];;
		
		$mysqli->query("INSERT INTO pets (Owner_ID, RFID, Name, Gender, Age, Type, Picture, Neuter_Or_Spay) VALUES ($PetOwnerID, '$RFID', '$PetName', '$PetGender', $PetAge, '$PetType', '$file', '$PetNeuterOrSpay')") or die($mysqli->error);
		header("location: secretDatabaseAccess.php");
	}
	//selecting pet to edit
	if(isset($_GET['editPet'])){
		$PetID = $_GET['editPet'];
		$editPet = true;
		$result = $mysqli->query("SELECT * FROM pets WHERE Pet_ID=$PetID;") or die($mysqli->error());
		if(count(array($result)) > 0){
			$row = $result->fetch_array();
			$PetID = $row['Pet_ID'];
			$PetOwnerID = $row['Owner_ID'];
			$RFID = $row['RFID'];
			$PetName = $row['Name'];
			$PetGender = $row['Gender'];
			$PetAge = $row['Age'];
			$PetType = $row['Type'];
			$PetPicture = $row['Picture'];
			$PetNeuterOrSpay = $row['Neuter_Or_Spay'];
		}
	}
	
	if(isset($_POST['updatePet'])){
		$PetID = $_POST['Pet_ID'];
		$PetOwnerID = $_POST['Pet_Owner_ID'];
		$RFID = $_POST['RFID'];
		$PetName = $_POST['Name'];
		$PetGender = $_POST['Gender'];
		$PetAge = $_POST['Age'];
		$PetType = $_POST['Type'];
		$PetPicture = base64_encode(file_get_contents($_FILES['Picture']['tmp_name']));
		$PetNeuterOrSpay = $_POST['Neuter_Or_Spay'];
		$mysqli->query("UPDATE pets SET Owner_ID=$PetOwnerID, RFID='$RFID', Name='$PetName', Gender='$PetGender', Age=$PetAge, Type='$PetType', Picture='$PetPicture', Neuter_Or_Spay='$PetNeuterOrSpay' WHERE Pet_ID=$PetID") or die($mysqli->error());
		header('location: secretDatabaseAccess.php');
	}
	
	if(isset($_GET['deletePet'])){
		$id =  $_GET['deletePet'];
		$mysqli->query("DELETE FROM pets WHERE Pet_ID =$id") or die($mysqli->error());
		header("location: secretDatabaseAccess.php");
	}
	
	//vaccine crud
	if(isset($_POST['saveVaccine'])){
		$editVaccine = false;
		$Vaccine = $_POST['Vaccine_Name'];	
		$mysqli->query("INSERT INTO vaccine (Vaccine_Name) VALUES ('$Vaccine')") or die($mysqli->error);
		header("location: secretDatabaseAccess.php");
	}
	
	if(isset($_GET['editVaccine'])){
		$VaccineID = $_GET['editVaccine'];
		$editVaccine = true;
		$result = $mysqli->query("SELECT * FROM vaccine WHERE Vaccine_ID=$VaccineID;") or die($mysqli->error());
		if(count(array($result)) > 0){
			$row = $result->fetch_array();
			$VaccineID = $row['Vaccine_ID'];
			$Vaccine = $row['Vaccine_Name'];
		}
	}
	
	if(isset($_POST['updateVaccine'])){
		$VaccineID = $_POST['Vaccine_ID'];
		$Vaccine = $_POST['Vaccine_Name'];
		$mysqli->query("UPDATE vaccine SET Vaccine_Name='$Vaccine' WHERE Vaccine_ID=$VaccineID") or die($mysqli->error());
		header('location: secretDatabaseAccess.php');
	}
	
	if(isset($_GET['deleteVaccine'])){
		$id =  $_GET['deleteVaccine'];
		$mysqli->query("DELETE FROM vaccine WHERE Vaccine_ID =$id") or die($mysqli->error());
		header("location: secretDatabaseAccess.php");
	}
	
	//pet vaccination crud
	if(isset($_POST['savePetVaccination'])){
		$editPetVaccination = false;
		$PetVaccinationPetID = $_POST['Vaccination_Pet_ID'];
		$PetVaccinationVaccineID = $_POST['Vaccination_Vaccine_ID'];
		$mysqli->query("INSERT INTO pet_vaccination (Pet_ID, Vaccine_ID) VALUES ($PetVaccinationPetID, $PetVaccinationVaccineID)") or die($mysqli->error);
		header("location: secretDatabaseAccess.php");
	}
	
	if(isset($_GET['editPetVaccination'])){
		$VaccinationID = $_GET['editPetVaccination'];
		$editPetVaccination = true;
		$result = $mysqli->query("SELECT * FROM pet_vaccination WHERE Pet_Vaccination_ID=$VaccinationID;") or die($mysqli->error());
		if(count(array($result)) > 0){
			$row = $result->fetch_array();
			$PetVaccinationID = $row['Pet_Vaccination_ID'];
			$PetVaccinationPetID = $row['Pet_ID'];
			$PetVaccinationVaccineID = $row['Vaccine_ID'];
		}
	}
	
	if(isset($_POST['updatePetVaccination'])){
		$PetVaccinationID = $_POST['Pet_Vaccination_ID'];
		$PetVaccinationPetID = $_POST['Vaccination_Pet_ID'];
		$PetVaccinationVaccineID = $_POST['Vaccination_Vaccine_ID'];
		$mysqli->query("UPDATE pet_vaccination SET Pet_ID=$PetVaccinationPetID, Vaccine_ID=$PetVaccinationVaccineID WHERE Pet_Vaccination_ID=$PetVaccinationID") or die($mysqli->error());
		header('location: secretDatabaseAccess.php');
	}
	
	if(isset($_GET['deletePetVaccination'])){
		$id =  $_GET['deletePetVaccination'];
		$mysqli->query("DELETE FROM pet_vaccination WHERE Pet_Vaccination_ID =$id") or die($mysqli->error());
		header("location: secretDatabaseAccess.php");
	}
?>













