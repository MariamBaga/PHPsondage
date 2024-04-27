<?php
// Assurez-vous que l'ID du sondage est présent
if (!isset($_GET['id'])) {
    // Rediriger vers une page d'erreur si l'ID n'est pas fourni
    header('Location: erreur.php');
    exit;
}

// Récupérer l'ID du sondage
$sondageId = $_GET['id'];

// Traitement de la suppression si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier si le bouton de confirmation de suppression a été cliqué
    if (isset($_POST['supprimer'])) {
        // Connexion à la base de données
        $conn = new mysqli('localhost', 'root', 'root', 'sondages');

        // Vérifier la connexion
        if ($conn->connect_error) {
            die("Erreur de connexion à la base de données : " . $conn->connect_error);
        }

        // Échapper les données pour éviter les injections SQL
        $sondageId = $conn->real_escape_string($sondageId);

        // Écrire la requête de suppression
        $sql = "DELETE FROM sondages WHERE id = '$sondageId'";

        // Exécuter la requête
        if ($conn->query($sql) === TRUE) {
            // Redirection vers la page d'accueil après la suppression
            header('Location: sondage.php');
            exit;
        } else {
            echo "Erreur lors de la suppression du sondage : " . $conn->error;
        }

        // Fermer la connexion
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppression de Sondage</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="my-5">Suppression de Sondage</h1>
        <div class="alert alert-danger" role="alert">
            Êtes-vous sûr de vouloir supprimer ce sondage ?
        </div>
        <form action="supprimer.php" method="post">
    <input type="hidden" name="sondage_id" value="<?php echo $sondageId; ?>">
    <button type="submit" class="btn btn-danger" name="supprimer">Oui, Supprimer</button>
    <a href="sondage.php" class="btn btn-secondary">Annuler</a>
</form>

    </div>
</body>
</html>
