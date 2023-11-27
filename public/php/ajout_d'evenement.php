<?php
session_start();
require_once("bddconnexion.php");

try {
    if (isset($_SESSION["user_id"])) {
        $user_id = $_SESSION["user_id"];
        $query = $connexion->prepare("SELECT is_artiste FROM users WHERE id = :user_id");
        $query->bindParam(':user_id', $user_id);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if ($user['is_artiste'] == 1) {
                echo '
                <form method = "POST">
                <div>
                <label>Nom de l\'évènement</label>
                <input name="event_name" type=""></input>
                <label>Date de l\'évènement</label>
                <input type="date" name="event_date"></input>
                <label>Localisation de l\'évènement</label>
                <input name="event_localisation" type="text"></input>
                <label>Nombre de place</label>
                <input type="number" name="event_place_number"></input>
                <label>Evenement complet</label>
                <input type="checkbox" name="event_complete"></input>
                <button name="ok_button">Ajouter l\'évènement</button>
                </div>
                </form>';
            } else {
                echo 'Vous n\'avez pas la permission d\'accéder à cette page.';
            }
        } else {
            echo 'Utilisateur non trouvé.';
        }
    } else {
        echo 'Utilisateur non connecté.';
    }
} catch (PDOException $e) {
    echo "Erreur de base de données : " . $e->getMessage();
}

?>

<?php
require_once("bddconnexion.php");

try {
    if (isset($_POST["ok_button"])) {
        $artiste_id = $_SESSION["user_id"];
        $event_name = $_POST["event_name"];
        $event_date = $_POST["event_date"];
        $event_localisation = $_POST["event_localisation"];
        $event_place_number = $_POST["event_place_number"];
        $event_complete = isset($_POST["event_complete"]) ? 1 : 0;

        $query = $connexion->prepare("INSERT INTO event (artiste_id, event_name, event_date, event_localisation, event_place_number, availability) VALUES (:artiste_id, :event_name, :event_date, :event_localisation, :event_place_number, :availability)");

        $query->bindParam(':artiste_id', $artiste_id);
        $query->bindParam(':event_name', $event_name);
        $query->bindParam(':event_date', $event_date);
        $query->bindParam(':event_localisation', $event_localisation);
        $query->bindParam(':event_place_number', $event_place_number);
        $query->bindParam(':availability', $event_complete);

        $query->execute();
    }
} catch (PDOException $e) {
    echo "Erreur de base de données : " . $e->getMessage();
}

$connexion = null;
?>
