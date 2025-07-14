<?php
function db_connect(){
    $bdd = mysqli_connect('localhost', 'root', '', 's2_ETU004214');
    if (!$bdd) {
        die("Erreur de connexion à la base de données : " . mysqli_connect_error());
    }
    return $bdd;
}

// function get_objets_emprunts() {
//     $bdd = db_connect();
//     $sql = "SELECT id_objet, nom_objet, nom_categorie, date_emprunt, date_retour FROM vue_objets_emprunts";
//     $result = mysqli_query($bdd, $sql);
//     $objets = array();
//     if ($result) {
//         while ($row = mysqli_fetch_assoc($result)) {
//             $objets[] = $row;
//         }
//     }
//     return $objets;
// }

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

?>