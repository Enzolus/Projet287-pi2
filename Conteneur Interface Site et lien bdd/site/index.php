<?php
// Démarrer une nouvelle session ou reprendre une session existante
session_start();

// Initialisation des messages
$messageErreur = '';
$messageSuccess = '';

// Variables pour se connecter à la base de données
$host = '192.168.1.36';  // L'hôte où se trouve la base de données
$dbname = 'hearandknow';  // Le nom de la base de données
$user = 'subina';  // Le nom d'utilisateur pour se connecter
$pass = 'Boutonsos287*';  // Le mot de passe pour se connecter

// Créer une nouvelle connexion PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Assurez-vous que votre table users contient les champs firstname et lastname
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Ici, on compare directement le mot de passe sans hachage pour des fins de test
        if ($password === $user['password']) {
            // Stockez les informations nécessaires dans la session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['firstname'] = $user['firstname']; // Ajoutez cette ligne
            $_SESSION['lastname'] = $user['lastname']; // Ajoutez cette ligne

            header("Location: dashboard.php");
            exit;
        } else {
            $messageErreur = "Mot de passe incorrect.";
        }
    } else {
        $messageErreur = "Aucun utilisateur trouvé avec cet e-mail.";
    }
}

?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="logo.png">
    <title>Hear&Know | Connexion</title>
    <link rel="stylesheet" href="styles.css"> <!-- Lien vers votre fichier CSS -->
</head>

<body>
<div class="login-container">
    <div class="logo-container">
        <!-- Ici, vous mettez votre logo -->
        <img src="hak.png" alt="Hear & Know Logo" class="logo"> <!-- Remplacez avec le chemin réel du logo -->
    </div>
    <div class="login-card">
    <span class="message-container"><!-- Ce conteneur affichera les messages -->
        <!-- Le message d'erreur ou de réussite s'affiche ici -->
        <?php if (isset($messageErreur)) echo $messageErreur; ?>
        <?php if (isset($messageSuccess)) echo $messageSuccess; ?>
</span>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <input type="text" id="email" name="email" placeholder="Adresse email" required>
            </div>
            <div class="form-group">
                <input type="password" id="password" name="password" placeholder="Mot de passe" required>
            </div>
            <div class="form-group">
                <input type="checkbox" id="remember-me" name="remember-me">
                <label for="remember-me">Se souvenir de moi</label>
            </div>
            <div class="form-group">
                <button type="submit">Connexion</button>
            </div>
        </form>
        <a id="forgot-password-link" href="#">Mot de passe oublié?</a>

<!-- Ajoutez un conteneur pour le message qui sera manipulé par JavaScript -->
<div id="contact-info-container" style="display:none; text-align:center; margin-top: 10px;"></div>

</div>
<script>
// Fonction pour afficher les informations de contact
function showContactInfo() {
    var contactInfoContainer = document.getElementById('contact-info-container');
    var contactInfo = '<p>Contacter <a href="mailto:sales@hearandknow.fr">support@hearandknow.eu</a><br>Numéro de téléphone : +33 7 82 86 84 63</p>';
    
    // Vérifiez si les informations de contact sont déjà affichées
    if (contactInfoContainer.style.display === 'none') {
        contactInfoContainer.style.display = 'block';
        contactInfoContainer.innerHTML = contactInfo; // Ajouter le message au conteneur
    } else {
        contactInfoContainer.style.display = 'none';
        contactInfoContainer.innerHTML = ''; // Effacer le message
    }
}

// Ajouter un écouteur d'événements au lien 'Mot de passe oublié?'
document.getElementById('forgot-password-link').addEventListener('click', function(event) {
    event.preventDefault(); // Empêcher le lien de suivre son URL
    showContactInfo(); // Appeler la fonction pour afficher les informations de contact
});
</script>


</div>
</body>
</html>
