<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../');
    exit();
}

try {
    $pdo = new PDO('mysql:host=192.168.1.36;dbname=hearandknow', 'subina', 'Boutonsos287*');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmtAlertes = $pdo->prepare("SELECT * FROM alertes WHERE utilisateur_id = :userId ORDER BY date DESC");
    $stmtAlertes->bindParam(':userId', $_SESSION['user_id']);
    $stmtAlertes->execute();
    $toutesAlertes = $stmtAlertes->fetchAll(PDO::FETCH_ASSOC);
    $nombreAlertes = count($toutesAlertes);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toutes les alertes - Hear & Know</title>
    <link rel="icon" href="logo.png">
</head>
<body>
    
<div class="dashboard-container">

    <div class="header">
    <img src="hak.png" alt="Hear & Know Logo" class="logo"> <!-- Remplacez avec le chemin réel du logo -->
        <p>Nombre total d'alertes: <?php echo $nombreAlertes; ?></p>
        <button onclick="window.location.href='dashboard.php'">Retour au tableau de bord</button>
    </div>
    <div class="alertes-container">
        <?php foreach ($toutesAlertes as $alerte): ?>
            <div class="alerte-item">
                <h4>Alerte: <?php echo htmlspecialchars(date("d/m/Y H:i:s", strtotime($alerte['date']))); ?></h4>
                <p>Statut: <?php echo htmlspecialchars($alerte['statut']); ?></p>
                <!-- D'autres détails sur l'alerte si nécessaire -->
            </div>
        <?php endforeach; ?>
        <?php if (!$nombreAlertes): ?>
            <p>Aucune alerte enregistrée.</p>
        <?php endif; ?>
    </div>
</div>

<style>
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
  font-family: 'Arial', sans-serif;
}

body, html {
  height: 100%;
  margin: 0;
  padding: 0;
  background: url('background-city.jpg') no-repeat center center fixed; /* Mettez le bon chemin d'accès à votre image */
  background-size: cover;
}

/* Style pour l'en-tête */
.header {
  background-color: rgba(103, 58, 183, 0.9); /* Transparence pour voir l'arrière-plan */
  color: white;
  padding: 20px;
  text-align: center;
  border-radius: 10px;
  margin: 20px; /* Ajouter de l'espace au-dessus et en dessous */
}

/* Style pour le conteneur des alertes */
.alertes-container {
  background-color: rgba(255, 255, 255, 0.9); /* Fond blanc avec transparence */
  border-radius: 10px;
  padding: 20px;
  width: 80%; /* Largeur réduite pour un meilleur affichage */
  max-width: 800px; /* Largeur maximale */
  margin: auto; /* Centrer dans la page */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.alerte-item {
  border-bottom: 1px solid #ccc; /* Séparateur entre les alertes */
  padding: 15px 0; /* Espacement vertical à l'intérieur de chaque alerte */
}

.alerte-item:last-child {
  border-bottom: none; /* Pas de bordure pour le dernier élément */
}

/* Style pour les boutons */
button {
  background-color: #673AB7; /* Couleur du bouton du formulaire de connexion */
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
  margin: 10px 0; /* Espacement autour des boutons */
}
.logo {
    max-width: 100%; /* S'assure que le logo s'adapte à son conteneur */
    height: auto; /* Pour maintenir le ratio d'aspect */
    /* Si le logo est un élément de bloc et que vous souhaitez le centrer horizontalement */
    display: block; /* Rend l'image un élément de bloc */
    margin-left: auto;
    margin-right: auto;
    margin-bottom:10%;
}

button:hover {
  background-color: #5e35b1; /* Une couleur légèrement plus claire pour l'effet hover */
}

/* Style pour les messages d'état */
.statut-en-cours {
  color: #d9534f; /* Rouge pour statut "En cours" */
}

.statut-resolu {
  color: #5cb85c; /* Vert pour statut "Résolu" */
}

.statut-fausse-alerte {
  color: #f0ad4e; /* Orange pour statut "Fausse alerte" */
}

/* Media queries pour la réactivité */
@media (max-width: 600px) {
  .alertes-container {
    width: 95%; /* Plus large pour les petits écrans */
  }
}

@media (min-width: 601px) and (max-width: 1024px) {
  .alertes-container {
    width: 90%; /* Ajustement pour les tablettes et petits écrans PC */
  }
}

</style>

</body>
</html>
