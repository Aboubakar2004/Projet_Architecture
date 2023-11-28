<?php
require_once("bddconnexion.php");

session_start();

$requete = $connexion->prepare("SELECT * FROM event");
$requete->execute();
$resultats = $requete->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des événements</title>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            <?php
            if (isset($_SESSION['reservation_success'])) {
                echo 'alert("' . $_SESSION['reservation_success'] . '");';
                unset($_SESSION['reservation_success']);
            } elseif (isset($_SESSION['reservation_error'])) {
                echo 'alert("' . $_SESSION['reservation_error'] . '");';
                unset($_SESSION['reservation_error']);
            }
            ?>
        });
    </script>
</head>

<body>

    <h1>Liste des événements</h1>

    <!-- index.php -->

    <?php
    if ($resultats) {
        foreach ($resultats as $event) {
            echo '<div>';
            echo '<h2>' . htmlspecialchars($event['event_name']) . '</h2>';
            echo '<p>Date: ' . htmlspecialchars($event['event_date']) . '</p>';
            echo '<p>Lieu: ' . htmlspecialchars($event['event_localisation']) . '</p>';
            echo '<p>Nombre place: ' . htmlspecialchars($event['event_place_number']) . '</p>';

            // Formulaire de réservation
            echo '<form action="reserver.php" method="post">';
            echo '<input type="hidden" name="event_id" value="' . $event['id'] . '">';
            echo '<button type="submit" name="reserve_button">Réserver</button>';
            echo '</form>';

            echo '</div>';
        }
    } else {
        echo '<p>Aucun événement trouvé.</p>';
    }
    ?>


</body>

</html>