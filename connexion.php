<?php
session_start();

// Vérifier si l'utilisateur est déjà connecté, le rediriger vers la page d'accuei

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Connexion à la base de données
    $bdd = new PDO('mysql:host=localhost;dbname=inscription', 'root', 'root');

    // Préparer et exécuter la requête SQL pour récupérer l'utilisateur avec cet email
    $requete = $bdd->prepare("SELECT id, email, mot_de_passe FROM utilisateurs WHERE email = :email");
    $requete->bindParam(':email', $email);
    $requete->execute();
    $utilisateur = $requete->fetch();

    // Vérifier si l'utilisateur existe et si le mot de passe est correct
    if ($utilisateur && password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
        // Créer la session et enregistrer l'ID de l'utilisateur
        $_SESSION["id"] = $utilisateur['id'];
        
        // Rediriger vers la page d'accueil ou une autre page sécurisée
        header("Location: sondage.php");
        exit();
    } else {
        // Afficher un message d'erreur si l'authentification a échoué
        $erreur = "Email ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <!-- Ajout de Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Connexion</h2>
        <form class="mt-4" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="mb-3">
                <label for="email" class="form-label">Email :</label>
                <input type="email" class="form-control" name="email" id="email" required>
            </div>
            <div class="mb-3">
                <label for="mot_de_passe" class="form-label">Mot de passe :</label>
                <input type="password" class="form-control" name="mot_de_passe" id="mot_de_passe" required>
            </div>
            <button type="submit" class="btn btn-primary" >Se connecter</button>
		 <small>Creer un Compte</small>
<a href="insconnecte.php">S'inscrire</a>

        </form>
        <?php if(isset($erreur)) { echo '<div class="text-danger mt-3">' . $erreur . '</div>'; } ?>
    </div>
</body>
</html>


