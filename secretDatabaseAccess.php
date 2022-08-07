<?php
	require_once 'dataHandler/process.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<title>secret database access</title>
		<link rel="stylesheet" type="text/css" href="styles/secretDatabaseAccessStyles.css">
	</head>
	<body>
		<h3>SECRET DATABASE ACCESS (for developers only)</h3>
		<div>
			<p>
				Instruction:
				</br>
				do not set or edit any ID (this is auto generated in database)
				</br>
				for adding pets set the respective owner ID from owner table (if adding pet for adoption set owner ID to 1)
				</br>
				for pet type input Cat or Dog
				</br>
				for pet gender input Male or Female
				</br>
				for pet neuter or spayed input True or False
				</br>
				pet RFID can be left blank
				</br>
				(this page do not have input checking function, any invalid input will result to error and will not be saved to database*)
				</br>
				for pet vaccination choose the vaccine ID from vaccine table and pet ID from pet table
				</br>
				deletion of data must be done carefully due to table constraints
				</br>
				deleting record must be done in this order: pet vaccination -> vaccine -> pet -> owner 
				</br>
				tiagan wag mo na lagyan ng css to 
			</p>
		</div>
		<div class="dataTableDiv">
			<div class="data">
				<table class="dataTable">
					<thead>
						<tr>
							<th>ID</th>
							<th>Last name</th>
							<th>First name</th>
							<th>Middle name</th>
							<th>Contact number</th>
							<th>Address</th>
						</tr>
						<?php while($row = $owner->fetch_assoc()): ?>
						<tr>
							<td> <?php echo $row['Owner_ID']; ?></td>
							<td> <?php echo $row['Last_Name']; ?></td>
							<td> <?php echo $row['First_Name']; ?></td>
							<td> <?php echo $row['Middle_Name']; ?></td>
							<td> <?php echo $row['Contact_Number']; ?></td>
							<td> <?php echo $row['Address']; ?></td>	
							<td>
								<a href="secretDatabaseAccess.php?editOwner=<?php echo $row['Owner_ID']; ?>">edit</a>
								<a href="process.php?deleteOwner=<?php echo $row['Owner_ID']; ?>">delete</a>
							</td>
						</tr>
						<?php endwhile; ?>
					</thead>
				</table>
			</div>
			<div class="dataForm">
				<form action="process.php" method="POST">
					<label>owner</label></br>
					<label>ID</label>
					<input type="text" name="Owner_ID" value="<?php echo $OwnerID; ?>"><br>
					<label>Last name</label>
					<input type="text" name="Last_Name" value="<?php echo $OwnerLastName; ?>"><br>
					<label>First name</label>
					<input type="text" name="First_Name" value="<?php echo $OwnerFirstName; ?>"><br>
					<label>Middle_Name</label>
					<input type="text" name="Middle_Name" value="<?php echo $OwnerMiddleName; ?>"><br>
					<label>Contact number</label>
					<input type="text" name="Contact_Number" value="<?php echo $OwnerContactNumber; ?>"><br>
					<label>Address</label>
					<input type="text" name="Address" value="<?php echo $OwnerAddress; ?>"><br>
					<?php if($editOwner == true): ?>
					<button type="submit" name="updateOwner">update</button>
					<?php else: ?>
					<button type="submit" name="saveOwner">Save</button>
					<?php endif; ?>
				</form>
			</div>
		</div>
		
		<div class="dataTableDiv">
			<div class="data">
				<table class="dataTable">
					<thead>
						<tr>
							<th>ID</th>
							<th>Owner ID</th>
							<th>RFID</th>
							<th>Name</th>
							<th>Gender</th>
							<th>Age</th>
							<th>Type</th>
							<th>Picture</th>
							<th>Neuter or spay</th>
						</tr>
						<?php while($row = $pets->fetch_assoc()): ?>
						<tr>	
							<td> <?php echo $row['Pet_ID']; ?></td>
							<td> <?php echo $row['Owner_ID']; ?></td>
							<td> <?php echo $row['RFID']; ?></td>
							<td> <?php echo $row['Name']; ?></td>
							<td> <?php echo $row['Gender']; ?></td>
							<td> <?php echo $row['Age']; ?></td>
							<td> <?php echo $row['Type']; ?></td>	
							<td> <?php echo '<img height="100px" width="100px" src="data:image/jpeg;base64,'.$row['Picture'].'"/>'; ?></td>
							<td> <?php echo $row['Neuter_Or_Spay']; ?></td>						
							<td>
								<a href="secretDatabaseAccess.php?editPet=<?php echo $row['Pet_ID'];?>">edit</a>
								<a href="secretDatabaseAccess.php?deletePet=<?php echo $row['Pet_ID'];?>">delete</a>
							</td>
						</tr>
						<?php endwhile; ?>
					</thead>
				</table>
			</div>
			<div class="dataForm">
				<form action="" method="POST" enctype="multipart/form-data">
					<label>pets</label></br>
					<label>ID</label>
					<input type="text" name="Pet_ID" value="<?php echo $PetID; ?>"><br>
					<label>Owner ID</label>
					<input type="text" name="Pet_Owner_ID" value="<?php echo $PetOwnerID; ?>"><br>
					<label>RFID</label>
					<input type="text" name="RFID" value="<?php echo $RFID; ?>"><br>
					<label>Name</label>
					<input type="text" name="Name" value="<?php echo $PetName; ?>"><br>
					<label>Gender</label>
					<input type="text" name="Gender" value="<?php echo $PetGender; ?>"><br>
					<label>Age</label>
					<input type="text" name="Age" value="<?php echo $PetAge; ?>"><br>
					<label>Type</label>
					<input type="text" name="Type" value="<?php echo $PetType; ?>"><br>
					<label>Picture</label>
					<input type="file" name="Picture"><br>
					<label>Neuter or spayed</label>
					<input type="text" name="Neuter_Or_Spay" value="<?php echo $PetNeuterOrSpay; ?>"><br>
					<?php if($editPet == true): ?>
					<button type="submit" name="updatePet">update</button>
					<?php else: ?>
					<button type="submit" name="savePet">Save</button>
					<?php endif; ?>
				</form>
			</div>
		</div>

		<div class="dataTableDiv">		
			<div class="data">
				<table class="dataTable">
					<thead>
						<tr>
							<th>ID</th>
							<th>Vaccine</th>
						</tr>
						<?php while($row = $vaccine->fetch_assoc()): ?>
						<tr>	
							<td> <?php echo $row['Vaccine_ID']; ?></td>
							<td> <?php echo $row['Vaccine_Name']; ?></td>	
							<td>
								<a href="secretDatabaseAccess.php?editVaccine=<?php echo $row['Vaccine_ID'];?>">edit</a>
								<a href="secretDatabaseAccess.php?deleteVaccine=<?php echo $row['Vaccine_ID']; ?>">delete</a>
							</td>
						</tr>
						<?php endwhile; ?>
					</thead>
				</table>
			</div>
			<div class="dataForm">
				<form action="" method="POST">
					<label>vaccine</label></br>
					<label>ID</label>
					<input type="text" name="Vaccine_ID" value="<?php echo $VaccineID; ?>"><br>
					<label>Vaccine name</label>
					<input type="text" name="Vaccine_Name" value="<?php echo $Vaccine; ?>"><br>
					<?php if($editVaccine == true): ?>
					<button type="submit" name="updateVaccine">update</button>
					<?php else: ?>
					<button type="submit" name="saveVaccine">Save</button>
					<?php endif; ?>
				</form>
			</div>
		</div>
		<div class="dataTableDiv">	
			<div class="data">
				<table class="dataTable">
					<thead>
						<tr>
							<th>ID</th>
							<th>Pet</th>
							<th>Vaccine</th>
						</tr>
						<?php while($row = $petVaccination->fetch_assoc()): ?>
						<tr>	
							<td> <?php echo $row['Pet_Vaccination_ID']; ?></td>
							<td> <?php echo $row['Pet_ID']; ?></td>	
							<td> <?php echo $row['Vaccine_ID']; ?></td>	
							<td>
								<a href="secretDatabaseAccess.php?editPetVaccination=<?php echo $row['Pet_Vaccination_ID'];?>">edit</a>
								<a href="secretDatabaseAccess.php?deletePetVaccination=<?php echo $row['Pet_Vaccination_ID'];?>">delete</a>
							</td>
						</tr>
						<?php endwhile; ?>
					</thead>
				</table>
			</div>
			<div class="dataForm">
				<form action="" method="POST">
					<label>pet vaccination</label></br>
					<label>ID</label>
					<input type="text" name="Pet_Vaccination_ID" value="<?php echo $PetVaccinationID; ?>"><br>
					<label>Pet</label>
					<input type="text" name="Vaccination_Pet_ID" value="<?php echo $PetVaccinationPetID; ?>"><br>
					<label>Vaccine</label>
					<input type="text" name="Vaccination_Vaccine_ID" value="<?php echo $PetVaccinationVaccineID; ?>"><br>
					<?php if($editPetVaccination == true): ?>
					<button type="submit" name="updatePetVaccination">update</button>
					<?php else: ?>
					<button type="submit" name="savePetVaccination">Save</button>
					<?php endif; ?>
				</form>
			</div>
		</div>
		
	</body>
</html>