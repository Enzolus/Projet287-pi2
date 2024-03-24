<?php
session_start();

// Assurez-vous que l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: ../');
    exit();
}

if (isset($_GET['id_contact'])) {
    $idContact = $_GET['id_contact'];

    // Connexion à la base de données
    try {
        $pdo = new PDO("mysql:host=mariadb_hk;dbname=hearandknow", 'subina', 'Boutonsos287*');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Supprimer le contact d'urgence
        $stmt = $pdo->prepare("DELETE FROM contacts_urgence WHERE id_contact = :idContact");
        $stmt->bindParam(':idContact', $idContact);
        $stmt->execute();

        // Redirection vers le tableau de bord
        header('Location: dashboard.php');
        exit();
    } catch (PDOException $e) {
        die("Erreur lors de la suppression du contact : " . $e->getMessage());
    }
}
?>

