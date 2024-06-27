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

// Exécuter une requête SELECT
$sql = "SELECT * FROM todo_list";
$result = $conn->query($sql);

$todo = [];

if ($result->num_rows > 0) {
    // Récupérer les données de chaque ligne
    while($row = $result->fetch_assoc()) {
        $todo[] = $row;
    }
}

// Fermer la connexion
$conn->close();

// Renvoyer les données en format JSON
header('Content-Type: application/json');
echo json_encode($todo);
exit; // Assurez-vous que le script s'arrête après avoir envoyé les données JSON
?>