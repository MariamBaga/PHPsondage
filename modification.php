<?php
// Vérifiez si l'identifiant du sondage est présent dans l'URL
if(isset($_GET['id'])) {
    // Connexion à la base de données
    $pdo = new PDO('mysql:host=localhost;dbname=sondages', 'root', 'root');

    // Récupérer l'identifiant du sondage depuis l'URL
    $sondageId = $_GET['id'];

    // Vérifier si le formulaire a été soumis
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les données du formulaire
        $question = $_POST['question'];
        $titre = $_POST['titre'];
        $description = $_POST['description'];
        $option1 = $_POST['option1'];
        $option2 = $_POST['option2'];
        $option3 = $_POST['option3'];
        $option4 = $_POST['option4'];

        // Mettre à jour les informations du sondage dans la base de données
        $stmt = $pdo->prepare('UPDATE sondages SET question = ?, titre = ?, description = ?, option1 = ?, option2 = ?, option3 = ?, option4 = ? WHERE id = ?');
        $stmt->execute([$question, $titre, $description, $option1, $option2, $option3, $option4, $sondageId]);

        // Rediriger vers la page de liste des sondages après la modification
        header('Location: sondage.php');
        exit;
    }

    // Récupérer les détails du sondage à modifier depuis la base de données
    $stmt = $pdo->prepare('SELECT * FROM sondages WHERE id = ?');
    $stmt->execute([$sondageId]);
    $sondage = $stmt->fetch(PDO::FETCH_ASSOC);

    if($sondage) {
        // Afficher le formulaire pré-rempli avec les détails du sondage
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Modifier Sondage</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        </head>
        <body>
            <div class="container">
                <h1>Modifier Sondage</h1>
                <form method="post">
                    <div class="form-group">
                        <label for="question">Question</label>
                        <input type="text" class="form-control" id="question" name="question" value="<?= $sondage['question'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="titre">Titre</label>
                        <input type="text" class="form-control" id="titre" name="titre" value="<?= $sondage['titre'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description"><?= $sondage['description'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="option1">Option 1</label>
                        <input type="text" class="form-control" id="option1" name="option1" value="<?= $sondage['option1'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="option2">Option 2</label>
                        <input type="text" class="form-control" id="option2" name="option2" value="<?= $sondage['option2'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="option3">Option 3</label>
                        <input type="text" class="form-control" id="option3" name="option3" value="<?= $sondage['option3'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="option4">Option 4</label>
                        <input type="text" class="form-control" id="option4" name="option4" value="<?= $sondage['option4'] ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </form>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo 'Sondage non trouvé.';
    }
} else {
    // Rediriger vers la page de liste des sondages si aucun identifiant de sondage n'est spécifié
    header('Location: sondage.php');
    exit;
}
?>
