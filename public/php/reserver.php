<?php
// Assurez-vous que la session est démarrée au début de chaque fichier
session_start();

require_once("bddconnexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["reserve_button"])) {
    // Assurez-vous que l'utilisateur est connecté (vous pouvez ajouter des vérifications supplémentaires)
    if (isset($_SESSION["user_id"])) {
        $user_id = $_SESSION["user_id"];
        $event_id = $_POST["event_id"];

        // Vérifier si l'utilisateur a déjà réservé cet événement
        $checkReservationQuery = $connexion->prepare("SELECT id FROM users_reservations WHERE users_id = :user_id AND event_id = :event_id");
        $checkReservationQuery->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $checkReservationQuery->bindParam(':event_id', $event_id, PDO::PARAM_INT);
        $checkReservationQuery->execute();
        $existingReservation = $checkReservationQuery->fetch(PDO::FETCH_ASSOC);

        if ($existingReservation) {
            $_SESSION['reservation_error'] = "Vous avez déjà réservé cet événement.";
        } else {
            // Récupérer la date et la disponibilité de l'événement depuis la table event
            $getEventQuery = $connexion->prepare("SELECT event_date, availability FROM event WHERE id = :event_id");
            $getEventQuery->bindParam(':event_id', $event_id, PDO::PARAM_INT);
            $getEventQuery->execute();
            $eventData = $getEventQuery->fetch(PDO::FETCH_ASSOC);

            if ($eventData) {
                $event_date = $eventData['event_date'];
                $event_disponibility = $eventData['availability'];

                // Insérer dans la table users_reservations
                $insertQuery = $connexion->prepare("INSERT INTO users_reservations (users_id, event_id, event_date, event_disponibility) VALUES (:user_id, :event_id, :event_date, :event_disponibility)");
                $insertQuery->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $insertQuery->bindParam(':event_id', $event_id, PDO::PARAM_INT);
                $insertQuery->bindParam(':event_date', $event_date, PDO::PARAM_STR);
                $insertQuery->bindParam(':event_disponibility', $event_disponibility, PDO::PARAM_INT);
                $insertQuery->execute();

                $_SESSION['reservation_success'] = "Réservation effectuée avec succès!";
            } else {
                $_SESSION['reservation_error'] = "Événement non trouvé.";
            }
        }
    } else {
        $_SESSION['reservation_error'] = "Veuillez vous connecter pour réserver.";
    }
}

// Redirection vers la page précédente
header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
