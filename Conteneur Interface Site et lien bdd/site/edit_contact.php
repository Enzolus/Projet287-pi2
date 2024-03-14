<?php
session_start();

// Vérification de la connexion de l'utilisateur
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Connexion à la base de données
try {
    $pdo = new PDO('mysql:host=192.168.1.36;dbname=hearandknow', 'subina', 'Boutonsos287*');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifier si l'ID du contact est fourni et récupérer les détails du contact
    if (isset($_GET['id_contact'])) {
        $idContact = $_GET['id_contact'];

        $stmt = $pdo->prepare("SELECT * FROM contacts_urgence WHERE id_contact = :idContact");
        $stmt->bindParam(':idContact', $idContact);
        $stmt->execute();
        $contact = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$contact) {
            exit('Contact non trouvé.');
        }
    } else {
        exit('ID de contact non spécifié.');
    }

    // Traitement du formulaire de mise à jour
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom = $_POST['nom_contact'] ?? '';
        $prenom = $_POST['prenom_contact'] ?? '';
        $telephone = $_POST['numero_contact'] ?? '';
        $telegram = $_POST['id_telegram'] ?? '';

        // Mise à jour des informations du contact dans la base de données
        $updateStmt = $pdo->prepare("UPDATE contacts_urgence SET nom_contact = :nom, prenom_contact = :prenom, numero_contact = :telephone, id_telegram = :telegram WHERE id_contact = :idContact");
        $updateStmt->bindParam(':nom', $nom);
        $updateStmt->bindParam(':prenom', $prenom);
        $updateStmt->bindParam(':telephone', $telephone);
        $updateStmt->bindParam(':telegram', $telegram);
        $updateStmt->bindParam(':idContact', $idContact);
        $updateStmt->execute();

        // Redirection vers le tableau de bord après la mise à jour
        header('Location: dashboard.php');
        exit();
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
    <title>Modifier le contact - Hear & Know</title>
    <link rel="icon" href="logo.png">
    <!-- Liens vers les feuilles de style -->
</head>
<body>

<div class="update-container">
<div class="logo-container">
    <img src="Hkbleu.png" alt="Hear & Know Logo" class="logo">
</div>
    <h2>Modifier le contact</h2>
    <form action="" method="post">
        <label for="nom_contact">Nom :</label>
        <input type="text" id="nom_contact" name="nom_contact" value="<?php echo htmlspecialchars($contact['nom_contact']); ?>" required>
        
        <label for="prenom_contact">Prénom :</label>
        <input type="text" id="prenom_contact" name="prenom_contact" value="<?php echo htmlspecialchars($contact['prenom_contact']); ?>" required>
        
        <label for="numero_contact">Téléphone :</label>
        <input type="text" id="numero_contact" name="numero_contact" value="<?php echo htmlspecialchars($contact['numero_contact']); ?>" required>
        
        <label for="id_telegram">ID Telegram :</label>
        <input type="text" id="id_telegram" name="id_telegram" value="<?php echo htmlspecialchars($contact['id_telegram']); ?>">
        
        <button type="submit" style="margin-top: 40px;">Mettre à jour</button>
        <button type="button" onclick="window.location.href='dashboard.php'" style="margin-top: 15px;">Annuler</button>
    </form>

</div>
<style>
    body, html {
        margin: 0;
        padding: 0;
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        color: #333;
    }

    .update-container {
        max-width: 100%;
        padding: 20px;
        margin: auto;
    }

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
