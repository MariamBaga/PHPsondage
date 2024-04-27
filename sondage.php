<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Sondages</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Liste des Sondages</h1>
        <a href="ajoutSondage.php" class="btn btn-primary mb-3">Ajouter un Sondage</a>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Question</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                // Connexion à la base de données
                $pdo = new PDO('mysql:host=localhost;dbname=sondages', 'root', 'root');
// Vérifier si le formulaire de sondage a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $reponse = $_POST['reponse']; // Convertir la réponse en entier
    $sondageId = $_POST['sondage_id'];
    
    // Vérifier si l'utilisateur est connecté et si l'ID de l'utilisateur est défini dans la session
   
    
    // Insérer la réponse dans la base de données avec l'ID de l'utilisateur
    $stmt = $pdo->prepare('INSERT INTO reponses (sondage_id, reponse) VALUES (?, ?)');
    $stmt->execute([$sondageId, $reponse]);

    // Rediriger vers la page de résultats
    header('Location: sondage.php?id=' . $sondageId);
    exit;
}


                // Affichage des sondages disponibles si aucun ID n'est spécifié dans l'URL
                if (!isset($_GET['id'])) {
                    // Affichage des sondages disponibles
                    $stmt = $pdo->query('SELECT * FROM sondages');
                    $sondages = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // Afficher la liste des sondages
                    foreach ($sondages as $sondage) {
                        echo '<tr>';
                        echo '<th scope="row">' . $sondage['id'] . '</th>';
                        echo '<td><a href="sondage.php?id=' . $sondage['id'] . '">' . $sondage['question'] . '</a></td>';
                        echo '<td>';
                        echo '<div class="btn-group" role="group" aria-label="Actions">';
                        echo '<a href="modification.php?id=' . $sondage['id'] . '" class="btn btn-sm btn-info">Modifier</a>';
                        echo '<a href="supprimer.php?id=' . $sondage['id'] . '" class="btn btn-sm btn-danger">Supprimer</a>';
                        echo '</div>';
                        echo '</td>';
                        echo '</tr>';
                    }
                } else {
                    // Affichage du contenu du sondage si un ID est spécifié dans l'URL
                    $sondageId = $_GET['id'];

                    // Récupérer les détails du sondage
                    $stmt = $pdo->prepare('SELECT * FROM sondages WHERE id = ?');
                    $stmt->execute([$sondageId]);
                    $sondage = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($sondage) {
                        // Afficher le sondage
                        echo '<h1>' . $sondage['question'] . '</h1>';
                        echo '<h2>' . $sondage['titre'] . '</h2>';
                        echo '<p>' . $sondage['description'] . '</p>';

                        // Afficher les options du sondage
                        echo '<form method="post">';
                        echo '<input type="hidden" name="sondage_id" value="' . $sondageId . '">';

                        echo '<label for="reponse">Choisissez votre réponse :</label>';
                        echo '<select name="reponse" id="reponse" class="form-control">';
                        echo '<option value="1">' . $sondage['option1'] . '</option>';
                        echo '<option value="2">' . $sondage['option2'] . '</option>';
                        echo '<option value="3">' . $sondage['option3'] . '</option>';
                        echo '<option value="4">' . $sondage['option4'] . '</option>';
                        echo '</select>';

                        echo '<button type="submit" class="btn btn-primary mt-3">Soumettre</button>';
                        echo '</form>';
                        
                        // Ajouter le bouton pour afficher le graphe
                        echo '<a href="graphe.php?id=' . $sondage['id'] . '" class="btn btn-info mt-3">Voir le Graphe</a>';
                    } else {
                        echo 'Sondage non trouvé.';
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
