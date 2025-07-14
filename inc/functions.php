<?php
function db_connect(){
    $bdd = mysqli_connect('localhost', 'ETU004214', 'qO2254s1', 's2_ETU004214');
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
    $sql = "SELECT o.id_objet, o.nom_objet, c.nom_categorie, e.date_emprunt, e.date_retour
            FROM Ex_objet o
            JOIN Ex_categorie_objet c ON o.id_categorie = c.id_categorie
            LEFT JOIN Ex_emprunt e ON o.id_objet = e.id_objet";
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
?>