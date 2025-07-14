<?php
require_once "../inc/header.php";
require_once "../inc/functions.php";
$categories = get_categories();
?>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
            <h1 class="mb-4 text-center">Ajouter un objet</h1>
            <form method="post" action="../inc/traitements/traitement-upload.php" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nom_objet" class="form-label">Nom de l'objet :</label>
                    <input type="text" name="nom_objet" id="nom_objet" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="categorie" class="form-label">Catégorie :</label>
                    <select name="categorie" id="categorie" class="form-select" required>
                        <option value="">Choisir une catégorie</option>
                        <?php for ($i = 0; $i < count($categories); $i++) { ?>
                            <option value="<?php echo $categories[$i]['id_categorie']; ?>"><?php echo $categories[$i]['nom_categorie']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="image_objet" class="form-label">Image de l'objet :</label>
                    <input type="file" name="image_objet" id="image_objet" class="form-control" accept="image/*">
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Ajouter l'objet</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
