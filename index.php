<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;

$config = Yaml::parseFile('config.yaml');

$servername = $config['database']['host'];
$username = $config['database']['username'];
$password = $config['database']['password'];
$dbname = $config['database']['dbname'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

$sql = "SELECT * FROM todo_list";
$result = $conn->query($sql);

$todo = [];

if ($result->num_rows > 0) {
    // Récupérer les données de chaque ligne
    while($row = $result->fetch_assoc()) {
        $todo[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($todo);
exit;
?>