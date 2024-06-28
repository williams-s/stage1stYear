<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;

// Charger les informations de connexion depuis le fichier YAML
$config = Yaml::parseFile('config.yaml');

$servername = $config['database']['host'];
$username = $config['database']['username'];
$password = $config['database']['password'];
$dbname = $config['database']['dbname'];

// Créer une connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    header('Content-Type: application/json');
    echo json_encode(['error' => "Connexion échouée : " . $conn->connect_error]);
    exit();
}

// Vérifier si la méthode HTTP est DELETE
if ($_SERVER["REQUEST_METHOD"] === "DELETE") {
    // Préparer la requête DELETE pour supprimer tous les enregistrements
    $sql = "DELETE FROM users";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Exécuter la requête
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            header('Content-Type: application/json');
            echo json_encode(['success' => true]);
        } else {
            header('Content-Type: application/json');
            echo json_encode(['error' => "No records found to delete"]);
        }

        $stmt->close();
    } else {
        header('Content-Type: application/json');
        echo json_encode(['error' => "Error preparing statement: " . $conn->error]);
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(['error' => "Invalid request method. Only DELETE method is allowed."]);
}

// Fermer la connexion
$conn->close();
?>
