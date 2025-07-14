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
$objets = objet_membre($id_membre);
// Liste des objets empruntés par la personne
$emprunts = get_emprunts_membre($id_membre);
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
                    <h4 class="mb-3">Objets ajoutés :</h4>
                     <!-- <?php if (count($objets) == 0) { ?>
                        <div class="text-muted">Aucun objet ajouté.</div>
                    <?php } else { ?>
                        <?php foreach ($objets as $cat => $liste) { ?>
                            <h5 class="mt-3"><?php echo $cat; ?></h5>
                            <ul>
                                <?php foreach ($liste as $obj) { ?>
                                    <li><a href="objet.php?id=<?php echo $obj['id_objet']; ?>"><?php echo $obj['nom_objet']; ?></a></li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    <?php } ?>
                </div> -->
                <div class="card shadow p-4 mb-4">
                    <h4 class="mb-3">Objets empruntés</h4>
                    <?php if (count($emprunts) == 0) { ?>
                        <div class="text-muted">Aucun objet emprunté actuellement.</div>
                    <?php } else { ?>
                        <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Nom</th>
                                    <th>Catégorie</th>
                                    <th>Date d'emprunt</th>
                                    <th>Date de retour</th>
                                    <th>Rendre</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($emprunts as $emp) { ?>
                                <tr>
                                    <td><?php echo $emp['nom_objet']; ?></td>
                                    <td><?php echo $emp['nom_categorie']; ?></td>
                                    <td><?php echo $emp['date_emprunt']; ?></td>
                                    <td><?php echo $emp['date_retour']; ?></td>
                                    <td>
                                        <form method="post" action="../inc/traitements/traitement-retour.php" class="d-flex align-items-center mb-0">
                                            <input type="hidden" name="id_emprunt" value="<?php echo $emp['id_emprunt']; ?>">
                                            <select name="etat_retour" class="form-select form-select-sm w-auto me-2">
                                                <option value="ok">Non abîmé</option>
                                                <option value="abime">Abîmé</option>
                                            </select>
                                            <button type="submit" class="btn btn-danger btn-sm">Rendre</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php 
    require_once '../inc/footer.php';
    ?>
</body>
</html> 