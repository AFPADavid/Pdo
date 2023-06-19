<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'bddpdo';

    try {
        $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $id = $_POST['id'];

        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);

        echo "Utilisateur supprimé avec succès";
    } catch (PDOException $e) {
        echo "Erreur lors de la suppression de l'utilisateur : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Suppression d'un utilisateur</title>
</head>
<body>
    <h1>Suppression d'un utilisateur</h1>
    <form method="post" action="delete.php">
        <label>ID de l'utilisateur à supprimer:</label>
        <input type="text" name="id" required><br><br>

        <input type="submit" value="Supprimer utilisateur">
    </form>
</body>
</html>
