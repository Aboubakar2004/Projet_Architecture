<?php
require_once("bddconnexion.php");

session_start();

$user_id = $_SESSION["user_id"];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newName = $_POST["new_name"];
    $newSurname = $_POST["new_surname"];
    $newEmail = $_POST["new_email"];

    $updateQuery = $connexion->prepare("UPDATE users SET name = :new_name, surname = :new_surname, email = :new_email WHERE id = :user_id");
    $updateQuery->bindParam(':new_name', $newName, PDO::PARAM_STR);
    $updateQuery->bindParam(':new_surname', $newSurname, PDO::PARAM_STR);
    $updateQuery->bindParam(':new_email', $newEmail, PDO::PARAM_STR);
    $updateQuery->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $updateQuery->execute();
}

$query = $connexion->prepare("SELECT * FROM users WHERE id = :user_id");
$query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$query->execute();
$users = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <ul>
        <?php foreach ($users as $user) : ?>
            <li><?= $user['name']; ?><button onclick="showForm('name')">Modifier</button></li>
            <li><?= $user['surname']; ?><button onclick="showForm('surname')">Modifier</button></li>
            <li><?= $user['email']; ?><button onclick="showForm('email')">Modifier</button></li>
        <?php endforeach; ?>
    </ul>
    <form id="updateForm" method="post" style="display:none;">
        <label for="new_name">Nouveau Nom:</label>
        <input type="text" name="new_name" required><br>

        <label for="new_surname">Nouveau Prénom:</label>
        <input type="text" name="new_surname" required><br>

        <label for="new_email">Nouveau Email:</label>
        <input type="email" name="new_email" required><br>

        <button type="submit">Enregistrer</button>
    </form>

    <script>
        function showForm(field) {
            document.getElementsByName("new_name")[0].value = "<?= $user['name']; ?>";
            document.getElementsByName("new_surname")[0].value = "<?= $user['surname']; ?>";
            document.getElementsByName("new_email")[0].value = "<?= $user['email']; ?>";

            document.getElementById("updateForm").style.display = "block";
        }
    </script>
</body>

</html>