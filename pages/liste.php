<?php
require_once '../inc/functions.php';

$objets_disponibles = get_objets_disponibles();
$objets_emprunts = get_objets_emprunts();

$objets_deja_empruntes = array_filter($objets_emprunts, function($o) {
    return !empty($o['date_emprunt']);
});
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des objets</title>
</head>
<body>
    <h1>Objets disponibles</h1>
    <ul>
        <?php foreach ($objets_disponibles as $objet): ?>
            <li>
                <?php echo htmlspecialchars($objet['nom_objet']) . ' (' . htmlspecialchars($objet['nom_categorie']) . ')'; ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <h1>Objets déjà empruntés</h1>
    <ul>
        <?php foreach ($objets_deja_empruntes as $objet): ?>
            <li>
                <?php echo htmlspecialchars($objet['nom_objet']) . ' (' . htmlspecialchars($objet['nom_categorie']) . ')'; ?>
                - Emprunté le : <?php echo htmlspecialchars($objet['date_emprunt']); ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
