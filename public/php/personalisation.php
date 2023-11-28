<?php
require_once("bddconnexion.php");

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
}

$query = $connexion->prepare("SELECT * FROM users WHERE id = :user_id");
$query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$query->execute();
$users = $query->fetchAll(PDO::FETCH_ASSOC);

$profilePhotoPath = !empty($users) ? $users[0]['profile_photo_path'] : '';
?>
