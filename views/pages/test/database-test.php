<?php
require_once '../private/database.php';

$dbConnection = new DatabaseConnection();
$pdo = $dbConnection->getDatabase();

if ($pdo) {
    echo "[DATABASE TEST] Connexion réussie à la base de données.";
} else {
    echo "[DATABASE TEST] Échec de la connexion à la base de données.";
}
