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
			<li><img src="images/icon.png" height="62px" width="62px"/></li>
			<li><a href="index.php">Home</a></li>
			<li><a href="about.php">About</a></li>
			<li><a class="active"  href="adopt.php">Adopt a Pet!</a></li>
		  </ul>

		<div class="header">
	  <img src="images/cover logo.png" alt="Cats and Dogs brand" class="center">
	</div>
	
	<div class="imagesContainer">
		
		<table class="center2" style="width: 80%;">
			<?php while($row = $PetsForAdoption->fetch_assoc()): ?>	
			<tr>
				<td><?php echo '<img src="data:image/jpeg;base64,'.$row['Picture'].'"/>'; ?></td>
				<td><?php echo 'Name:' . $row['Name'] . '</br>Gender: ' . $row['Gender'] . '</br>Age: ' . $row['Age']; ?></td>
			</tr>		
			<?php endwhile; ?>
		</table>
	</div>
	</body>
</html>