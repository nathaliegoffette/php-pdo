<?php
/**** Supprimer une randonnée ****/
try {
    $bdd = new PDO('mysql:host=localhost;dbname=becode;charset=utf8', 'nathaliegoffette', 'becode');
    $stmt = $bdd->prepare("DELETE FROM hiking WHERE id = :id");
    $stmt->bindParam(':id', $_POST['id']);
    $stmt->execute();
}
catch(Exception $e) {
    die('Erreur : '.$e->getMessage());
}

// Redirect the user to the read.php page
header('Location: read.php');

?>
