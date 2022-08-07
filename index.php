<?php
	require_once 'dataHandler/process.php';
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title> Cats & Dogs Identification System</title>
<link rel="icon" type="image/x-icon" href="images/icon.ico">
<link rel="stylesheet" type="text/css" href="styles/style.css">
</head>
<body>

    <ul>
        <li><img src="images/icon.png" height="62px" width="62px"></li>
        <li><a class="active" href="index.php">Home</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="adopt.php">Adopt a Pet!</a></li>
    </ul>

    <br>
    <div>
        <img src="images/cover logo.png" alt="Cats and Dogs brand" class="center" width="1450px">
    </div>
    <br>
<table class="center2">
    <tr>
        <td>Dogs:</td>
        <td><?php echo $Dogs['AdoptedDogs']; ?></td>
    </tr>
    <tr>
        <td>Cats:</td>
        <td><?php echo $Cats['AdoptedCats']; ?></td>
    </tr>
    <tr>
        <td>Vaccinated:</td>
        <td><?php echo $Vaccinated['VaccinatedPets']; ?></td>
    </tr>
    <tr>
        <td>Neutered/Spayed : </td>
        <td><?php echo $NeuteredSpayed['NeuteredOrSpayedPets']; ?></td>
    </tr>
</table>
<br><br><br><br>


<div class="home">
<p><strong>INSTRUCTION TO REGISTER YOUR LOVE PETS:</strong>
<br>
<br>
<strong>1. </strong>Go to the nearest Barangay.<br>
<strong>2. </strong>Ask the receptionist for the registration.<br>
<strong>3. </strong>Fill out the form given.<br>
</p>
<p class="note"><strong>Note:</strong>
Before you proceed please check all the requirements needed.</p>
</div>

<br><br><br>

<p class="cred">Cats and Dogs Identification System.<br>
All Rights Reserved.</p>

</body>
</html>