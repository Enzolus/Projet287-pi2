<?php
session_start();

// Vérifiez si l'utilisateur est connecté, sinon redirigez vers la page de connexion
if (!isset($_SESSION['user_id'])) {
    header('Location: ../');
    exit();
}

// Connexion à la base de données
try {
    $pdo = new PDO('mysql:host=mariadb_hk;dbname=hearandknow', 'subina', 'Boutonsos287*');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer les contacts d'urgence de l'utilisateur connecté
    $stmt = $pdo->prepare("SELECT * FROM contacts_urgence WHERE utilisateur_id = :userId");
    $stmt->bindParam(':userId', $_SESSION['user_id']);
    $stmt->execute();
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

$stmtAlertes = $pdo->prepare("SELECT * FROM alertes WHERE utilisateur_id = :userId AND vu = 0 ORDER BY date ASC");
$stmtAlertes->bindParam(':userId', $_SESSION['user_id']);
$stmtAlertes->execute();
$alertes = $stmtAlertes->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - Hear & Know</title>
    <link rel="stylesheet" href="dashboard_styles.css">
    <link rel="icon" href="logo.png">
</head>
<body>

<div class="dashboard-container">
    <div class="header">
        <h2>Bienvenue, <?php echo htmlspecialchars($_SESSION['firstname']) . ' ' . htmlspecialchars($_SESSION['lastname']); ?></h2> <!-- Utilisez la session ou une variable -->
        <p>Email : <?php echo htmlspecialchars($_SESSION['email']); ?></p> <!-- Utilisez la session ou une variable -->
        <button onclick="window.location.href='logout.php'">Déconnexion</button>
    </div>
    <div class="add-contact-container">
    <button onclick="voirToutesLesAlertes()" style="background-color: #a80000;">Voir toutes les alertes</button>
</div>
    <div class="alertes-container">
    <h3>Alertes</h3>
    <?php foreach ($alertes as $alerte): ?>
        <!-- Affichez uniquement les alertes non vues -->
        <?php if ($alerte['vu'] == 0): ?>
            <div class="alerte-item" id="alerte-<?php echo $alerte['id_alerte']; ?>">
                <h4>Alerte déclenchée à <?php echo htmlspecialchars(date("H:i:s d/m/Y", strtotime($alerte['date']))); ?> - Statut: <?php echo htmlspecialchars($alerte['statut']); ?></h4>
                <button class="vu" style="background-color: #a80000;" onclick="marquerCommeVu(<?php echo $alerte['id_alerte']; ?>)">Vu</button>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
    <?php if (empty($alertes)): ?>
        <p>Aucune alerte(s) récente non vu.</p>
    <?php endif; ?>
</div>


    <!-- Bouton Ajouter un contact -->
    <div class="add-contact-container">
        <button onclick="window.location.href='add_contact.php'">Ajouter un contact d'urgence</button>
    </div>

    <div class="contacts-list">
        <h3>Contacts d'urgence</h3>
        <?php foreach ($contacts as $contact): ?>
    <div class="contact-item">
        <h4><?php echo htmlspecialchars($contact['prenom_contact'] . ' ' . $contact['nom_contact']); ?></h4>
        <p>Téléphone : <?php echo htmlspecialchars($contact['numero_contact']); ?></p>
        <p>ID Telegram : <?php echo htmlspecialchars($contact['id_telegram']); ?></p>
        <!-- Bouton Modifier (l'implémentation dépend de votre logique d'application) -->
        <button class="button edit" onclick="window.location.href='edit_contact.php?id_contact=<?php echo $contact['id_contact']; ?>'">Modifier</button>
        <!-- Bouton Supprimer -->
        <button class="button delete" onclick="deleteContact(<?php echo $contact['id_contact']; ?>)">Supprimer</button>
    </div>
<?php endforeach; ?>
    </div>
</div>


<!-- Script JavaScript (à compléter) -->
<script>
    function deleteContact(contactId) {
        if (confirm('Êtes-vous sûr de vouloir supprimer ce contact ?')) {
            window.location.href = 'delete_contact.php?id_contact=' + contactId;
        }
    }

    function editContact(contactId) {
        // Implémentation de la fonction de modification
        console.log('Fonction de modification à implémenter pour le contact ID :', contactId);
    }
function marquerCommeVu(idAlerte) {
    // Envoyer une requête pour marquer l'alerte comme vue
    fetch('marquer_alerte_comme_vue.php?id_alerte=' + idAlerte)
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            // Supprimer l'élément d'alerte de l'affichage
            document.getElementById('alerte-' + idAlerte).style.display = 'none';
        }
    });
}
function voirToutesLesAlertes() {
        // Rediriger l'utilisateur vers une page où toutes les alertes sont affichées
        window.location.href = 'toutes_les_alertes.php';
    }
</script>

</body>
<footer class="footer">
    <p>&copy; <?php echo date("Y"); ?> Hear&Know. Tous droits réservés.</p>
</footer>
</html>
