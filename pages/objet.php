<?php
session_start();
require_once '../inc/header.php';
require_once '../inc/functions.php';

if (!isset($_GET['id'])) {
    echo '<div class="alert alert-danger">Aucun objet sélectionné.</div>';
    exit;
}
$id_objet = intval($_GET['id']);

$bdd = db_connect();
// Infos de l'objet
$sql = "SELECT o.nom_objet, c.nom_categorie, o.id_membre FROM Ex_objet o JOIN Ex_categorie_objet c ON o.id_categorie = c.id_categorie WHERE o.id_objet = $id_objet";
$res = mysqli_query($bdd, $sql);
$objet = mysqli_fetch_assoc($res);
if (!$objet) {
    echo '<div class="alert alert-danger">Objet introuvable.</div>';
    exit;
}
// Images de l'objet
$sql_img = "SELECT nom_image, is_principale FROM Ex_images_objet WHERE id_objet = $id_objet ORDER BY is_principale DESC, id_image ASC";
$res_img = mysqli_query($bdd, $sql_img);
$images = array();
$main_img = null;
while ($row = mysqli_fetch_assoc($res_img)) {
    if ($row['is_principale']) {
        $main_img = $row['nom_image'];
    } else {
        $images[] = $row['nom_image'];
    }
}
if ($main_img === null) {
    // Utiliser l'image de la catégorie si pas d'image principale
    $cat_img = strtolower($objet['nom_categorie']) . '.png';
    $cat_img_path = '../assets/images/' . $cat_img;
    if (file_exists($cat_img_path)) {
        $main_img = $cat_img_path;
    } else {
        $main_img = '../assets/images/default.jpg';
    }
}
// Historique des emprunts
$sql_hist = "SELECT e.date_emprunt, e.date_retour, m.nom FROM Ex_emprunt e JOIN Ex_membre m ON e.id_membre = m.id_membre WHERE e.id_objet = $id_objet ORDER BY e.date_emprunt DESC";
$res_hist = mysqli_query($bdd, $sql_hist);
$emprunts = array();
while ($row = mysqli_fetch_assoc($res_hist)) {
    $emprunts[] = $row;
}
?>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-4 shadow">
                    <div class="row g-0">
                        <div class="col-md-5 d-flex align-items-center justify-content-center bg-white">
                            <img src="<?php echo (strpos($main_img, '../assets/images/') === false) ? '../inc/traitements/uploads/' . $main_img : $main_img; ?>" class="img-fluid rounded p-3" alt="Image principale">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <h3 class="card-title mb-2"><?php echo $objet['nom_objet']; ?></h3>
                                <span class="badge bg-secondary mb-3"><?php echo $objet['nom_categorie']; ?></span>
                                <h5>Autres images</h5>
                                <div class="d-flex flex-wrap mb-3">
                                    <?php if (count($images) == 0) { ?>
                                        <span class="text-muted">Aucune autre image.</span>
                                    <?php } else { foreach ($images as $img) { ?>
                                        <img src="<?php echo '../inc/traitements/uploads/' . $img; ?>" class="rounded me-2 mb-2" style="width: 80px; height: 80px; object-fit: cover;" alt="Image objet">
                                    <?php }} ?>
                                </div>
                                <h5>Historique des emprunts</h5>
                                <ul class="list-group">
                                    <?php if (count($emprunts) == 0) { ?>
                                        <li class="list-group-item text-muted">Aucun emprunt enregistré.</li>
                                    <?php } else { foreach ($emprunts as $emp) { ?>
                                        <li class="list-group-item">
                                            <strong><?php echo $emp['nom']; ?></strong> :
                                            du <?php echo $emp['date_emprunt']; ?>
                                            <?php if ($emp['date_retour']) { ?>
                                                au <?php echo $emp['date_retour']; ?>
                                            <?php } else { ?>
                                                <span class="text-danger">(en cours)</span>
                                            <?php } ?>
                                        </li>
                                    <?php }} ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="liste.php" class="btn btn-secondary">Retour à la liste</a>
            </div>
        </div>
    </div>
</body>
</html>
