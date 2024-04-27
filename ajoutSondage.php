<?php



// Vérifier si le formulaire d'ajout de sondage a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
                $question = $_POST['question'];
                    $option1 = $_POST['option1'];
                        $option2 = $_POST['option2'];
                            $option3 = $_POST['option3'];
                                $option4 = $_POST['option4'];
                                    $titre = $_POST['titre'];
                                        $description = $_POST['description'];

                                            // Connexion à la base de données
                                                $pdo = new PDO('mysql:host=localhost;dbname=sondages', 'root', 'root');

                                                    // Insérer le nouveau sondage dans la base de données
                                                        $stmt = $pdo->prepare('INSERT INTO sondages (question, option1, option2, option3, option4, titre, description) VALUES (?, ?, ?, ?, ?, ?, ?)');
                                                            $stmt->execute([$question, $option1, $option2, $option3, $option4, $titre, $description]);

                                                                // Rediriger vers la page de liste des sondages
                                                                    header('Location: connexion.php');
                                                                        exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
        <head>
                    <meta charset="UTF-8">
                        <meta http-equiv="X-UA-Compatible" content="IE=edge">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                <title>Ajouter un sondage</title>
                                    <link rel="stylesheet" href="bootstrap.css">
                                        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
            <div class="container">
                        <h1>Ajouter un sondage</h1>
                                <form method="post" action="ajoutSondage.php">
<div class="form-group">
                                                    <label for="titre">Titre :</label>
                                                        <input type="text" class="form-control" id="titre" name="titre" required>
</div>
<div class="form-group">
            <label for="description">Description :</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
</div>

                                                    <div class="form-group">
                                                                        <label for="question">Question :</label>
                                                                                        <input type="text" class="form-control" id="question" name="question" required>
</div>
            <div class="form-group">
                                <label for="option1">Option 1 :</label>
                                                <input type="text" class="form-control" id="option1" name="option1" required>
</div>
            <div class="form-group">
                                <label for="option2">Option 2 :</label>
                                                <input type="text" class="form-control" id="option2" name="option2" required>
</div>
            <div class="form-group">
                                <label for="option3">Option 3 :</label>
                                                <input type="text" class="form-control" id="option3" name="option3" required>
</div>
            <div class="form-group">
                                <label for="option4">Option 4 :</label>
                                                <input type="text" class="form-control" id="option4" name="option4" required>
</div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
</form>
</div>
</body>
</html>

