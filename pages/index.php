<?php
require_once "../inc/header.php";
?>
<body>
    <main>
    <form action="inc/traitements/traitement-login.php" method="post">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br>
        <label for="mdp">Mot de passe:</label><br>
        <input type="password" id="mdp" name="mdp"><br>
        <input type="submit" value="Se connecter">
    </form>
    <a href="inscription.php">Creer un compte</a>
    </main>
</body>