<?php
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'bddpdo';

try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $email = $_POST['email'];

        $sql = "UPDATE users SET email = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email, $id]);

        echo "Mise à jour de l'utilisateur réussie";
    }

    if (isset($_POST['delete'])) {
        $id = $_POST['id'];

        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);

        echo "Utilisateur supprimé avec succès";
    }

    $sql = "SELECT * FROM users";
    $stmt = $pdo->query($sql);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur lors de la lecture des utilisateurs : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des utilisateurs</title>
</head>
<body>
    <h1>Liste des utilisateurs</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Nom d'utilisateur</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        <?php foreach ($users as $user) { ?>
            <tr>
                <form method="post" action="liste.php">
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td>
                        <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
                        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                    </td>
                    <td>
                        <button type="submit" name="update">Mettre à jour</button>
                        <button type="submit" name="delete">Supprimer</button>
                    </td>
                </form>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
