<?php
// Informations de connexion à la base de données
$servername = "localhost";
$username = "williams"; // Nom d'utilisateur par défaut de MySQL
$password = "Ravus77!"; // Mot de passe par défaut pour MySQL
$dbname = "test";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Exécuter une requête SELECT
$sql = "SELECT * todo_list";
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
?>
