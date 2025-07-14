<?php
require_once '../../inc/functions.php';
session_start();

if (!isset($_SESSION['id_membre'])) {
    die('Vous devez être connecté pour emprunter un objet.');
}
$id_membre = $_SESSION['id_membre'];

if (isset($_POST['id_objet']) && isset($_POST['duree'])) {
    $id_objet = intval($_POST['id_objet']);
    $duree = intval($_POST['duree']);
    if ($duree < 1 || $duree > 5) {
        die('Durée invalide.');
    }
    $date_emprunt = date('Y-m-d');
    $date_retour = date('Y-m-d', strtotime("+$duree days"));

    $bdd = db_connect();
    $verif = mysqli_query($bdd, "SELECT 1 FROM Ex_emprunt WHERE id_objet = $id_objet AND (date_retour IS NULL OR date_retour >= CURDATE())");
    if (mysqli_num_rows($verif) > 0) {
        echo '<div style="color:red; font-weight:bold;">Cet objet est déjà emprunté.</div>';
        echo '<a href="../../pages/liste.php">Retour à la liste</a>';
        exit;
    }

    $sql = "INSERT INTO Ex_emprunt (id_objet, id_membre, date_emprunt, date_retour) VALUES ($id_objet, $id_membre, '$date_emprunt', '$date_retour')";
    $res = mysqli_query($bdd, $sql);
    if ($res) {
        header('Location: ../../pages/liste.php?success=1');
        exit;
    } else {
        echo 'Erreur lors de l\'enregistrement de l\'emprunt.';
    }
} else {
    echo 'Données manquantes.';
}
?>
