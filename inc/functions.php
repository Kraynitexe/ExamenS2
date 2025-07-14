<?php
function db_connect(){
    $bdd = mysqli_connect('localhost', 'root', '', 's2_ETU004214');
    if (!$bdd) {
        die("Erreur de connexion à la base de données : " . mysqli_connect_error());
    }
    return $bdd;
}

function get_objets_emprunts() {
    $bdd = db_connect();
    $sql = "SELECT id_objet, nom_objet, nom_categorie, date_emprunt, date_retour FROM vue_objets_emprunts";
    $result = mysqli_query($bdd, $sql);
    $objets = array();
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $objets[] = $row;
        }
    }
    return $objets;
}

function get_objets_disponibles() {
    $bdd = db_connect();
    $sql = "SELECT id_objet, nom_objet, nom_categorie FROM vue_objets_disponibles";
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