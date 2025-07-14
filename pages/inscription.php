<?php

$nom = $_POST['nom'];
$date_naissance = $_POST['date_naissance'];
$genre = $_POST['genre'];
$email = $_POST['email'];
$ville = $_POST['ville'];
$mdp = $_POST['mdp'];
// $image_profil 

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
</head>
<body>
    <h1>Inscription</h1>
    <?php if ($message) echo '<p>' . htmlspecialchars($message) . '</p>'; ?>
    <form method="post" enctype="multipart/form-data">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" required><br>

        <label for="date_naissance">Date de naissance :</label>
        <input type="date" name="date_naissance" id="date_naissance" required><br>

        <label for="genre">Genre :</label>
        <select name="genre" id="genre" required>
            <option value="F">Féminin</option>
            <option value="M">Masculin</option>
            <option value="Autre">Autre</option>
        </select><br>

        <label for="email">Email :</label>
        <input type="email" name="email" id="email" required><br>

        <label for="ville">Ville :</label>
        <input type="text" name="ville" id="ville"><br>

        <label for="mdp">Mot de passe :</label>
        <input type="password" name="mdp" id="mdp" required><br>

        <label for="image_profil">Image de profil :</label>
        <input type="file" name="image_profil" id="image_profil" accept="image/*"><br>

        <button type="submit">S'inscrire</button>
    </form>
</body>
</html>
