<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter une randonnée</title>
	<link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
	<a href="/php-pdo/php-training-mysql/read.php">Liste des données</a>

	<?php

try {
    // Connect to the database
    $bdd = new PDO('mysql:host=localhost;dbname=becode;charset=utf8', 'nathaliegoffette', 'becode');
} catch (Exception $e) {
    // If an error occurs, display the error message
    die('Error : ' . $e->getMessage());
}
	

	$id = $_GET['id'];
	$stmt = $bdd->prepare('SELECT * FROM hiking WHERE id = ?');
	$stmt->execute([$id]);
	$hiking = $stmt->fetch(PDO::FETCH_ASSOC);

	$name = $_POST['name'];
	$difficulty = $_POST['difficulty'];
	$distance = $_POST['distance'];
	$duration = $_POST['duration'];
	$height_difference = $_POST['height_difference'];
	$update_id = $_POST['id'];

	$stmt = $bdd->prepare('UPDATE hiking SET name = ?, difficulty = ?, distance = ?, duration = ?, height_difference = ? WHERE id = ?');
	$stmt->execute([$name, $difficulty, $distance, $duration, $height_difference, $update_id]);

	//header('Location: read.php');


	?>
	
	<h1>Ajouter</h1>
	<form action="" method="post">
		<div>
			<label for="name">Name</label>
			<input type="text" name="name" value="<?php echo $hiking['name']?>">
		</div>

		<div>
			<label for="difficulty">Difficulté</label>
			<select name="difficulty" value="<?php echo $hiking['difficulty']?>">
				<option value="très facile">Très facile</option>
				<option value="facile">Facile</option>
				<option value="moyen">Moyen</option>
				<option value="difficile">Difficile</option>
				<option value="très difficile">Très difficile</option>
			</select>
		</div>
		
		<div>
			<label for="distance">Distance</label>
			<input type="text" name="distance" value="<?php echo $hiking['distance']?>">
		</div>
		<div>
			<label for="duration">Durée</label>
			<input type="duration" name="duration" value="<?php echo $hiking['duration']?>">
		</div>
		<div>
			<label for="height_difference">Dénivelé</label>
			<input type="text" name="height_difference" value="<?php echo $hiking['height_difference']?>">
		</div>
		<input type="hidden" name="id" value="<?php echo $hiking['id'] ?>">
  		<input type="submit" value="Update">	</form>
	

</body>
</html>
