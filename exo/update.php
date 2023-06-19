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
        $email = $_POST['email'];

        $sql = "UPDATE users SET email = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email, $id]);

        echo "Mise à jour de l'utilisateur réussie";
    } catch (PDOException $e) {
        echo "Erreur lors de la mise à jour de l'utilisateur : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mise à jour d'un utilisateur</title>
</head>
<body>
    <h1>Mise à jour d'un utilisateur</h1>
    <form method="post" action="update.php">
        <label>ID de l'utilisateur:</label>
        <input type="text" name="id" required><br><br>

        <label>Nouvel email:</label>
        <input type="email" name="email" required><br><br>

        <input type="submit" value="Mettre à jour utilisateur">
    </form>
</body>
</html>
