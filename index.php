<?php

/*

PDO est une extension de PHP qui fournit une interface uniforme pour accéder à différentes bases de données, telles que MySQL, PostgreSQL, SQLite, etc. Elle facilite la gestion des connexions et des requêtes de base de données, et offre également une couche d'abstraction qui rend votre code plus portable entre différentes bases de données.

Pour commencer, vous devez vous assurer que l'extension PDO est activée dans votre installation PHP. Vous pouvez vérifier cela en consultant le fichier de configuration de PHP (php.ini) ou en exécutant la fonction phpinfo().

Une fois que vous avez confirmé que PDO est activé, vous pouvez commencer par établir une connexion à votre base de données. Voici un exemple de code pour se connecter à une base de données MySQL en utilisant PDO :

*/



$dsn = 'mysql:host=localhost;dbname=bddpdo';
$username = 'root';
$password = '';

try {
//Cette ligne marque le début du bloc d'essai. Le code à l'intérieur du bloc d'essai est exécuté, et si une exception est levée, elle sera capturée par le bloc catch.
    $connexion = new PDO($dsn, $username, $password);
    echo "Connexion réussie à la base de données.";
} catch (PDOException $e) {
// Cette ligne marque le début du bloc catch. Si une exception de type PDOException est levée dans le bloc try, elle sera capturée ici et le code à l'intérieur du bloc catch sera exécuté.
    echo "Erreur de connexion : " . $e->getMessage();
    // Si une exception PDOException est capturée, cette ligne affiche un message d'erreur qui inclut le message d'erreur spécifique de l'exception (récupéré à l'aide de la méthode getMessage()). Cela vous permet de connaître la cause de l'échec de la connexion à la base de données.
}


/*


Dans cet exemple, vous devez remplacer 'localhost' par l'adresse de votre serveur de base de données, 'nom_de_la_base_de_donnees' par le nom de votre base de données, 'votre_nom_utilisateur' par votre nom d'utilisateur de base de données et 'votre_mot_de_passe' par votre mot de passe de base de données.

Une fois que vous êtes connecté à la base de données, vous pouvez exécuter des requêtes en utilisant PDO. Voici un exemple pour sélectionner toutes les lignes d'une table et les afficher :


*/

$requete = $connexion->query("SELECT * FROM users");

while ($ligne = $requete->fetch()) {
    echo $ligne['username'] . " - " . $ligne['email'] . "<br>";
}

/*

1. `$requete = $connexion->query("SELECT * FROM users");` : Cette ligne exécute une requête SQL en utilisant la méthode `query()` de l'objet de connexion `$connexion`. La requête sélectionne toutes les colonnes (`*`) de la table "users". La méthode `query()` renvoie un objet de type PDOStatement qui représente le résultat de la requête.

2. `while ($ligne = $requete->fetch()) {` : Cette ligne commence une boucle while qui récupère chaque ligne du résultat de la requête. La méthode `fetch()` de l'objet PDOStatement renvoie la ligne suivante du résultat sous forme d'un tableau associatif, où les clés sont les noms des colonnes de la table et les valeurs sont les données correspondantes.

3. `echo $ligne['username'] . " - " . $ligne['email'] . "<br>";` : À l'intérieur de la boucle while, cette ligne affiche les valeurs des colonnes "username" et "email" de chaque ligne du résultat. Les valeurs sont concaténées avec le texte supplémentaire " - " et `<br>` est utilisé pour créer une nouvelle ligne HTML après chaque enregistrement.

La boucle while se poursuit tant qu'il y a des lignes à récupérer dans le résultat de la requête. Une fois que toutes les lignes ont été récupérées, la boucle se termine et le programme continue son exécution.

En résumé, ce code exécute une requête SELECT pour récupérer toutes les lignes de la table "users" de la base de données. Ensuite, il parcourt chaque ligne et affiche les valeurs des colonnes "username" et "email". Cela permet d'afficher les noms d'utilisateur et les adresses e-mail des utilisateurs de la table.

N'hésitez pas à me poser d'autres questions si vous en avez !

*/

/*

Dans cet exemple, 'users' est le nom de la table à partir de laquelle vous souhaitez récupérer les données. Vous pouvez personnaliser la requête en utilisant les clauses SQL appropriées.

PDO offre également une protection contre les attaques par injection SQL en utilisant les requêtes préparées. Voici un exemple d'utilisation des requêtes préparées avec PDO :

*/

echo "<br><br><br><br>";

$requete = $connexion->prepare("SELECT * FROM users WHERE username = :valeur");
$requete->bindParam(':valeur', $valeur);

$valeur = 'john_doe';
$requete->execute();

while ($ligne = $requete->fetch()) {
    echo $ligne['username'] . " - " . $ligne['email'] . "<br>";
}

/*


1. `$requete = $connexion->prepare("SELECT * FROM users WHERE username = :valeur");` : Cette ligne prépare une requête SQL en utilisant la méthode `prepare()` de l'objet de connexion `$connexion`. La requête sélectionne toutes les colonnes (`*`) de la table "users" où la colonne "username" correspond à une valeur spécifique. La valeur spécifique est représentée par le paramètre `:valeur`.

2. `$requete->bindParam(':valeur', $valeur);` : Cette ligne lie le paramètre `:valeur` de la requête préparée à une variable spécifique `$valeur`. La méthode `bindParam()` associe une variable à un paramètre de requête, ce qui permet d'exécuter la requête avec différentes valeurs sans avoir à reconstruire la requête.

3. `$valeur = 'john_doe';` : Cette ligne affecte la valeur `'john_doe'` à la variable `$valeur`. Cette valeur sera utilisée pour filtrer les résultats de la requête en fonction de la correspondance de la colonne "username".

4. `$requete->execute();` : Cette ligne exécute la requête préparée avec les valeurs actuelles des paramètres. Dans ce cas, la requête sera exécutée avec la valeur `'john_doe'` pour le paramètre `:valeur`.

5. `while ($ligne = $requete->fetch()) {` : Cette ligne commence une boucle while qui récupère chaque ligne du résultat de la requête. La méthode `fetch()` de l'objet PDOStatement renvoie la ligne suivante du résultat sous forme d'un tableau associatif.

6. `echo $ligne['username'] . " - " . $ligne['email'] . "<br>";` : À l'intérieur de la boucle while, cette ligne affiche les valeurs des colonnes "username" et "email" de chaque ligne du résultat, tout comme dans l'exemple précédent.

La boucle while continue tant qu'il y a des lignes correspondantes dans le résultat de la requête. Une fois que toutes les lignes ont été récupérées, la boucle se termine et le programme continue son exécution.

En résumé, ce code prépare une requête SELECT qui récupère les lignes de la table "users" où la colonne "username" correspond à une valeur spécifique (dans ce cas, `'john_doe'`). Ensuite, il exécute la requête avec cette valeur, récupère chaque ligne du résultat et affiche les valeurs des colonnes "username" et "email" pour chaque ligne correspondante.

N'hésitez pas à me poser d'autres questions si nécessaire !

*/





/*

Dans cet exemple, :valeur est un paramètre qui est lié à une valeur spécifique à l'aide de la méthode bindParam(). Cela permet d'éviter les attaques par injection SQL, car les valeurs sont correctement échappées.

Ceci conclut notre présentation et démo de l'utilisation de PDO en PHP. PDO offre une façon pratique et sécurisée d'interagir avec les bases de données dans vos applications PHP. J


*/


?>


