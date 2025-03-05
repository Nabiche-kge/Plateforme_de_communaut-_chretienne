<?php
require_once __DIR__ . '/../bd/Utilisateur.php';

$message = "";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $utilisateur = new Utilisateur();
    $message = $utilisateur->inscrire($_POST["nom"], $_POST["email"], $_POST["mot_de_passe"]);
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <h2>Inscription</h2>

    <?php if ($message): ?>
        <p style="color: <?= strpos($message, 'réussie') !== false ? 'green' : 'red'; ?>;">
            <?= $message; ?>
        </p>
    <?php endif; ?>

    <form method="POST">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required><br><br>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required><br><br>

        <button type="submit">S'inscrire</button>
    </form>
</body>
</html>
