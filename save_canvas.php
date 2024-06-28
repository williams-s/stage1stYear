<?php
// Activer les erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Lire le contenu de la requête POST
$data = json_decode(file_get_contents('php://input'), true);
$image = $data['image'];
$image = substr($image, strpos($image, ',') + 1);
$type = strtolower($type[1]); // jpg, png, gif

if (!in_array($type, ['jpg', 'jpeg', 'png', 'gif'])) {
    throw new \Exception('Type de fichier image non supporté : ' . $type);
}

$image = base64_decode($image);
if ($image === false) {
    throw new \Exception('Base64_decode a échoué');
}
$filePath = 'uploads/' . uniqid() . '.' . $type;
file_put_contents($filePath, $image);

// Renvoyer le chemin de l'image sauvegardée
echo json_encode(['filePath' => $filePath]);