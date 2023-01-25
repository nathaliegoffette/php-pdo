<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$ville = $_POST["ville"];
$haut = filter_input(INPUT_POST, "haut", FILTER_VALIDATE_INT);
$bas = filter_input(INPUT_POST, "bas", FILTER_VALIDATE_INT);


try
{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=weatherapp;charset=utf8', 'nathaliegoffette', 'becode');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}




$query = "INSERT INTO Météo (ville, haut, bas) VALUES (:ville, :haut, :bas)";

$stmt = $bdd->prepare($query);

$stmt->bindValue(':ville', $ville, PDO::PARAM_STR);
$stmt->bindValue('haut', $haut, PDO::PARAM_INT);
$stmt->bindValue('bas', $bas, PDO::PARAM_INT);
$stmt->execute();

if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    $error = $stmt->errorInfo();
    echo "Error: " . $error[2];
}

echo $query;


?>


