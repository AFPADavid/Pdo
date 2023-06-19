<?php


$bdd = 'mysql:host=localhost;dbname=bddpdo';
$username = 'root';
$password = '';


try {
    $connexion = new PDO($bdd, $username, $password);
    echo "Connexion Réussi !<br><br>";
} catch( PDOException $e ){
    echo "Erreur de connexion : ".$e->getMessage()." <br><br>"; 
}

$requete = $connexion->query("SELECT * FROM users");

echo "<table>";

while($ligne = $requete->fetch() ){
    echo "<tr><td>".$ligne['username']." </td><td> ". $ligne['email']." </td></tr>";
    // var_dump($ligne);
}

echo "</table>";



$requet2 =  $connexion->prepare("SELECT * FROM users WHERE username = :valeur");
$requet2 -> bindParam (':valeur', $maValeur);

$maValeur = "john_doe";
$requet2->execute();

echo "<br><br><br><br><br>";


echo "<table>";
while($ligne = $requet2->fetch() ){
    echo "<tr><td class='maclass'>".$ligne['username']." </td><td> ". $ligne['email']." </td></tr>";
    // var_dump($ligne);
}
echo "</table>";


?>