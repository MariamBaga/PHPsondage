<?php
// Connexion à la base de données
$bdd = new PDO('mysql:host=localhost;dbname=inscription', 'root', 'root');

// Initialisation du message d'erreur
$message_erreur = "";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT); // Hasher le mot de passe

    // Préparer et exécuter la requête SQL
    $requete = $bdd->prepare("INSERT INTO utilisateurs (nom, email, mot_de_passe) VALUES (:nom, :email, :mot_de_passe)");
    $requete->bindParam(':nom', $nom);
    $requete->bindParam(':email', $email);
    $requete->bindParam(':mot_de_passe', $mot_de_passe);
    
    // Exécuter la requête et gérer les erreurs
    if ($requete->execute()) {
        // Rediriger vers une page de confirmation ou une page d'accueil si l'inscription réussit
        header("Location: connexion.php");
        exit();
    } else {
        // En cas d'erreur, afficher un message d'erreur
        $message_erreur = "Une erreur est survenue lors de l'inscription. Veuillez réessayer.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <!-- Ajout de Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Inscription</h2>
        <?php if (!empty($message_erreur)) { ?>
            <div class="alert alert-danger mt-3" role="alert">
                <?php echo $message_erreur; ?>
            </div>
        <?php } ?>
        <form class="mt-4" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom :</label>
                <input type="text" class="form-control" name="nom" id="nom" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email :</label>
                <input type="email" class="form-control" name="email" id="email" required>
            </div>
            <div class="mb-3">
                <label for="mot_de_passe" class="form-label">Mot de passe :</label>
                <input type="password" class="form-control" name="mot_de_passe" id="mot_de_passe" required>
            </div>
            <button type="submit" class="btn btn-primary">S'inscrire</button>
		<small>j'ai déjà un compte</small>
<a href="connexion.php">Se Connecter</a>       
 </form>
    </div>
</body>
</html>

