<?php
function db_connect(){
    $bdd = mysqli_connect('172.60.0.15', 'ETU004214', 'qO2254s1', 'db_s2_ETU004214');
    if (!$bdd) {
        die("Erreur de connexion à la base de données : " . mysqli_connect_error());
    }
    return $bdd;
}


function get_objets_liste() {
    $bdd = db_connect();
    $sql = "SELECT o.id_objet, o.nom_objet, c.nom_categorie, e.date_emprunt, e.date_retour, i.id_image, i.nom_image
            FROM Ex_objet o
            JOIN Ex_categorie_objet c ON o.id_categorie = c.id_categorie
            LEFT JOIN Ex_emprunt e ON o.id_objet = e.id_objet
            LEFT JOIN Ex_images_objet i ON o.id_objet = i.id_objet"; 
    $result = mysqli_query($bdd, $sql);
    $objets = array();
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $objets[] = $row;
        }
    }
    return $objets;
}

function get_categories() {
    $bdd = db_connect();
    $sql = "SELECT id_categorie, nom_categorie FROM Ex_categorie_objet";
    $result = mysqli_query($bdd, $sql);
    $categories = array();
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $categories[] = $row;
        }
    }
    return $categories;
}

function filter_objets_by_categorie($objets, $categorie) {
    $result = array();
    for ($i = 0; $i < count($objets); $i++) {
        if ($objets[$i]['nom_categorie'] == $categorie) {
            $result[] = $objets[$i];
        }
    }
    return $result;
}

function recherche($objets, $categorie = '', $nom = '', $disponible_uniquement = false) {
    $result = array();
    foreach ($objets as $obj) {
        if ($categorie != '' && $obj['nom_categorie'] != $categorie) {
            continue;
        }
        if ($nom != '' && stripos($obj['nom_objet'], $nom) === false) {
            continue;
        }
        if ($disponible_uniquement && !($obj['date_retour'] == '' || $obj['date_retour'] == null)) {
            continue;
        }
        $result[] = $obj;
    }
    return $result;
}

function get_image_principale($id_objet) {
    $bdd = db_connect();
    $sql = "SELECT nom_image FROM Ex_images_objet WHERE id_objet = $id_objet AND is_principale = 1 LIMIT 1";
    $res = mysqli_query($bdd, $sql);
    if ($res && $row = mysqli_fetch_assoc($res)) {
        return $row['nom_image'];
    } else {
        return '../assets/images/default.jpg';
    }
}

function objet_membre($id_membre) {
    $bdd = db_connect();
    $sql = "SELECT o.id_objet, o.nom_objet, c.nom_categorie FROM Ex_objet o JOIN Ex_categorie_objet c ON o.id_categorie = c.id_categorie WHERE o.id_membre = $id_membre ORDER BY c.nom_categorie, o.nom_objet";
    $res = mysqli_query($bdd, $sql);
    $objets = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $objets[$row['nom_categorie']][] = [
            'id_objet' => $row['id_objet'],
            'nom_objet' => $row['nom_objet']
        ];
    }
    return $objets;
}

function get_emprunts_membre($id_membre) {
    $bdd = db_connect();
    $sql = "SELECT e.id_emprunt, o.id_objet, o.nom_objet, c.nom_categorie, e.date_emprunt, e.date_retour, e.etat_retour
            FROM Ex_emprunt e
            JOIN Ex_objet o ON e.id_objet = o.id_objet
            JOIN Ex_categorie_objet c ON o.id_categorie = c.id_categorie
            WHERE e.id_membre = $id_membre AND e.date_retour IS NULL
            ORDER BY e.date_emprunt DESC";
    $res = mysqli_query($bdd, $sql);
    $emprunts = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $emprunts[] = $row;
    }
    return $emprunts;
}

function retour_emprunt($id_emprunt, $etat_retour) {
    $bdd = db_connect();
    $date_retour = date('Y-m-d');
    $sql = "UPDATE Ex_emprunt SET date_retour = '$date_retour', etat_retour = '$etat_retour' WHERE id_emprunt = $id_emprunt";
    return mysqli_query($bdd, $sql);
}
?>