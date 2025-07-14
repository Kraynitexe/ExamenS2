<?php
require_once '../../inc/functions.php';
session_start();

if (!isset($_SESSION['id_membre'])) {
    die('Vous devez être connecté pour rendre un objet.');
}

if (isset($_POST['id_emprunt']) && isset($_POST['etat_retour'])) {
    $id_emprunt = intval($_POST['id_emprunt']);
    $etat_retour = $_POST['etat_retour'];
    if ($etat_retour !== 'ok' && $etat_retour !== 'abime') {
        die('Valeur d\'état invalide.');
    }
    if (retour_emprunt($id_emprunt, $etat_retour)) {
        header('Location: ../../pages/fiche-personne.php?retour=success');
        exit;
    } else {
        echo 'Erreur lors de la mise à jour du retour.';
    }
} else {
    echo 'Données manquantes.';
}
?>
