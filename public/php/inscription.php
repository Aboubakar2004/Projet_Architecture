<?php
require_once('bddconnexion.php');

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = test_input($_POST['prenom']);
    $lastname = test_input($_POST['nom']);
    $email = test_input($_POST['email']);
    $number = test_input($_POST['telephone']);
    $password = test_input($_POST['password']);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $id_photo = $_FILES['pieceIdentite']['name'];
    $created_at = date('Y-m-d H:i:s');

    $insertion = $connexion->prepare("INSERT INTO users (firstname, surname, email, phonenumber, userpassword, id_photo, created_at)
    VALUES (:firstname, :surname, :email, :phonenumber, :userpassword, :id_photo, :created_at)");

    $insertion->bindParam(':firstname', $firstname);
    $insertion->bindParam(':surname', $lastname);
    $insertion->bindParam(':email', $email);
    $insertion->bindParam(':phonenumber', $number);
    $insertion->bindParam(':userpassword', $hashedPassword);
    $insertion->bindParam(':id_photo', $id_photo);
    $insertion->bindParam(':created_at', $created_at);
    $insertion->execute();

    echo $firstname . "</br>";
    echo $lastname . "</br>";
    echo $email . "</br>";
    echo $number . "</br>";
    echo $hashedPassword . "</br>"; // Affichez le mot de passe haché à des fins de vérification
    echo $id_photo . "</br>";
    echo $created_at . "</br>";
}

$connexion = null;

?>

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
        </div>

        <div>
            <label for="pieceIdentite">Pièce d'Identité (PDF):</label>
            <input type="file" id="pieceIdentite" name="pieceIdentite" accept=".pdf"><br>
        </div>

        <div>
            <button type="submit">Valider</button>
        </div>
    </form>
