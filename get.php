<?php

require 'vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;

// Charger les informations de connexion depuis le fichier YAML
$config = Yaml::parseFile('config.yaml');

// Informations de connexion à la base de données
$servername = $config['database']['host'];
$username = $config['database']['username'];
$password = $config['database']['password'];
$dbname = $config['database']['dbname'];

// Traitement des données du formulaire

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $sql = "INSERT INTO todo_list (content) VALUES ('$name')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>