<?php
// Afficher les erreurs PHP pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;

// Charger les informations de connexion depuis le fichier YAML
$config = Yaml::parseFile('config.yaml');

// Informations de connexion à la base de données
$servername = $config['database']['host'];
$username = $config['database']['username'];
$password = $config['database']['password'];
$dbname = $config['database']['dbname'];

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Traitement des données du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']); // Échapper les caractères spéciaux pour la sécurité

    // Préparer la requête d'insertion
    $stmt = $conn->prepare("INSERT INTO todo_list (content) VALUES (?)");

    // Vérifier si la préparation a réussi
    if ($stmt) {
        // Binder les paramètres et exécuter la requête
        $stmt->bind_param("s", $name);
        $stmt->execute();

        // Vérifier si l'insertion a réussi
        if ($stmt->affected_rows > 0) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Fermer le statement
        $stmt->close();
    } else {
        echo "Erreur de préparation de la requête : " . $conn->error;
    }
}

// Fermer la connexion
$conn->close();
?>
