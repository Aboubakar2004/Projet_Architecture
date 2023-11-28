<?php
require_once("../php/bddconnexion.php");

session_start();

$user_id = $_SESSION["user_id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["update_info"])) {
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

    if (isset($_FILES["profile_photo"])) {
        if ($_FILES["profile_photo"]["error"] == 0) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["profile_photo"]["name"]);

            if (move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $target_file)) {
                $updatePhotoQuery = $connexion->prepare("UPDATE users SET profile_photo_path = :photo_path WHERE id = :user_id");
                $photoPath = $target_file;
                $updatePhotoQuery->bindParam(':photo_path', $photoPath, PDO::PARAM_STR);
                $updatePhotoQuery->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $updatePhotoQuery->execute();
            }
        }
    }
};

$query = $connexion->prepare("SELECT * FROM users WHERE id = :user_id");
$query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$query->execute();
$users = $query->fetchAll(PDO::FETCH_ASSOC);

$profilePhotoPath = !empty($users) ? $users[0]['profile_photo_path'] : '';
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
            <li>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                    <label for="profile_photo">Ajouter une Photo de profil</label>
                    <input type="file" name="profile_photo" accept="image/*">
                    <button type="submit">Télécharger</button>
                </form>
            </li>
            <li>
                <?php if (!empty($profilePhotoPath)) : ?>
                    <img src="<?= $profilePhotoPath ?>" alt="Photo de profil">
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
    <form id="updateForm" method="post" style="display:none">
        <label for="new_name">Nouveau Nom:</label>
        <input type="text" name="new_name" required><br>

        <label for="new_surname">Nouveau Prénom:</label>
        <input type="text" name="new_surname" required><br>

        <label for="new_email">Nouveau Email:</label>
        <input type="email" name="new_email" required><br>

        <button type="submit">Enregistrer</button>
        <input type="hidden" name="update_info" value="1"> 
    </form>

    <script>
    <?php foreach ($users as $user) : ?>
        var userData = <?php echo json_encode($user); ?>;
        <?php break; // Utilisez break pour sortir de la boucle après le premier utilisateur ?>
    <?php endforeach; ?>

    function showForm(field) {
        var newNameElement = document.getElementsByName("new_name")[0];
        var newSurnameElement = document.getElementsByName("new_surname")[0];
        var newEmailElement = document.getElementsByName("new_email")[0];

        if (newNameElement) {
            newNameElement.value = userData.name;
        }
        if (newSurnameElement) {
            newSurnameElement.value = userData.surname;
        }
        if (newEmailElement) {
            newEmailElement.value = userData.email;
        }

        document.getElementById("updateForm").style.display = "block";
    }
</script>

</body>

</html>