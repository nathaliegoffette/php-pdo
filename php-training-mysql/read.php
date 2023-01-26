<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Randonnées</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
    <style>
    table, th, td {
    border: 1px solid black;
    }
    </style>  
  </head>
  <body>

  <?php
try
{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=becode;charset=utf8', 'nathaliegoffette', 'becode');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}

$hiking = $bdd->query('SELECT * FROM hiking')->fetchAll(PDO::FETCH_ASSOC);

  ?>
    <h1>Liste des randonnées</h1>
    <!-- Afficher la liste des randonnées -->
    <table>
      <tr>
        <th>Nom</th>
        <th>Difficulté</th>
        <th>Distance</th>
        <th>Durée</th>
        <th>Dénivelé</th>
        
    <?php
foreach ($hiking as $data){
   echo  "<tr>";
       echo "<td>" .$data['name']. "</td>"; 
       echo "<td>" .$data['difficulty']. "</td>"; 
       echo "<td>" .$data['distance']. " km </td>"; 
       echo "<td>" .$data['duration']. "</td>"; 
       echo "<td>" .$data['height_difference']. " m </td>"; 

       echo '<td><a href="update.php?id=' . $data['id'] . '">Edit</a></td>';

      echo "<td>";
      echo "<form action='delete.php' method='post'>";
      echo "<input type='hidden' name='id' value='" . $data['id'] . "'>";
      echo "<input type='submit' value='Delete'>";
      echo "</form>";
      echo "</td>";
      echo "</tr>";
}
?>
  </table>
 
<a href="create.php">Create a new hiking</a>
</body>
</html>
