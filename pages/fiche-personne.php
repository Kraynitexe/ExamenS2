<?php
session_start();
require_once '../inc/header.php';
require_once '../inc/functions.php';
require_once "../inc/navbar.php";

if (!isset($_SESSION['id_membre'])) {
    echo '<div class="alert alert-danger">Vous devez être connecté pour accéder à votre fiche.</div>';
    exit;
}
$id_membre = $_SESSION['id_membre'];

// Récupérer les infos du membre
$bdd = db_connect();
$sql = "SELECT nom, date_naissance, genre, email, ville, image_profil FROM Ex_membre WHERE id_membre = $id_membre";
$res = mysqli_query($bdd, $sql);
$membre = mysqli_fetch_assoc($res);

// Récupérer les objets du membre, regroupés par catégorie
$sql_obj = "SELECT c.nom_categorie, o.nom_objet FROM Ex_objet o JOIN Ex_categorie_objet c ON o.id_categorie = c.id_categorie WHERE o.id_membre = $id_membre ORDER BY c.nom_categorie, o.nom_objet";
$res_obj = mysqli_query($bdd, $sql_obj);
$objets = array();
while ($row = mysqli_fetch_assoc($res_obj)) {
    $objets[$row['nom_categorie']][] = $row['nom_objet'];
}
?>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow p-4 mb-4">
                    <div class="d-flex align-items-center mb-3">
                        <img src="<?php echo $membre['image_profil'] ? $membre['image_profil'] : '../assets/images/default.jpg'; ?>" alt="Profil" class="rounded-circle me-3" width="80" height="80">
                        <div>
                            <h3 class="mb-0"><?php echo $membre['nom']; ?></h3>
                            <div class="text-muted"><?php echo $membre['email']; ?></div>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item">Date de naissance : <?php echo $membre['date_naissance']; ?></li>
                        <li class="list-group-item">Genre : <?php echo $membre['genre']; ?></li>
                        <li class="list-group-item">Ville : <?php echo $membre['ville']; ?></li>
                    </ul>
                </div>
                <div class="card shadow p-4">
                    <h4 class="mb-3">Objets ajoutés par vous (regroupés par catégorie)</h4>
                    <?php if (!objet_membre($id_membre)) { ?>
                        <div class="text-muted">Aucun objet ajouté.</div>
                    <?php } else { ?>
                        <?php foreach ($objets as $cat => $liste) { ?>
                            <h5 class="mt-3"><?php echo $cat; ?></h5>
                            <ul>
                                <?php foreach ($liste as $obj) { ?>
                                    <li><?php echo $obj; ?></li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 