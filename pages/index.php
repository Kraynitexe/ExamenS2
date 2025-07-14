<?php
session_start();
require_once "../inc/header.php";
?>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
            <h1 class="mb-4 text-center">Connexion</h1>
            <form action="../inc/traitements/traitement-login.php" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email :</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="mdp" class="form-label">Mot de passe :</label>
                    <input type="password" id="mdp" name="mdp" class="form-control" required>
                </div>
                <div class="d-grid mb-3">
                    <input type="submit" value="Se connecter" class="btn btn-primary">
                </div>
            </form>
            <div class="text-center">
                <a href="inscription.php">Créer un compte ?</a>
            </div>
        </div>
    </div>
    <?php 
    require_once '../inc/footer.php';
    ?>
</body>