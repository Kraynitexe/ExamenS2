<?php
session_start();
require_once '../inc/functions.php';

// Récupérer la catégorie sélectionnée
$categorie_sel = '';
if (isset($_GET['categorie'])) {
    $categorie_sel = $_GET['categorie'];
}

// Récupérer les catégories
$categories = get_categories();
$objets_liste = get_objets_liste();
$objets_disponibles = array();
for ($i = 0; $i < count($objets_liste); $i++) {
    if ($objets_liste[$i]['date_retour'] == '' || $objets_liste[$i]['date_retour'] == null) {
        $objets_disponibles[] = $objets_liste[$i];
    }
}
if ($categorie_sel != '') {
    $objets_disponibles = filter_objets_by_categorie($objets_disponibles, $categorie_sel);
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
        <img src="<?php echo $objets_disponibles[$i]['nom_image']; ?>" class="card-img-top" alt="<?php echo $objets_disponibles[$i]['nom_objet']; ?>">
        <div class="card-body">
            <h5 class="card-title"><?php echo $objets_disponibles[$i]['nom_objet']; ?></h5>
            <p class="card-text"><span class="badge bg-secondary"><?php echo $objets_disponibles[$i]['nom_categorie']; ?></span></p>
            <p class="card-text">
                <span>
                    <?php if ($objets_disponibles[$i]['date_retour'] != NULL) { ?>  
                        <span style="color: red;">Date de retour :</span>
                    <?php } ?>
                    <span style="color: red;"><?php echo $objets_disponibles[$i]['date_retour']; ?></span>
                </span>
            </p>          
        </div>
    </div>
</div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
