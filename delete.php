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
    die("Connexion échouée : " . $conn->connect_error);
}

// Vérifier si la méthode HTTP est DELETE
if ($_SERVER["REQUEST_METHOD"] === "DELETE") {
    // Récupérer et sécuriser l'ID de l'élément à supprimer
    $itemId = $_GET['id'];
    $itemId = $conn->real_escape_string($itemId); // Échapper les caractères spéciaux

    // Préparer la requête DELETE avec une requête préparée
    $sql = "DELETE FROM todo_list WHERE item_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Liaison des paramètres et exécution de la requête
        $stmt->bind_param("i", $itemId); // "i" pour integer, $itemId est un entier
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Record deleted successfully";
        } else {
            echo "No record found with ID: " . $itemId;
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    echo "Invalid request method. Only DELETE method is allowed.";
}

// Fermer la connexion
$conn->close();
?>
