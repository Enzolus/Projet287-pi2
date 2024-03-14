<?php
session_start();

// Vérification de la connexion de l'utilisateur
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Message de confirmation ou d'erreur
$message = '';

// Connexion à la base de données
try {
    $pdo = new PDO('mysql:host=192.168.1.36;dbname=hearandknow', 'subina', 'Boutonsos287*');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Traitement du formulaire lorsqu'il est soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom = $_POST['nom_contact'] ?? '';
        $prenom = $_POST['prenom_contact'] ?? '';
        $telephone = $_POST['numero_contact'] ?? '';
        $telegram = $_POST['id_telegram'] ?? '';
        $userId = $_SESSION['user_id']; // Assurez-vous que cette variable contient l'ID de l'utilisateur connecté

        // Insérer les informations du nouveau contact dans la base de données
        $stmt = $pdo->prepare("INSERT INTO contacts_urgence (utilisateur_id, nom_contact, prenom_contact, numero_contact, id_telegram) VALUES (:userId, :nom, :prenom, :telephone, :telegram)");
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':telegram', $telegram);

        if ($stmt->execute()) {
            $message = 'Contact ajouté avec succès.';
            // Redirection vers le tableau de bord
            header('Location: dashboard.php');
            exit();
        } else {
            $message = 'Erreur lors de l\'ajout du contact.';
        }
    }
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un contact d'urgence - Hear & Know</title>
    <link rel="icon" href="logo.png">
    <!-- Liens vers les feuilles de style -->
</head>
<body>

<div class="update-container">
<div class="logo-container">
    <img src="Hkbleu.png" alt="Hear & Know Logo" class="logo">
</div>
    <h2>Ajouter un contact d'urgence</h2>
    <?php if (!empty($message)): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    <form action="" method="post">
        <label for="nom_contact">Nom :</label>
        <input type="text" id="nom_contact" name="nom_contact" required>
        
        <label for="prenom_contact">Prénom :</label>
        <input type="text" id="prenom_contact" name="prenom_contact" required>
        
        <label for="numero_contact">Téléphone :</label>
        <input type="text" id="numero_contact" name="numero_contact" required>
        
        <label for="id_telegram">ID Telegram :</label>
        <input type="text" id="id_telegram" name="id_telegram">
        
        <button type="submit" style="margin-top: 40px;">Ajouter</button>
        <button type="button" onclick="window.location.href='dashboard.php'" style="margin-top: 15px;">Annuler</button>
    </form>
</div>
<style>
    /* Styles de base */
body, html {
    margin: 0;
    padding: 0;
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    color: #333;
}

/* Container principal */
.update-container {
    max-width: 100%;
    padding: 20px;
    margin: auto;
}

/* Styles des formulaires */
form {
    display: flex;
    flex-direction: column;
}

label {
    margin-top: 10px;
}

input[type="text"],
button {
    padding: 10px;
    margin-top: 5px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

button {
    background-color: #673AB7;
    color: white;
    cursor: pointer;
}

button:hover {
    background-color: #5e35b1;
}
.logo-container {
    display: flex; /* Utiliser flexbox pour le centrage */
    justify-content: center; /* Centrer horizontalement */
    align-items: center; /* Centrer verticalement */
    height: 100px; /* Définir une hauteur pour le conteneur du logo */
    padding-bottom: 20px;
}

/* Style de l'image du logo */
.logo {
    max-width: 100%; /* S'assurer que le logo ne dépasse pas le conteneur */
    height: auto; /* Maintenir le ratio de l'image */
}
/* Requêtes média pour les écrans plus larges */
@media (min-width: 768px) {
    .update-container {
        max-width: 600px;
        margin: 40px auto;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        background-color: #ffffff;
        padding: 40px;
        border-radius: 10px;
    }

    form {
        max-width: 500px;
        margin: auto;
    }
}

</style>
</body>
</html>
