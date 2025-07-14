<?php
require_once "../inc/header.php";
?>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
            <h1 class="mb-4 text-center">Inscription</h1>
            <form method="post" action="../inc/traitements/traitement-inscription.php" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom :</label>
                    <input type="text" name="nom" id="nom" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Date de naissance :</label>
                    <input type="date" name="date" id="date" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="genre" class="form-label">Genre :</label>
                    <select name="genre" id="genre" class="form-select" required>
                        <option value="F">Féminin</option>
                        <option value="M">Masculin</option>
                        <option value="Autre">Autre</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email :</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="ville" class="form-label">Ville :</label>
                    <input type="text" name="ville" id="ville" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="mdp" class="form-label">Mot de passe :</label>
                    <input type="password" name="mdp" id="mdp" class="form-control" required>
                </div>
                <!-- <div class="mb-3">
                    <label for="image_profil" class="form-label">Image de profil :</label>
                    <input type="file" name="image_profil" id="image_profil" class="form-control" accept="image/*">
                </div>
                <div class="d-grid"> -->
                    <button type="submit" class="btn btn-primary">S'inscrire</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
