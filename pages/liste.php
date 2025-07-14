<?php
session_start();
require_once '../inc/functions.php';

$categorie_sel = '';
$nom_objet_recherche = '';
$disponible_uniquement = false;
if (isset($_GET['categorie'])) {
    $categorie_sel = $_GET['categorie'];
}
if (isset($_GET['nom_objet'])) {
    $nom_objet_recherche = trim($_GET['nom_objet']);
}
if (isset($_GET['disponible']) && $_GET['disponible'] == '1') {
    $disponible_uniquement = true;
}

$categories = get_categories();
$objets_liste = get_objets_liste();
$all_objets = recherche(
    $objets_liste,
    $categorie_sel,
    $nom_objet_recherche,
    $disponible_uniquement
);
?>
<?php
require_once "../inc/header.php";
require_once "../inc/navbar.php";
?>
<body class="bg-light">
    <div class="container py-4">
        <h1 class="mb-4">Liste des objets</h1>
        <form method="get" class="mb-4">
            <div class="row g-2 align-items-center">
                <div class="col-auto">
                    <label for="categorie" class="col-form-label">Filtrer par catégorie :</label>
                </div>
                <div class="col-auto">
                    <select name="categorie" id="categorie" class="form-select">
                        <option value="">Toutes</option>
                        <?php for ($i = 0; $i < count($categories); $i++) {
                            $selected = '';
                            if ($categorie_sel == $categories[$i]['nom_categorie']) {
                                $selected = 'selected';
                            }
                        ?>
                            <option value="<?php echo $categories[$i]['nom_categorie']; ?>" <?php echo $selected; ?>><?php echo $categories[$i]['nom_categorie']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-auto">
                    <input type="submit" value="Filtrer" class="btn btn-primary">
                </div>
                <div class="col-auto">
                    <input type="text" name="nom_objet" class="form-control" placeholder="Nom de l'objet" value="<?php echo htmlspecialchars($nom_objet_recherche); ?>">
                </div>
                <div class="col-auto form-check">
                    <input class="form-check-input" type="checkbox" name="disponible" id="disponible" value="1" <?php if ($disponible_uniquement) echo 'checked'; ?>>
                    <label class="form-check-label" for="disponible">Disponible uniquement</label>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-secondary ms-2">Rechercher</button>
                </div>
            </div>
        </form>
        <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
            <?php for ($i = 0; $i < count($all_objets); $i++) { 
                $id_objet = $all_objets[$i]['id_objet'];
                $main_img = get_image_principale($id_objet);
                if (strpos($main_img, '../assets/images/') === false) {
                    $img_path = '../inc/traitements/uploads/' . $main_img;
                } else {
                    $img_path = $main_img;
                }
                if ($main_img == '../assets/images/default.jpg') {
                    $cat_img = strtolower($all_objets[$i]['nom_categorie']) . '.png';
                    $cat_img_path = '../assets/images/' . $cat_img;
                    if (file_exists($cat_img_path)) {
                        $img_path = $cat_img_path;
                    }
                }
                $is_disponible = ($all_objets[$i]['date_retour'] == '' || $all_objets[$i]['date_retour'] == null);
            ?>
                <div class="col">
    <div class="card h-100 shadow-sm <?php if (!$is_disponible) echo 'border-danger'; ?>">
        <a href="objet.php?id=<?php echo $all_objets[$i]['id_objet']; ?>" class="text-decoration-none text-dark">
            <img src="<?php echo $img_path; ?>" class="card-img-top" alt="<?php echo $all_objets[$i]['nom_objet']; ?>">
        </a>
        <div class="card-body">
            <a href="objet.php?id=<?php echo $all_objets[$i]['id_objet']; ?>" class="text-decoration-none text-dark">
                <h5 class="card-title"><?php echo $all_objets[$i]['nom_objet']; ?></h5>
            </a>
            <p class="card-text"><span class="badge bg-secondary"><?php echo $all_objets[$i]['nom_categorie']; ?></span></p>
            <?php if (!$is_disponible && $all_objets[$i]['date_retour'] != '') { 
                $date_retour = $all_objets[$i]['date_retour'];
                $now = date('Y-m-d');
                $diff = (strtotime($date_retour) - strtotime($now)) / (60*60*24);
                if ($diff < 0) {
            ?>
                <p class="card-text"><span style="color: red;">Date de retour : <?php echo $date_retour; ?> (délai dépassé)</span></p>
            <?php } else { ?>
                <p class="card-text"><span style="color: red;">Date de retour : <?php echo $date_retour; ?> (<?php echo intval($diff); ?> jour<?php if (intval($diff) > 1) echo 's'; ?> restant<?php if (intval($diff) > 1) echo 's'; ?>)</span></p>
            <?php } } ?>
            <?php if ($is_disponible) { ?>
                <button type="button" class="btn btn-success btn-sm mt-2"
                    onclick="document.getElementById('form-emprunt-<?php echo $id_objet; ?>').style.display='block'; this.style.display='none';">
                    Emprunter
                </button>
                <form method="post" action="../inc/traitements/traitement-emprunt.php"
                    id="form-emprunt-<?php echo $id_objet; ?>" style="display:none;" class="mt-2">
                    <input type="hidden" name="id_objet" value="<?php echo $id_objet; ?>">
                    <label for="duree-<?php echo $id_objet; ?>" class="form-label mb-0">Durée :</label>
                    <select name="duree" id="duree-<?php echo $id_objet; ?>"
                        class="form-select form-select-sm d-inline-block w-auto ms-1">
                        <?php for ($d = 1; $d <= 5; $d++) { ?>
                            <option value="<?php echo $d; ?>"><?php echo $d; ?> jour<?php if ($d > 1) echo 's'; ?></option>
                        <?php } ?>
                    </select>
                    <button type="submit" class="btn btn-primary btn-sm ms-2">Valider</button>
                </form>
            <?php } ?>
        </div>
    </div>
</div>
            <?php } ?>
        </div>
    </div>
    <?php 
    require_once '../inc/footer.php';
    ?>
</body>
</html>
