<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'bddpdo';

    try {
        $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username, $email, $password]);

        echo "Nouvel utilisateur créé avec succès";
    } catch (PDOException $e) {
        echo "Erreur lors de la création de l'utilisateur : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Création d'un utilisateur</title>
</head>
<body>
    <h1>Création d'un utilisateur</h1>
    <form method="post" action="create.php">
        <label>Nom d'utilisateur:</label>
        <input type="text" name="username" required><br><br>

        <label>Email:</label>
        <input type="email" name="email" required><br><br>

        <label>Mot de passe:</label>
        <input type="password" name="password" required><br><br>

        <input type="submit" value="Créer utilisateur">
    </form>
</body>
</html>
