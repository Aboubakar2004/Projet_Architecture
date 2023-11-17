<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>

<body>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" enctype="multipart/form-data">
        <div>
            <label for="prenom">Prénom:</label>
            <input type="text" id="prenom" name="prenom"><br>

            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom"><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email"><br>

            <label for="telephone">Téléphone:</label>
            <input type="tel" id="telephone" name="telephone"><br>

            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password"><br>

            <label for="artiste">Artiste</label>
            <input type="radio" id="artiste" name="role" value="artiste"><br>

            <label for="commercant">Commerçant</label>
            <input type="radio" id="commercant" name="role" value="commercant"><br>
        </div>

        <div>
            <label for="pieceIdentite">Pièce d'Identité (PDF):</label>
            <input type="file" id="pieceIdentite" name="pieceIdentite" accept=".pdf"><br>
        </div>

        <div>
            <button type="submit">Valider</button>
        </div>
    </form>

</body>

</html>

<?php
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
        $firstname = test_input($_POST['prenom']);
        $lastname = test_input($_POST['nom']);
        $email = test_input($_POST['email']);
        $number = test_input($_POST['telephone']);
        $password = test_input($_POST['password']);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $id_photo = $_FILES['pieceIdentite']['name'];
        $created_at = date('Y-m-d H:i:s');

        $isArtiste = isset($_POST['role']) && $_POST['role'] === 'artiste' ? 1 : 0;
        $isCommercant = isset($_POST['role']) && $_POST['role'] === 'commercant' ? 1 : 0;

        $insertion = $connexion->prepare("INSERT INTO users 
            (name, surname, email, number, password, id_photo, created_at, is_artiste, is_commercant) 
            VALUES (:firstname, :surname, :email, :phonenumber, :password, :id_photo, :created_at, :isArtiste, :isCommercant)");

        $insertion->bindParam(':firstname', $firstname);
        $insertion->bindParam(':surname', $lastname);
        $insertion->bindParam(':email', $email);
        $insertion->bindParam(':phonenumber', $number);
        $insertion->bindParam(':password', $hashedPassword);
        $insertion->bindParam(':id_photo', $id_photo);
        $insertion->bindParam(':created_at', $created_at);
        $insertion->bindParam(':isArtiste', $isArtiste);
        $insertion->bindParam(':isCommercant', $isCommercant);

        $insertion->execute();
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}

$connexion = null;
?>