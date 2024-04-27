<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Page de Sondage</title>
    <!-- Styles Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <!-- Barre de navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Ma Page</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="accueil.php">Accueil <span class="sr-only">(current)</span></a>
                </li>
                
            </ul>
            <!-- Liste d'outils -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Outils
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="connexion.php">Connexion</a>
                        <a class="dropdown-item" href="ajoutSondage.php">Ajouter un Sondage</a>
                       <a class="dropdown-item" href="insconnecte.php">Inscription</a>
 <div class="dropdown-divider"></div>
                        
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Contenu de la page -->
    <div class="container mt-4">
        <h1>Bienvenue sur Ma Page de Sondage</h1>
        <small>Veuillez Se Connecter Pour Commencer</small>
    
    </div>

    <!-- Scripts Bootstrap (jQuery requis) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
