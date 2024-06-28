<?php
// Activer les erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

try {
    // Lire le contenu de la requête POST
    $data = json_decode(file_get_contents('php://input'), true);

    if ($data && isset($data['image'])) {
        $image = $data['image'];

        // Vérifier si l'image est une data URL
        if (preg_match('/^data:image\/(\w+);base64,/', $image, $type)) {
            $image = substr($image, strpos($image, ',') + 1);
            $type = strtolower($type[1]); // jpg, png, gif

            if (!in_array($type, ['jpg', 'jpeg', 'png', 'gif'])) {
                throw new \Exception('Type de fichier image non supporté : ' . $type);
            }

            $image = base64_decode($image);

            if ($image === false) {
                throw new \Exception('Base64_decode a échoué');
            }
        } else {
            throw new \Exception('Le lien de l\'image n\'est pas valide');
        }

        // Sauvegarder l'image dans un fichier
        $filePath = 'uploads/' . uniqid() . '.' . $type;
        file_put_contents($filePath, $image);

        // Renvoyer le chemin de l'image sauvegardée
        echo json_encode(['filePath' => $filePath]);
    } else {
        echo json_encode(['error' => 'Aucune image reçue']);
    }
} catch (Exception $e) {
    // Renvoyer l'erreur en format JSON
    echo json_encode(['error' => $e->getMessage()]);
}
?>
