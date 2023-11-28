<?php
require_once('bddconnexion.php');

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $firstname = $_POST['prenom'];
        $lastname = $_POST['nom'];
        $email = $_POST['email'];
        $number = $_POST['telephone'];
        $password = $_POST['password'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $id_photo = $_FILES['pieceIdentite']['name'];
        $created_at = date('Y-m-d H:i:s');

        // Check if the email or phone number already exists in the database
        $checkExisting = $connexion->prepare("SELECT COUNT(*) FROM users WHERE email = :email OR number = :number");
        $checkExisting->bindParam(':email', $email);
        $checkExisting->bindParam(':number', $number);
        $checkExisting->execute();
        $count = $checkExisting->fetchColumn();

        if ($count > 0) {
            // Email or phone number already exists, handle accordingly (e.g., display an error message)
            echo "Email or phone number already exists.";
            exit();
        }

        $isArtiste = isset($_POST['role']) && $_POST['role'] === 'artiste' ? 1 : 0;
        $isCommercant = isset($_POST['role']) && $_POST['role'] === 'commercant' ? 1 : 0;
        $isUser = isset($_POST['role']) && $_POST['role'] === 'Utilisateur' ? 1 : 0;

        $insertion = $connexion->prepare("INSERT INTO users 
        (name, surname, email, number, password, id_photo, created_at, is_artiste, is_commercant, is_admin, utilisateur) 
        VALUES (:firstname, :surname, :email, :phonenumber, :password, :id_photo, :created_at, :isArtiste, :isCommercant, :isAdmin, :utilisateur)");

        $insertion->bindParam(':firstname', $firstname);
        $insertion->bindParam(':surname', $lastname);
        $insertion->bindParam(':email', $email);
        $insertion->bindParam(':phonenumber', $number);
        $insertion->bindParam(':password', $hashedPassword);
        $insertion->bindParam(':id_photo', $id_photo);
        $insertion->bindParam(':created_at', $created_at);
        $insertion->bindParam(':isArtiste', $isArtiste);
        $insertion->bindParam(':isCommercant', $isCommercant);
        $insertion->bindParam(':isAdmin', $isAdmin);
        $insertion->bindParam(':utilisateur', $isUser);

        $insertion->execute();

        // Set session variable to simulate user login
        session_start();
        $_SESSION['user_name'] = $firstname;

        header("Location: mainPage.php");
        exit();
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
    exit();
}

$connexion = null;
?>
