<?php
// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=sondages', 'root', 'root');

// Récupérer l'ID du sondage depuis l'URL
$idSondage = isset($_GET['id']) ? $_GET['id'] : null;

// Vérifiez si l'ID est valide (par exemple, s'il existe dans la base de données)
if (!$idSondage) {
    // Gérer le cas où l'ID est invalide ou non fourni
    echo "ID de sondage invalide.";
    exit;
}

// Récupérer les informations sur le sondage
$stmt = $pdo->prepare('SELECT * FROM sondages WHERE id = ?');
$stmt->execute([$idSondage]);
$sondage = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$sondage) {
    // Gérer le cas où le sondage n'existe pas dans la base de données
    echo "Sondage non trouvé.";
    exit;
}

// Récupérer les réponses au sondage
$stmt = $pdo->prepare('SELECT reponse FROM reponses WHERE sondage_id = ?');
$stmt->execute([$idSondage]);
$reponses = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Compter le nombre de réponses pour chaque option
$counts = array_count_values($reponses);

// Calculer les pourcentages
$totalReponses = count($reponses);
$pourcentages = [];
foreach ($counts as $option => $count) {
    $pourcentages[$option] = ($count / $totalReponses) * 100;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Graphique en pourcentage</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div>
        <h1><?= $sondage['question'] ?></h1>
        <canvas id="myChart" width="400" height="400"></canvas>
    </div>
    
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: <?= json_encode(array_keys($counts)) ?>,
                datasets: [{
                    label: 'Pourcentage',
                    data: <?= json_encode(array_values($pourcentages)) ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Pourcentage (%)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Options'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
