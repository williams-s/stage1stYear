<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemple PHP</title>
</head>
<body>
    <h1>Réception des données du formulaire</h1>

    <div>
        <?php
        // Traitement des données du formulaire
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = htmlspecialchars($_POST['name']);
            echo "<p>Bonjour, $name!</p>";
        }
        ?>
    </div>
</body>
</html>
