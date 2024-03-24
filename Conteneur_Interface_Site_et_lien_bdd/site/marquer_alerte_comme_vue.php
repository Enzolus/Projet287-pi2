<?php
session_start();
if (!isset($_SESSION['user_id']) || !isset($_GET['id_alerte'])) {
    echo json_encode(['success' => false]);
    exit;
}

$idAlerte = $_GET['id_alerte'];
$userId = $_SESSION['user_id'];

// Connexion à la base de données
try {
    $pdo = new PDO('mysql:host=mariadb_hk;dbname=hearandknow', 'subina', 'Boutonsos287*');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("UPDATE alertes SET vu = 1 WHERE id_alerte = :idAlerte AND utilisateur_id = :userId");
    $stmt->bindParam(':idAlerte', $idAlerte);
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false]);
}
?>
