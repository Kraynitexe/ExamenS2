<?php
require_once '../../inc/functions.php';
session_start();

if (isset($_POST['email']) && isset($_POST['mdp'])) {
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    $bdd = db_connect();
    $sql = "SELECT * FROM Ex_membre WHERE email = '$email' AND mdp = '$mdp'";
    $res = mysqli_query($bdd, $sql);
    if ($res && mysqli_num_rows($res) == 1) {
        $membre = mysqli_fetch_assoc($res);
        $_SESSION['id_membre'] = $membre['id_membre'];
        $_SESSION['nom'] = $membre['nom'];
        $_SESSION['email'] = $membre['email'];
        $_SESSION['genre'] = $membre['genre'];
        $_SESSION['ville'] = $membre['ville'];
        $_SESSION['date_naissance'] = $membre['date_naissance'];
        $_SESSION['image_profil'] = $membre['image_profil'];
        header('Location: ../../pages/liste.php');
        exit;
    } else {
        echo '<div class="alert alert-danger">Identifiants incorrects.</div>';
    }
} else {
    echo '<div class="alert alert-danger">Veuillez remplir tous les champs.</div>';
}
?>