<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>

<body>

    <h2>Connexion</h2>

    <form method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required><br>

        <button type="submit">Se Connecter</button>
    </form>

</body>

</html>


<?php
session_start();

require_once('bddconnexion.php');

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = test_input($_POST['email']);
        $password = test_input($_POST['password']);

        $query = $connexion->prepare("SELECT * FROM users WHERE email = :email");
        $query->bindParam(':email', $email);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION["user_id"] = $user['id'];
            header("Location: ajout_d'evenement.php");
            exit();
        } else {
            echo 'Identifiants invalides. Veuillez réessayer.';
        }
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}

$connexion = null;
?>