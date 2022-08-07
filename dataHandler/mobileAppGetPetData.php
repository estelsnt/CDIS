<?php
	require_once 'connectionInfo.php';
	$id = $_GET['id'];
	$Query1 = $mysqli->query("SELECT * FROM pets WHERE RFID={$id};") or die($mysqli->error);
	$pet = $Query1->fetch_assoc();
	$Query2 = $mysqli->query("SELECT CONCAT(owner.Last_Name, \", \", owner.First_Name, \" \", owner.Middle_Name, \".\") AS ownerName, owner.Address, owner.Contact_Number FROM owner JOIN pets ON pets.Owner_ID = owner.Owner_ID WHERE owner.Owner_ID = {$pet['Owner_ID']};") or die($mysqli->error);
	$owner = $Query2->fetch_assoc();
?>

<html>
	<head>
		<title>CDIS PET DATA</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<style>
			body{
				background: linear-gradient(-145deg, #0c0910, #1A3C40, #1D5C63, #417D7A);
			}
			.imageContainer{
				display: flex;
				justify-content: center;
				align-items: center;
			}
			img{
				height: 50vh;
				width: 70vw;
			}
			h1, h2{
				margin-left: 3vw;
				color: white;
			}
			.footer{
				height: 5vh;
			}
		</style>
	</head>
	<body>
		<div class="imageContainer">
			<?php echo '<img src="data:image/jpeg;base64,'.$pet['Picture'].'"/>'; ?>
		</div>
		<h1> Name: <?php echo $pet['Name']; ?></h1>
		<h2>Sex: <?php echo $pet['Gender']; ?> <h2>
		<h2>Neuter or spayed: <?php echo $pet['Neuter_Or_Spay']; ?> <h2>
		<hr>
		<h2>Owner: <?php echo $owner['ownerName']; ?> <h2>
		<h2>Address: <?php echo $owner['Address']; ?> <h2>
		<h2>Contact Number: <span id="cn"><?php echo $owner['Contact_Number']; ?></span><h2>
		<div class="footer">
		</div>
		<script>
			const number = document.getElementById("cn");
			window.AppInventor.setWebViewString(number.innerText);
		</script>
	</body>
</html>