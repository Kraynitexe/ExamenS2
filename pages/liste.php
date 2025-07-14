<?php
require_once '../inc/functions.php';

// Récupérer la catégorie sélectionnée
$categorie_sel = '';
if (isset($_GET['categorie'])) {
    $categorie_sel = $_GET['categorie'];
}

// Récupérer les catégories
$categories = get_categories();
$objets_disponibles = get_objets_disponibles();
if ($categorie_sel != '') {
    $objets_disponibles = filter_objets_by_categorie($objets_disponibles, $categorie_sel);
}

$objets_emprunts = get_objets_emprunts();
$objets_deja_empruntes = array();
for ($i = 0; $i < count($objets_emprunts); $i++) {
    if ($objets_emprunts[$i]['date_emprunt'] != '') {
        $objets_deja_empruntes[] = $objets_emprunts[$i];
    }
}
?>
<?php
require_once "../inc/header.php";
require_once "../inc/navbar.php";
?>
<body class="bg-light">
    <div class="container py-4">
        <h1 class="mb-4">Objets disponibles</h1>
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
            </div>
        </form>
        <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
            <?php for ($i = 0; $i < count($objets_disponibles); $i++) { ?>
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $objets_disponibles[$i]['nom_objet']; ?></h5>
                            <p class="card-text"><span class="badge bg-secondary"><?php echo $objets_disponibles[$i]['nom_categorie']; ?></span></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
