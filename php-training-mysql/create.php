<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter une randonnée</title>
	<link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
	<a href="/php-pdo/php-training-mysql/read.php">Liste des données</a>
	<h1>Ajouter</h1>
	<form action="" method="post">
		<div>
			<label for="name">Name</label>
			<input type="text" name="name" value="">
		</div>

		<div>
			<label for="difficulty">Difficulté</label>
			<select name="difficulty">
				<option value="très facile">Très facile</option>
				<option value="facile">Facile</option>
				<option value="moyen">Moyen</option>
				<option value="difficile">Difficile</option>
				<option value="très difficile">Très difficile</option>
			</select>
		</div>

		<div>
			<label for="distance">Distance</label>
			<input type="text" name="distance" value="">
		</div>
		<div>
			<label for="duration">Durée</label>
			<input type="time" name="duration" value="">
		</div>
		<div>
			<label for="height_difference">Dénivelé</label>
			<input type="text" name="height_difference" value="">
		</div>
		<button type="submit" name="button">Envoyer</button>
	</form>

	<?php
	
try {
    // Connect to the database
    $bdd = new PDO('mysql:host=localhost;dbname=becode;charset=utf8', 'nathaliegoffette', 'becode');
} catch (Exception $e) {
    // If an error occurs, display the error message
    die('Error : ' . $e->getMessage());
}

// Retrieve the form data
$name = $_POST['name'];
$difficulty = $_POST['difficulty'];
$distance = $_POST['distance'];
$duration = $_POST['duration'];
$height_difference = $_POST['height_difference'];

// Insert the data into the database
$query = "INSERT INTO hiking (name, difficulty, distance, duration, height_difference) VALUES (:name, :difficulty, :distance, :duration, :height_difference)";
$stmt = $bdd->prepare($query);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':difficulty', $difficulty, PDO::PARAM_STR);
$stmt->bindValue(':distance', $distance, PDO::PARAM_INT);
$stmt->bindValue(':duration', $duration, PDO::PARAM_INT);
$stmt->bindValue(':height_difference', $height_difference, PDO::PARAM_INT);
$stmt->execute();



if ($stmt->execute()) {
    echo "New hiking created successfully";
} else {
    $error = $stmt->errorInfo();
    echo "Error: " . $error[2];
}
exit;

// Redirect the user to the read.php page
header('Location: read.php');
?>
</body>
</html>
