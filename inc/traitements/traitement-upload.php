<?php
require_once '../../inc/functions.php';
session_start();

$uploadDir = __DIR__ . '/uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}
$maxSize = 2 * 1024 * 1024; // 2 Mo
$allowedMimeTypes = ['image/jpeg', 'image/png'];

// Vérifier que le membre est connecté
if (!isset($_SESSION['id_membre'])) {
    die('Vous devez être connecté pour ajouter un objet.');
}
$id_membre = $_SESSION['id_membre'];

if (count($_POST) > 0) {
    if (isset($_POST['nom_objet']) && $_POST['nom_objet'] != '') {
        $nom_objet = $_POST['nom_objet'];
    } else {
        die('Nom de l\'objet obligatoire.');
    }
    if (isset($_POST['categorie']) && $_POST['categorie'] != '') {
        $id_categorie = $_POST['categorie'];
    } else {
        die('Catégorie obligatoire.');
    }

    $bdd = db_connect();
    // Insérer l'objet
    $sql_objet = "INSERT INTO Ex_objet (nom_objet, id_categorie, id_membre) VALUES ('$nom_objet', $id_categorie, $id_membre)";
    mysqli_query($bdd, $sql_objet);
    $id_objet = mysqli_insert_id($bdd);

    $main_image = null;
    $images = array();
    if (isset($_FILES['image_objet']) && !empty($_FILES['image_objet']['name'][0])) {
        $files = $_FILES['image_objet'];
        for ($i = 0; $i < count($files['name']); $i++) {
            if ($files['error'][$i] != 0) continue;
            if ($files['size'][$i] > $maxSize) continue;
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $files['tmp_name'][$i]);
            finfo_close($finfo);
            if (!in_array($mime, $allowedMimeTypes)) continue;
            $originalName = pathinfo($files['name'][$i], PATHINFO_FILENAME);
            $extension = pathinfo($files['name'][$i], PATHINFO_EXTENSION);
            $newName = $originalName . '_' . uniqid() . '.' . $extension;
            if (move_uploaded_file($files['tmp_name'][$i], $uploadDir . $newName)) {
                // Enregistrer l'image dans la base
                $sql_img = "INSERT INTO Ex_images_objet (id_objet, nom_image) VALUES ($id_objet, '$newName')";
                mysqli_query($bdd, $sql_img);
                if ($main_image === null) {
                    $main_image = $newName;
                }
                $images[] = $newName;
            }
        }
    }
    // image par defaut
    if ($main_image === null) {
        $main_image = '../../assets/images/default.jpg';
        $sql_img = "INSERT INTO Ex_images_objet (id_objet, nom_image) VALUES ($id_objet, '$main_image')";
        mysqli_query($bdd, $sql_img);
    }
    // Rediriger ou afficher un message
    header('Location: ../../pages/liste.php');
    exit;
} else {
    echo "Aucune donnée reçue.";
}
?>